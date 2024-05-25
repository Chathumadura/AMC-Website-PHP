<?php
 include 'Connection.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" href="../css//admin.css">
  <link rel="stylesheet" href="../css/home.css"> 

</head>
<body >
    <nav>
        <div class="menu">
          <div class="logo">
            <a href="#">AMC International School</a>
          </div>
          <ul>
            <li><a href="admin.php">Home</a></li>
            <li><a href="../html/about.html">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="login.php">Logout</a></li>
          </ul>
        </div>
      </nav>
      

<div class="hero-section">
    <div class="hero-content">
      <h1>Welcome to AMC International School</h1>
      <p>Brief overview of recent activity, statistics, or important updates..</p>
      <div class="subject-buttons">
        <a href="signup.php" class="button1">Student Registration</a>
        <a href="subject.php" class="button1">Subject Management</a>
      </div>
    </div>
</div>

</body>
</html>

