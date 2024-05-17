<?php
require_once('config.php');
if (isset($_GET['id'])) {
        $id=$_GET['id'];  ?>
        

        <form action="#" class="formContainer" method="POST">
          <span color="back"><h2>Update</h2></span>
          <input type="hidden" name="id" id="deleteUserId" value="<?=$id;?>" />
          <input type="text" name="msg">Message
          <p id="delete"></p>
          <button type="submit"  name="update" class="btnd">Update</button>
          <button type="button" class="cancel" onclick="deleteUser(id)">Close</button>
        </form>
        
      <?php  
        
      }

      if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $msg = $_POST['msg'];

        
        // Delete the user from the database using the provided ID
        $sql = "UPDATE `notifications` SET`message`='$msg' WHERE `id`='$id' ";
      
        if ($conn->query($sql) === TRUE) {
          // User deleted successfully
          header('LOCATION:Notifications.php');
        } else {
          echo "Error deleting user: " . $conn->error;
        }
      }




      ?>