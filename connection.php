<?php
define('dbHostname', 'localhost');
define('dbUserName', 'root');
define('dbPassword', '');
define('dbName', 'al_hayat');
$con = new mysqli(dbHostname, dbUserName, dbPassword, dbName);
if (!$con) {
    die(mysqli_error($con));
}
?>