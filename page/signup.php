<?php
include 'Connection.php';

if(isset($_POST['signup'])){
    $Fname = trim($_POST["FirstName"]);
    $Lname = trim($_POST['LastName']);
    $Age = trim($_POST['Age']);
    $Gender = $_POST['gender'];
    $Email = trim($_POST['Email']);
    $Phone = trim($_POST['PhoneNumber']);
    $password = trim($_POST['Password']);

    // Server-side validation
    if (empty($Fname) || empty($Lname) || empty($Age) || empty($Gender) || empty($Email) || empty($Phone) || empty($password)) {
        echo "<script>alert('All fields are required.');</script>";
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.');</script>";
    } elseif (!preg_match("/^[0-9]{10}$/", $Phone)) {
        echo "<script>alert('Invalid phone number.');</script>";
    } elseif (!preg_match("/^[1-9][0-9]*$/", $Age)) {
        echo "<script>alert('Invalid age.');</script>";
    } elseif (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters long.');</script>";
    } else {
        // Check if the email already exists in the database
        $emailCheckSql = "SELECT * FROM user_reg WHERE Email='$Email'";
        $emailCheckResult = mysqli_query($conn, $emailCheckSql);

        if (mysqli_num_rows($emailCheckResult) > 0) {
            // Email already exists
            echo "<script>alert('This email is already registered. Please use a different email.');</script>";
        } else {
            // Insert new user data
            $sql = "INSERT INTO user_reg (`u_fname`, `u_lname`, `Age`, `gender`, `Email`,`Phone_number`, `password`) VALUES 
            ('$Fname', '$Lname', '$Age', '$Gender', '$Email','$Phone','$password')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<script>alert('Signup successful!');</script>";
                echo "<script>window.location.href = 'signup.php?signup=success';</script>";
            } else {
                echo "<script>alert('Signup failed. Please try again.');</script>";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../CSS/signup.css">
    <script>
        function validateForm() {
            const firstName = document.getElementById("firstName").value;
            const lastName = document.getElementById("lastName").value;
            const email = document.getElementById("email").value;
            const phoneNumber = document.getElementById("phoneNumber").value;
            const age = document.getElementById("Age").value;
            const password = document.getElementById("password").value;
            const genderMale = document.getElementById("male").checked;
            const genderFemale = document.getElementById("female").checked;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const phonePattern = /^[0-9]{10}$/;
            const agePattern = /^[1-9][0-9]*$/;

            if (firstName == "" || lastName == "" || email == "" || phoneNumber == "" || age == "" || password == "") {
                alert("All fields are required.");
                return false;
            }

            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            if (!phonePattern.test(phoneNumber)) {
                alert("Please enter a valid 10-digit phone number.");
                return false;
            }

            if (!agePattern.test(age)) {
                alert("Please enter a valid age.");
                return false;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters long.");
                return false;
            }

            if (!genderMale && !genderFemale) {
                alert("Please select your gender.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
<?php include '../html/header2.html'; ?>
    <div class="signup-container">
        <div class="wrapper">
            <form action="" method="POST" class="signup-form" onsubmit="return validateForm()">
                <h2>Student Registration</h2>
                <div class="input-group">
                    <input type="text" name="FirstName" id="firstName" placeholder="First Name" required>
                    <input type="text" name="LastName" id="lastName" placeholder="Last Name" required>
                    <input type="email" name="Email" id="email" placeholder="Email" required>
                    <input type="tel" id="phoneNumber" name="PhoneNumber" class="rounded-rectangle" placeholder="Phone Number" required>
                    <input type="number" id="Age" name="Age" class="rounded-rectangle" placeholder="Age" required>
                </div>
                <div>
                    Gender 
                    <input type="radio" id="male" name="gender" value="M" required> Male
                    <input type="radio" id="female" name="gender" value="F" required> Female
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
