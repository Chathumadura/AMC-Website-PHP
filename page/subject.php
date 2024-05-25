<?php
include 'Connection.php';

if (isset($_POST['create'])) {
    $moduleName = mysqli_real_escape_string($conn, $_POST["moduleName"]);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);

    if ($conn) {
        $sql = "INSERT INTO subject_m (module, description) VALUES ('$moduleName', '$Description')";
        if (mysqli_query($conn, $sql)) {
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
    <title>Subject Management</title>
    <link rel="stylesheet" href="../css/header.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #2f4449, #050a1d);
        }
        nav {
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            background: #1b1b1b;
            z-index: 10;
            height: 60px;
        }
        nav .menu {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            color: white;
        }
        nav .menu .logo a {
            text-decoration: none;
            color: white;
            font-size: 35px;
        }
        nav .menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        nav .menu ul li {
            margin-left: 20px;
        }
        nav .menu ul li a {
            text-decoration: none;
            color: white;
            font-size: 18px;
        }
        .body1 {
            margin: 80px 20px 20px 20px; /* Add margin-top to move the content below the navbar */
        }
        h1, h2 {
            color: #fff;
        }
        input[type="text"], textarea {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, textarea:focus {
            border-color: #4CAF50;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            margin: 0 auto;
            transition: transform 0.3s;
        }
        form:hover {
            transform: translateY(-10px);
        }
        button {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: linear-gradient(135deg, #a777e3, #6e8efb);
        }
        table {
            width: 90%;
            margin: 0 auto; /* Center the table */
            border-collapse: collapse;
            background: #fff; /* Table background color */
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        table:hover {
            transform: translateY(-10px);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: ;
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
            background-color: #0000FF; /* Blue color */
            color: white;
        }
        .delete-button {
            background-color: #FF0000; /* Red color */
            color: white;
        }
        .formPopup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            border: 3px solid #f1f1f1;
            z-index: 9;
            background-color: #fff; /* Form background color */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
                <li><a href="admin.php">Home</a></li>
                <li><a href="../html/about.html">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>
    <br/>
    <div class="body1">
        <h1>Add Subject</h1>
        <form id="meta-form" method="post" action="">
            <label for="module-name">Module Name:</label><br>
            <input type="text" id="module-name" name="moduleName" required><br>
            <label for="description">Description:</label><br>
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
                    while ($row = mysqli_fetch_assoc($result)) {
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
    </div>

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
