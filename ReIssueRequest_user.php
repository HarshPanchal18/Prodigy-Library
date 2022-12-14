<?php
include 'dbinfo.php';
?>
<?php
session_start();
$link = mysqli_connect($host, $user, $pass) or die("Unable to connect");
mysqli_select_db($link, $database) or die("Unable to select database");
$username = $_SESSION['username'];
if (isset($_POST['isbn1'])) {
    $isbn1 = $_POST['isbn1'];
    $check_qry = "select * from issue where Username='$username' and ISBN='$isbn1'";
    $result0 = mysqli_query($link, $check_qry)  or die(mysqli_error($link));

    if (mysqli_num_rows($result0) == 0)
        echo '<center><B><br>This book is not issued on your name, Please enter valid ISBN</B></center><br><br>';
    else {
        $row = mysqli_fetch_array($result0);
        $ExtRequest = $row['ExtRequest'];
        if ($ExtRequest == "requested")
            echo '<center><B><br>You have already Requested for Re-Issue, But it is not yet approved :(</B></center><br><br>';
        else {
            $qry1 = "update issue set ExtRequest='requested' where Username='$username' and ISBN='$isbn1'";
            $result1 = mysqli_query($link, $qry1)  or die(mysqli_error($link));
            if ($result1 == true)
                echo '<center><B><br>Re-Issue request successfully sent, It will be approved/rejected by Admin. Meanwhile you can see your approval status.</B></center><br><br>';
            else
                echo '<center><B><br>Query for Re-Issue request Failed!</B></center><br><br>';
        }
    }
} else if (isset($_POST['isbn2'])) {
    $isbn2 = $_POST['isbn2'];
    $check_qry = "select * from issue where Username='$username' and ISBN='$isbn2'";
    $result0 = mysqli_query($link, $check_qry)  or die(mysqli_error($link));
    if (mysqli_num_rows($result0) == 0)
        echo '<center><B><br>This book is not issued on your name, Please enter valid ISBN</B></center><br><br>';
    else {
        $row = mysqli_fetch_array($result0);
        $ExtRequest = $row['ExtRequest'];
        if ($ExtRequest == "requested")
            echo '<center><B><br>Your last Re-Issue request is not yet approved :(</B></center><br><br>';
        else if ($ExtRequest == "rejected")
            echo '<center><B><br>Your last Re-Issue request has been Rejected, Please contact Admin or You can send re-issue request again.</B></center><br><br>';
        else if ($ExtRequest == "accepted")
            echo '<center><B><br>Your last Re-Issue request has been Accepted :) . You can see your Return deadlines in *My Issued Book* section.</B></center><br><br>';
        else echo '<center><B><br>No Re-Issue request has been sent for this Book.</B></center><br><br>';
    }
}
?>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #tableData1 {
            background-color: mediumseagreen;
            border-radius: 20px;
            width: 50%;
        }

        #tableData2 {
            background-color: darkolivegreen;
            border-radius: 20px;
            width: 50%;
        }

        body {
            background-color: #939aed;
        }
    </style>
</head>

<body>

    <br><br>
    <table style="width:100%">
        <tr>
            <td id="tableData1">
                <center>
                    <h1>Request Re-Issue</h1>
                    <form action="" method="post">
                        <table>
                            <tr>
                                <td><b>ISBN: </b></td>
                                <td><input type="text" name="isbn1" required /></td>
                            </tr>
                        </table>
                        <br>
                        <input type="submit" value="Send Request" class="btn btn-info">
                    </form>
                </center>
            </td>
            <td id="tableData2">
                <center>
                    <h1>Check Re-Issue Approval Status</h1>
                    <form action="" method="post">
                        <table>
                            <tr>
                                <td><b>ISBN: </b></td>
                                <td><input type="text" name="isbn2" required /></td>
                            </tr>
                        </table>
                        <br>
                        <input type="submit" value="Check Status" class="btn btn-info">
                    </form>
                </center>
            </td>
        </tr>
    </table>
    <br><br>
    <center>
        <form action="UserSummary.php" method="post">
            <input type="submit" value="HOME" class="btn btn-warning">
        </form>
    </center>
</body>
</html>
