<?php
include 'Connection.php';


if(isset($_POST['signup'])){

    $Fname = $_POST["FirstName"];
    $Lname = $_POST['LastName'];
    $Age = $_POST['Age'];
    $Gender = $_POST['gender'];
    $Email = $_POST['Email'];
    $Phone = $_POST['PhoneNumber'];
    $password = $_POST['Password'];

    $sql = "INSERT INTO user_reg (`u_fname`, `u_lname`, `Age`, `gender`, `Email`,`Phone_number`, `password`) VALUES 
    ('$Fname', '$Lname', '$Age', '$Gender', '$Email','$Phone','$password' )";

    $result = mysqli_query($conn, $sql);
        header("Location:signup.php?signup=success");

    
// mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../CSS/signup.css">
 
</head>
<body>
<?php
include '../html/header.html';
?>
    <div class="signup-container">
    <div class="wrapper">
        <form action="#" method="POST" class="signup-form">
            <h2>Student Registration</h2>
            <div class="input-group">
                <input type="text" name="FirstName" id="firstName" placeholder="First Name" required>
                <input type="text" name="LastName" id="lastName" placeholder="Last Name" required>
                <input type="email" name="Email" id="email" placeholder="Email" required>
                <input type="tel" id="phoneNumber" name="PhoneNumber" class="rounded-rectangle" placeholder="Phone Number" required>
                <input type="number" id="Age" name="Age" class="rounded-rectangle" placeholder="Age" required>

            </div>
            
                <div>
                Gender <input  type="radio" id="male" name="gender" value="M" required>
                    Male
                <input type="radio" id="female" name="gender" value="F" required>
                    Female
                </div>
           
            
            <div class="input-group">
                <input type="password" name="Password" id="password" placeholder="Password" required>
            </div>
            <button type="submit" name="signup" class="btn-signup">Sign Up</button>
        </form>
    </div>
    </div>
</body>
</html>
