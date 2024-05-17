<?php
include 'Connection.php';

if(isset($_POST['delete'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    if($conn){
        $sql = "DELETE FROM subject_m WHERE id='$id'";
        if(mysqli_query($conn, $sql)){
            header("Location:subject.php?delete=success");
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
