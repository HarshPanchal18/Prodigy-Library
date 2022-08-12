<?php
include 'dbinfo.php';
?>
<?php
session_start();
if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = $_POST['username']; // text field for username
    $password = $_POST['password']; // text field for password
}

$_SESSION['username'] = $username; //store session data
$link = mysqli_connect($host, $user, $pass) or die("Unable to connect");
mysqli_select_db($link, $database) or die("Unable to select database");
$flag = 1; // if admin is found, don't check for student
$sql_query = "select Username from admin where Username= '$username' and Password= '$password'";
$result1 = mysqli_query($link, $sql_query)  or die(mysqli_error($link));

if ($result1 == false) {
    echo 'The query failed...';
    exit();
}
if ($result1)
    if (mysqli_num_rows($result1) == 1) {
        //the username and password matches the admin database 
        //move them to the page to which they need to go 
        $flag = 0;
        header('Location: AdminSummary.php');
    }
if ($flag) {
    $sql_query = "select Username from user where Username= '$username' and Password= '$password'";
    $result1 = mysqli_query($link, $sql_query)  or die(mysqli_error($link));
    if ($result1 == false) {
        echo 'The query failed...';
        exit();
    }
    if (mysqli_num_rows($result1) == 1) { //this is where the actual verification happens 
        //the username and password matches the user database 
        //move them to the page to which they need to go 
        header('Location: UserSummary.php');
    } else
        $err = '<b>Incorrect username or password.  ;(</b>';
}
//then just above your login form or where ever you want the error to be displayed you just put in 
echo "<center>$err</center>";
?>
