<?php
/*
define('DBSERVER', 'cosc360.ok.ubc.ca'); // Database server
define('DBUSERNAME', '31368871'); // Database username
define('DBPASSWORD', '31368871'); // Database password
define('DBNAME', 'db_31368871'); // Database name
*/
//Riley's Testing

define('DBSERVER', 'localhost'); // Database server
define('DBUSERNAME', 'rcomer'); // Database username
define('DBPASSWORD', 'RileyDeanComer2001'); // Database password
define('DBNAME', '360_project'); // Database name


$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);
 
// Check db connection
if($db === false){
    die("Error: connection error. " . mysqli_connect_error());
}
?>