<?php
/*
define('DBSERVER', 'localhost'); // Database server
define('DBUSERNAME', 'prokjs'); // Database username
define('DBPASSWORD', 'prokjs'); // Database password
define('DBNAME', '360_project'); // Database name
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