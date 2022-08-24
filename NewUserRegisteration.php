<?php
include 'dbinfo.php';
?>
<?php
session_start();
$link = mysqli_connect($host, $user, $pass) or die("Unable to connect");
mysqli_select_db($link, $database) or die("Unable to select database");

if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['confirmpassword'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['confirmpassword'] = $confirmpassword;

    if ($password == $confirmpassword) {
        $checkit = "select * from user where Username = '$username'";
        $result = mysqli_query($link, $checkit)  or die(mysqli_error($link));
        if ($result == false) {
            echo 'The query failed.';
            exit();
        } else if (mysqli_num_rows($result) > 0)
            echo 'Username already exists, Try another!!!';
        else
            header('Location: CreateProfile.php');
    } else
        echo 'password not consistent';
}
?>

<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <h1>New User Registration</h1>
    <form action="" method="post">
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" required /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="text" name="password" required /></td>
            </tr>
            <tr>
                <td>Confirm Password</td>
                <td><input type="text" name="confirmpassword" required /></td>
            </tr>
        </table>
        <input type="submit" value="Register" />
    </form>
    <form action="index.php" method="post">
        <input class="btn btn-danger" type="submit" value="Logout  --]">
    </form>
</body>
</html>
