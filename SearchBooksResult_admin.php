<?php
include 'dbinfo.php';
?>
<?php
session_start();
$link = mysqli_connect($host, $user, $pass) or die("Unable to connect");
mysqli_select_db($link, $database) or die("Unable to select database");
$username = $_SESSION['username'];

if ($_POST['isbn'] != null) {
    $isbn = $_POST['isbn'];
    $sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where ISBN = '$isbn' AND IsReserved = 'no'";
    $result1 = mysqli_query($link, $sql_query1)  or die(mysqli_error($link));
    if ($result1 == false) {
        echo 'The query by ISBN failed.';
        exit();
    }
    $sql_query2 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where ISBN = '$isbn' AND IsReserved = 'yes'";
    $result2 = mysqli_query($link, $sql_query2)  or die(mysqli_error($link));
    if ($result2 == false) {
        echo 'The query by ISBN failed.';
        exit();
    }
} elseif ($_POST['dept'] != null) {
    $dept = $_POST['dept'];
    $_SESSION['dept'] = $dept; // store session data
    $sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where Dept like '%$dept%' AND IsReserved = 'no'";
    $result1 = mysqli_query($link, $sql_query1)  or die(mysqli_error($link));
    if ($result1 == false) {
        echo 'The query by Title failed.';
        exit();
    }
    $sql_query2 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where Dept like '%$dept%' AND IsReserved = 'yes'";
    $result2 = mysqli_query($link, $sql_query2)  or die(mysqli_error($link));
    if ($result2 == false) {
        echo 'The query by Category failed.';
        exit();
    }
} elseif ($_POST['title'] != null) {
    $title = $_POST['title'];
    $_SESSION['title'] = $title;    // store session data
    $sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where Title like '%$title%' AND IsReserved = 'no'";
    $result1 = mysqli_query($link, $sql_query1)  or die(mysqli_error($link));
    if ($result1 == false) {
        echo 'The query by Title failed.';
        exit();
    }
    $sql_query2 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where Title like '%$title%' AND IsReserved = 'yes'";
    $result2 = mysqli_query($link, $sql_query2)  or die(mysqli_error($link));
    if ($result2 == false) {
        echo 'The query by ISBN failed.';
        exit();
    }
} elseif ($_POST['author'] != null) {    // author part not complete...
    $author = $_POST['author'];
    $_SESSION['author'] = $author; // store session data
    $sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where Author like '%$author%' AND IsReserved = 'no'";
    $result1 = mysqli_query($link, $sql_query1)  or die(mysqli_error($link));
    if ($result1 == false) {
        echo 'The query by Author failed.';
        exit();
    }
    $sql_query2 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where Author like '%$author%' AND IsReserved = 'yes'";
    $result2 = mysqli_query($link, $sql_query2)  or die(mysqli_error($link));
    if ($result1 == false) {
        echo 'The query by Author failed.';
        exit();
    }
} else
    header('Location: SearchBooks_admin.php');
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

        #submitForm {
            background-color: #000000;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 6px;
            color: #fff;
            font-family: 'Oswald';
            font-size: 20px;
            text-decoration: none;
            cursor: pointer;
            border: none;
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
    <center><I><U>
                <h1>Unreserved Books</h1>
            </U></I></center>
    <table id="booksResult">
        <tr>
            <th>ISBN</th>
            <th>Title of Book</th>
            <th>Edition</th>
            <th>Publisher</th>
            <th>Author</th>
            <th>Department</th>
            <th>Cost</th>
            <th># Total Copies</th>
            <th># Available Copies</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($result1)) {

            $ISBN = $row['ISBN'];
            $Title = $row['Title'];
            $Edition = $row['Edition'];
            $Publisher = $row['Publisher'];
            $Author = $row['Author'];
            $Dept = $row['Dept'];
            $Cost = $row['Cost'];
            $NoOfCopy = $row['NoOfCopy'];
            $AvailableCopy = $row['AvailableCopy'];
        ?>
            <tr>
                <td><?php echo $ISBN; ?></td>
                <td><?php echo $Title; ?></td>
                <td><?php echo $Edition; ?></td>
                <td><?php echo $Publisher; ?></td>
                <td><?php echo $Author; ?></td>
                <td><?php echo $Dept; ?></td>
                <td><?php echo $Cost; ?></td>
                <td><?php echo $NoOfCopy; ?></td>
                <td><?php echo $AvailableCopy; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <center><I><U>
                <h1>Reserved Books</h1>
            </U></I></center>
    <table id="booksResult">
        <tr>
            <th>ISBN</th>
            <th>Title of Book</th>
            <th>Edition</th>
            <th>Publisher</th>
            <th>Author</th>
            <th>Department</th>
            <th>Cost</th>
            <th># Total Copies</th>
            <th># Available Copies</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($result2)) {
            $ISBN = $row['ISBN'];
            $Title = $row['Title'];
            $Edition = $row['Edition'];
            $Publisher = $row['Publisher'];
            $Author = $row['Author'];
            $Dept = $row['Dept'];
            $Cost = $row['Cost'];
            $NoOfCopy = $row['NoOfCopy'];
            $AvailableCopy = $row['AvailableCopy'];
        ?>
            <tr>
                <td><?php echo $ISBN; ?></td>
                <td><?php echo $Title; ?></td>
                <td><?php echo $Edition; ?></td>
                <td><?php echo $Publisher; ?></td>
                <td><?php echo $Author; ?></td>
                <td><?php echo $Dept; ?></td>
                <td><?php echo $Cost; ?></td>
                <td><?php echo $NoOfCopy; ?></td>
                <td><?php echo $AvailableCopy; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    </form>
    <br><br>
    <center>
        <form action="SearchBooks_admin.php" method="post">
            <input type="submit" class="btn btn-secondary" value="Back" id="submitForm" />
        </form>
    </center>
</body>
</html>
