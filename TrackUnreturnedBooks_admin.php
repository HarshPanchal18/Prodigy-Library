<?php
include 'dbinfo.php';
?>
<?php
session_start();
$link = mysqli_connect($host, $user, $pass) or die("Unable to connect");
mysqli_select_db($link, $database) or die("Unable to select database");
$username = $_SESSION['username'];
if ($_POST['checkedbooks'] != null) {
    $checkedbooks = $_POST['checkedbooks'];
    $_SESSION['checkedbooks'] = $checkedbooks; // store session data
    $sql_query1 = "select issue.ISBN, Title, Edition, Publisher, Cost, IssueDate, ReturnDate, NoOfExtention, issue.Username, Name, UserType, Email from issue, book, stud_fac_emp as sf where issue.ISBN=book.ISBN and issue.Username=sf.Username";
    $result1 = mysqli_query($link, $sql_query1)  or die(mysqli_error($link));
    if ($result1 == false) {
        echo 'The query by Issued Books failed.';
        exit();
    }
} else
    header('Location: AdminSummary.php');
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
            background-color: #e8eff9;
        }

        h1 {
            color: red;
        }
    </style>
</head>

<body>
    <center><I>
            <h1>Unreturned Book Details</h1>
        </I></center>
    <table id="booksResult">
        <tr>
            <th>ISBN</th>
            <th>Title of Book</th>
            <th>Edition</th>
            <th>Publisher</th>
            <th>Cost</th>
            <th>IssueDate</th>
            <th>ReturnDate</th>
            <th># Extention Taken</th>
            <th>Username</th>
            <th>Name</th>
            <th>UserType</th>
            <th>Email</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($result1)) {
            $ISBN = $row['ISBN'];
            $Title = $row['Title'];
            $Edition = $row['Edition'];
            $Publisher = $row['Publisher'];
            $Cost = $row['Cost'];
            $IssueDate = $row['IssueDate'];
            $ReturnDate = $row['ReturnDate'];
            $NoOfExtention = $row['NoOfExtention'];
            $Username = $row['Username'];
            $Name = $row['Name'];
            $UserType = $row['UserType'];
            $Email = $row['Email'];
        ?>
            <tr>
                <td><?php echo $ISBN; ?></td>
                <td><?php echo $Title; ?></td>
                <td><?php echo $Edition; ?></td>
                <td><?php echo $Publisher; ?></td>
                <td><?php echo $Cost; ?></td>
                <td><?php echo $IssueDate; ?></td>
                <td><?php echo $ReturnDate; ?></td>
                <td><?php echo $NoOfExtension; ?></td>
                <td><?php echo $Username; ?></td>
                <td><?php echo $Name; ?></td>
                <td><?php echo $UserType; ?></td>
                <td><?php echo $Email; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br><br>
    <center>
        <form action="AdminSummary.php" method="post">
            <input type="submit" value="HOME" class="btn btn-warning">
        </form>
    </center>
</body>
</html>
