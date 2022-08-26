<?php
include 'dbinfo.php';
?>
<?php
session_start();
$link = mysqli_connect($host, $user, $pass) or die("Unable to connect");
mysqli_select_db($link, $database) or die("Unable to select database");

if (isset($_POST['isbn']) and isset($_POST['username'])) {
    $isbn = $_POST['isbn'];
    $username = $_POST['username'];
    $check_qry = "select * from issue where ISBN='$isbn' and Username='$username'";
    $result0 = mysqli_query($link, $check_qry)  or die(mysqli_error($link));

    if (mysqli_num_rows($result0) == 0)
        echo 'The Book is NOT Issued on this user, Issue first, OR maybe one of the Username or ISBN entered is incorrect!';
    else {
        // we are not checking No. of Extension limit.
        $row = mysqli_fetch_array($result0);
        $returnDate = $row['ReturnDate'];

        $qry1 = "update issue set ReturnDate = adddate('$returnDate', interval 15 day), NoOfExtention = NoOfExtention+1, ExtRequest='approved' where Username = '$username' and ISBN='$isbn'"; // next 15 days limit...

        $result1 = mysqli_query($link, $qry1)  or die(mysqli_error($link));
        if ($result1 == false) {
            echo 'The query failed.';
            exit();
        } else {
            //header('Location: Login.php');
            echo 'Book Re-Issue successful:)';
        }
    }
}
?>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            background-color: #c4def2;
        }

        h1 {
            color: red;
        }
    </style>
</head>

<body>
    <center>
        <br><br>
        <U><I>
                <h1>Book Re-Issuing Window</h1>
            </I></U>
        <br>
        <form action="" method="post">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" required /></td>
                </tr>
                <tr>
                    <td>ISBN</td>
                    <td><input type="text" name="isbn" required /></td>
                </tr>
            </table>
            <br>
            <input type="submit" value="Update" class="btn btn-success" />
        </form>
        <br>
        <form action="AllReIssueRequests_admin.php" method="post">
            <input type="submit" value="View All Re-Issue Requests" class="btn btn-info" />
        </form>
        <br><br>
        <form action="AdminSummary.php" method="post">
            <input type="submit" value="HOME" class="btn btn-warning" />
        </form>
    </center>
</body>
</html>
