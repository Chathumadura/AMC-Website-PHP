<?php
include 'Connection.php';
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
        h1 {
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
      <div class="updatepop">
      <div class="formPopup" id="updatefrom">
        <form action="update.php" class="formContainer" method="POST">
          <h2>Update  Account</h2>
          
         
         
         <h3>First name<br> <input name="Firstname" value="<?= $getdata['u_fname'];?>"></h3>
         <h3> Last name<br> <input name="Lastname" value="<?= $getdata['u_lname'];?>"></h3>
         <h3>Age <br><input name="age" value="<?= $getdata['Age'];?>"><h3>
         <input type="hidden" name="id" value="<?= $pid;?>"/>
         <h3>Gender <br><input name="gender" value="<?= $getdata['gender'];?>"> <h3>
            
         <h3>Phone Number <br><input name="PhoneNumber" value="<?= $getdata['Phone_number'];?>"> <h3>
         <h3>Email<br> <input name="Email" value="<?= $getdata['Email'];?>"> <h3>
            
        
         <button type="submit" class="btn" name="submit">Update</button></a>
          <button type="button" class="btn cancel" onclick="closeForms()">Close</button>
        </form>
      </div>
    </div>

      
    <h1>Add Subject</h1>
    <form id="meta-form">
        <label for="module-name">Module Name:</label>
        <input type="text" id="module-name" name="module-name" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea><br>
        <button type="submit">Create</button>
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
            <!-- Table rows will be dynamically added here -->
        </tbody>
    </table>

    <script>
        // JavaScript functionality for adding rows dynamically, handling updates and deletes would go here
    </script>

<!----- popup-->
<div class="loginPopup">
      <div class="formPopup" id="popupForm">
        <form action="delete.php" class="formContainer" method="POST">
          <h2>Delete Account</h2>
          <input type="hidden" name="id" value="<?= $_SESSION['id'];?>" />
          <button type="submit" class="btn">Delete</button></a>
          <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
      </div>
    </div>
<!----- popup-->

</body>
</html>
