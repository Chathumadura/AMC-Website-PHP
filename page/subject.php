<?php
include 'Connection.php';

if(isset($_POST['create'])){

    // Sanitize the input to prevent SQL Injection
    $moduleName = mysqli_real_escape_string($conn, $_POST["moduleName"]);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);

    // Check if the connection is established
    if($conn){
        // SQL query to insert data into the database
        $sql = "INSERT INTO subject_m (module, description) VALUES ('$moduleName', '$Description')";

        if(mysqli_query($conn, $sql)){
            // Redirect to subject.php with a success message
            header("Location: subject.php?create=success");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Database connection failed: " . mysqli_connect_error();
    }
    mysqli_close($conn);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meta Page</title>
    <link rel="stylesheet" href="../css/home.css"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2 {
            color: #333;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
        }
        .action-buttons button {
            margin-right: 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .update-button {
            background-color: #4CAF50;
            color: white;
        }
        .delete-button {
            background-color: #f44336;
            color: white;
        }
        .formPopup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            border: 3px solid #f1f1f1;
            z-index: 9;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
        }
        .btn {
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
            border: none;
        }
        .cancel {
            background-color: #ccc;
            color: black;
        }
        .btn.cancel {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <nav>
        <div class="menu">
            <div class="logo">
                <a href="#">AMC International School</a>
            </div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>

    <br><br><br><br><br><br>
 
    <div class="formPopup" id="updateForm">
        <form action="update.php" class="formContainer" method="POST">
            <h2>Update Subject</h2>
            <input type="hidden" name="id" id="update-id">
            <label for="update-module-name">Module Name:</label>
            <input type="text" id="update-module-name" name="moduleName" required><br>
            <label for="update-description">Description:</label>
            <textarea id="update-description" name="description" rows="4" required></textarea><br>
            <button type="submit" class="btn" name="update">Update</button>
            <button type="button" class="btn cancel" onclick="closeForm('updateForm')">Close</button>
        </form>
    </div>

    <div class="formPopup" id="deleteForm">
        <form action="delete.php" class="formContainer" method="POST">
            <h2>Delete Subject</h2>
            <input type="hidden" name="id" id="delete-id">
            <p>Are you sure you want to delete this subject?</p>
            <button type="submit" class="btn" name="delete">Delete</button>
            <button type="button" class="btn cancel" onclick="closeForm('deleteForm')">Close</button>
        </form>
    </div>

    <h1>Add Subject</h1>
    <form id="meta-form" method="post" action="">
        <label for="module-name">Module Name:</label>
        <input type="text" id="module-name" name="moduleName" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea><br>
        <button type="submit" name="create">Submit</button>
    </form>
    <br><br>
    <h2>Subject Details</h2>
    <table id="meta-table">
        <thead>
            <tr>
                <th>Module Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'Connection.php';
            $result = mysqli_query($conn, "SELECT * FROM subject_m");
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['module'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo '<td class="action-buttons">
                            <button class="update-button" onclick="openUpdateForm(' . $row['id'] . ', \'' . htmlspecialchars($row['module']) . '\', \'' . htmlspecialchars($row['description']) . '\')">Update</button>
                            <button class="delete-button" onclick="openDeleteForm(' . $row['id'] . ')">Delete</button>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No subjects found</td></tr>";
            }
            mysqli_close($conn);
            ?> 
        </tbody>
    </table>

    <script>
        function openUpdateForm(id, module, description) {
            document.getElementById("update-id").value = id;
            document.getElementById("update-module-name").value = module;
            document.getElementById("update-description").value = description;
            document.getElementById("updateForm").style.display = "block";
        }

        function openDeleteForm(id) {
            document.getElementById("delete-id").value = id;
            document.getElementById("deleteForm").style.display = "block";
        }

        function closeForm(formId) {
            document.getElementById(formId).style.display = "none";
        }
    </script>
</body>
</html>
