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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Feul</title>
   
    
</head>
<body>

    <!--navigation Bar Beggining-->
    <div class="navBar">
        <!--LOGO-->
        <div class="nav">
            <h1 style="margin-left: 30px;">LOGO</h1>
        </div>
        <!--NAVIGATION OPTIONS-->
        <div class="nav">
            <a href="home.html" class="btn">
                <span> HOME</span>
            </a>
            <a href="about.html" class="btn">
                <span> ABOUT </span>
            </a> 
            <a href="contact.html" class="btn">
                <span> CONTACT</span>
            </a>
        </div>
        <!--LOGIN IMAGE-->
        <div class="nav">
            <a href="signup.php" class="btn">
                <span> Signup </span>
                <span class="log"> 👤</span> </a>
        </div> 
    </div>
    <div class="box" >
        <div class="login">
        <form action="loginpage.php" method="POST">
            <h2>Log in</h2>
            <select name ="option" id="option">
                    <option>Patient</option>
                    <option>Fitness trainer</option>
                    <option>Dietician</option>
                    <option>Docter</option>
                    <option>Finance Manager</option>
                    <option>Administrators</option>

                </select>
          
          <?php
                if(isset($errors) && !empty($errors)){
                    echo '<p class="error">Invalid Username / Password </p>';
                }
            ?>
            
            <P> <input  class="rec" type="text" name="username" placeholder="Email"></P> 
            <p><input class="rec" type="password" name="password" placeholder="Password"></p>
            <p class="g1"> <a href ="#">Forgot Password</a> </p>
            <p><button type="submit" name="submit" class="g6"> Log In</button></p>
            
            
        
            <p> <a href=""> <img class="icon"  src=""></a></p>
            <p> <a href="#"><img  class="icon" src="" alt="Facebook" ></a>
                
            <p> Still don't have an account ?<a href="signup.php">Signup</a></p>

         </form>
        </div>
    </div>
    <!--Footer-->
 <footer>
        <div class="contact">
            

        <h1>contact us</h1>
                <img src="" alt="" height="100px" width="230px" style="border-radius: 8px;">
                
            </div>
            
            
        </div>

        <div class="backtotop">
            <div>
                <a href="#c5" style="text-decoration: none;color: white;"><h2>BACK TO TOP</h2></a>
                <br>
                <br><br>
                    <label for="FAQ" style="font-size: 20px;"> ABOUT FAQ's</label>

                <input type="text" name="FAQ" id="FAQ">
                <input type="submit" value="submit" id="FAQ">
            </div>


        </div>
        <div class="address">
            <h1>Address</h1>
            <p>
                Lorem ipsum dolor sit amet consectetur, <br>
                adipisicing elit. Cum labore, minima re <br>
                prehenderit accusantium officia odit mi <br>
                nus similique, inventore esse alias acc <br>
                
            </p>
        </div>
    </footer>

    </body>
</html>
