<?php
include './connection.php';
if (isset($_POST['user_delete'])) {
    $user_id = $_POST['user_delete'];
    $qry = "DELETE FROM contact WHERE ID='$user_id'";
    $result = mysqli_query($con, $qry);
    if ($result) {
        $_SESSION['message']="Request Rejected Sucessfully";
        header('location:admin.php');
        exit(0);
       
    } else {
       
        echo "error" . $con->connect_error;
    }
}

?>