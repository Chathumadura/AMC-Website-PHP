
<?php require_once ('Connection.php');?>
<?php

session_start();    //check for from submission
    if(isset($_POST['submit'])){    
            $errors = array();
        //check if the  username and password has beenn entered
                if(!isset($_POST['username'])|| strlen(trim($_POST['username'])) < 1){
                     $errors[] = 'Username is Missing / Invalid';
                }
                if(!isset($_POST['password'])|| strlen(trim($_POST['password'])) < 1){
                    $errors[] = 'password is Missing / Invalid';
               }
               //check if there are any errors in the form
               if(empty($errors)){
                    
                    $Email = mysqli_real_escape_string($conn,$_POST['username']);
                    $password = mysqli_real_escape_string($conn,$_POST['password']);
            
                    $query= "SELECT * FROM `user_reg` WHERE `Email`='$Email'  AND `password`='$password' LIMIT 1";
            
                $result_set =mysqli_query($conn,$query);
                $datas=mysqli_fetch_assoc($result_set);
            
                if($result_set){
                    if(mysqli_num_rows($result_set)==1){
                        $_SESSION["auth"]=true;
                        $_SESSION['id']=$datas['id'];
                        header('LOCATION:admin.php');
                     }
                    else{
                        $errors[] ='Invalid Username / Password';
                        
                   }
                }else{
                    $errors[] ='Database query failed';
                }
            }

           
    

}

?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/login.css"> 

  <title>Login</title>
   <link rel="stylesheet" href="../CSS/signup.css">
   <?php
   include '../html/header.html'
   ?>
</head>
<body>


<div class="body1">
  <div class="wrapper">
    <form action="#">
      <h2>Login</h2>
        <div class="input-field">
        <input type="text" required>
        <label>Enter your email</label>
      </div>
      <div class="input-field">
        <input type="password" required>
        <label>Enter your password</label>
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Remember me</p>
        </label>
        <a href="#">Forgot password?</a>
      </div>
      <button name="submit"  type="submit">Log In</button>
     
    </form>
  </div>
</div>
</body>
</html>