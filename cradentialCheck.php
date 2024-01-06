<?php
include "./connection.php";
session_start();

if (isset($_POST['Usubmit'])) {
    $Uname = $_POST['username'];
    $Apassword = $_POST['password'];

    if ($_POST['Usubmit'] == 'user') {
        $qry = "SELECT * FROM register WHERE UserName='" . $Uname . "' AND Password='" . $Apassword . "'";
        $result = $con->query($qry);

        if (mysqli_num_rows($result) > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['ID'] = $row['ID'];
            $_SESSION['UserName'] = $row['UserName'];
            header("Location: ./home.php");
            exit();
        } else {
            header("Location: ./account.php?er='error'");
            exit(); 
        }
    } elseif ($_POST['Usubmit'] == 'admin') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $qry = "SELECT * FROM admin WHERE username='" . $username . "' AND password='" . $password . "'";
        $result = $con->query($qry);

        if (mysqli_num_rows($result) > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['AdminID'] = $row['id'];
            header("Location: ./home.php");
            exit();
        } else {
            header("Location: ./account.php?er='error'");
            exit();
        }
    }

    $con->close();
}
?>
