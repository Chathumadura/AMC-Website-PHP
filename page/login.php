<!DOCTYPE html>

<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/login.css">

  <title>Login</title>
  
  <?php
  include '../html/header.html'
  ?>
</head>

<body>
<div class="menu">
              <div class="logo">
                <a href="#">AMC International School</a>
              </div>
             <ul>
                <li><a href="../html/home.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                
              </ul>
            </div>
          </nav>
    


  <div class="body1">
    <div class="wrapper">
      <form action="loginback.php" method="POST">
        <h2 class="l1">Login</h2>
        <div class="input-field">
          <input type="text" name="username" required>
          <label>Enter your email</label>
        </div>
        <div class="input-field">
          <input type="password" name="password" required>
          <label>Enter your password</label>
        </div>
        <div class="forget">
          <label for="remember">
            <input type="checkbox" id="remember">
            <p>Remember me</p>
          </label>
          <a href="#">Forgot password?</a>
        </div>
        <button name="submit" type="submit">Log In</button>

      </form>
    </div>
  </div>
</body>

</html>