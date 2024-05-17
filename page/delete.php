<?php
      require_once('config.php');
      
      if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        
        // Delete the user from the database using the provided ID
        $sql = "DELETE FROM users WHERE id ='$id'";
      
        if ($conn->query($sql) === TRUE) {
          // User deleted successfully
          echo "User deleted successfully";
        } else {
          echo "Error deleting user: " . $conn->error;
        }
      }

      if (isset($_GET['id'])) {
        $id=$_GET['id'];
        
        
        // Delete the user from the database using the provided ID
        $sql = "DELETE FROM `notifications` WHERE `id` ='$id'";
      
        if ($conn->query($sql) === TRUE) {
          // User deleted successfully
          header('LOCATION:Notifications.php');
        } else {
          echo "Error deleting user: " . $conn->error;
        }
        
      }

    ?>