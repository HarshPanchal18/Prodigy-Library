<?php
include 'dbinfo.php';
?>
<?php
session_start();
$link = mysqli_connect($host, $user, $pass) or die("Unable to connect");
mysqli_select_db($link, $database) or die("Unable to select database");
$username = $_SESSION['username'];

if ($_POST['allreissue'] ?? null) {
    $allreissue = $_POST['allreissue'];
    $sql_query2 = "select issue.Username, ISBN, Name, Email, UserType, Dept, Penalty, IssueDate, ReturnDate, NoOfExtention FROM issue inner join stud_fac_emp on issue.Username=stud_fac_emp.Username WHERE ExtRequest='requested'";
    $result2 = mysqli_query($link, $sql_query2)  or die(mysqli_error($link));
    if ($result2 == false) {
        echo '<br><center><B>The query by AllStudent failed!</B></center>';
        exit();
    }
} else if (isset($_POST['isbn']) and isset($_POST['username'])) {
    $isbn = $_POST['isbn'];
    $username = $_POST['username'];

    $check_qry = "select * from issue where ISBN='$isbn' and Username='$username' and ExtRequest='requested'";
    $result0 = mysqli_query($link, $check_qry)  or die(mysqli_error($link));
    if (mysqli_num_rows($result0) == 0)
        echo '<br><center><B>The Book cannot be Re-Issued, because...</B><br>1.Username or ISBN INCORRECT!<br>2.Book not issued to user<br>3.User did not request for Re-issue</center>';
    else { // we are not checking No. of Extension limit.
        $row = mysqli_fetch_array($result0);
        $returnDate = $row['ReturnDate'];
        $qry1 = "update issue set ReturnDate = adddate('$returnDate', interval 15 day), NoOfExtention = NoOfExtention+1, ExtRequest='approved' where Username = '$username' and ISBN='$isbn'"; // next 15 days limit...
        $result1 = mysqli_query($link, $qry1)  or die(mysqli_error($link));
        if ($result1 == false) {
            echo '<br><center><B>The query failed !! :( </B></center>';
            exit();
        } else
            echo '<br><center><B>Book Re-Issue successful !! :)</B></center>';
    }
    //To display updated list of re-issue request again
    $sql_query2 = "select issue.Username, ISBN, Name, Email, UserType, Dept, Penalty, IssueDate, ReturnDate, NoOfExtention FROM issue inner join stud_fac_emp on issue.Username=stud_fac_emp.Username WHERE ExtRequest='requested'";
    $result2 = mysqli_query($link, $sql_query2)  or die(mysqli_error($link));
    if ($result2 == false)
        exit();
} else
    echo '<br><center><B>Sorry! Request cannot be performed!</B></center>';
?>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #booksResult {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #booksResult td,
        #booksResult th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #booksResult tr:nth-child(even) {
            background-color: #dbf4f9;
        }

        #booksResult tr:nth-child(odd) {
            background-color: #dcdff7;
        }

        #booksResult tr:hover {
            background-color: #aaf7bd;
        }

        #booksResult th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }

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
        <br>
        <U><I>
                <h1>Book Re-Issuing Window</h1>
            </I></U>
        <br>
        <form action="" method="post">
            <table>
                <tr>
                    <td><B>Username: </B></td>
                    <td><input type="text" name="username" required /></td>
                </tr>
                <tr>
                    <td><B>ISBN: </B></td>
                    <td><input type="text" name="isbn" required /></td>
                </tr>
            </table>
            <br>
            <input type="submit" value="Update" class="btn btn-primary" />
        </form>
        <br>
    </center>
    <hr>
    <hr>
    <center><I>
            <h1>All Re-Issue Requests</h1>
        </I></center>
    <table id="booksResult">
        <tr>
            <th>Username</th>
            <th>ISBN</th>
            <th>Name of User</th>
            <th>Email</th>
            <th>Type of User</th>
            <th>Department</th>
            <th>Penalty Amount</th>
            <th>IssueDate</th>
            <th>ReturnDate</th>
            <th>NoOfExtention</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($result2)) {
            $Username = $row['Username'];
            $ISBN = $row['ISBN'];
            $Name = $row['Name'];
            $Email = $row['Email'];
            $UserType = $row['UserType'];
            $Department = $row['Dept'];
            $PenaltyAmount = $row['Penalty'];
            $IssueDate = $row['IssueDate'];
            $ReturnDate = $row['ReturnDate'];
            $NoOfExtention = $row['NoOfExtention'];
        ?>
            <tr>
                <td><?php echo $Username; ?></td>
                <td><?php echo $ISBN; ?></td>
                <td><?php echo $Name; ?></td>
                <td><?php echo $Email; ?></td>
                <td><?php echo $UserType; ?></td>
                <td><?php echo $Department; ?></td>
                <td><?php echo $PenaltyAmount; ?></td>
                <td><?php echo $IssueDate; ?></td>
                <td><?php echo $ReturnDate; ?></td>
                <td><?php echo $NoOfExtention; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br>
    <form action="AdminSummary.php" method="post">
        <center>
            <input type="submit" value="HOME" class="btn btn-warning" />
        </center>
    </form>
</body>
</html>
