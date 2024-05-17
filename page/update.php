<?php
require_once('Connection.php'); 
if(isset($_POST['update'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $moduleName = mysqli_real_escape_string($conn, $_POST['moduleName']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if($conn){
        $sql = "UPDATE subject_m SET module='$moduleName', description='$description' WHERE id='$id'";
        if(mysqli_query($conn, $sql)){
            header("Location: subject.php?update=success");
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
