<?php
include 'dbinfo.php';
?>
<?php
session_start();
$link = mysqli_connect($host, $user, $pass) or die("Unable to connect");
mysqli_select_db($link, $database) or die("Unable to select database");
$username = $_SESSION['username'];

if ($_POST['isbn'] != null) { // ISBN
    $isbn = $_POST['isbn'];
    $sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, AvailableCopy From book Where ISBN = '$isbn' AND IsReserved = 'no'";
    $result1 = mysqli_query($link, $sql_query1)  or die(mysqli_error($link));

    if ($result1 == false) {
        echo 'The query by ISBN failed.';
        exit();
    }
} elseif ($_POST['title'] != null) {
    $title = $_POST['title'];
    $_SESSION['title'] = $title; // store session data
    $sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, AvailableCopy From book Where Title like '%$title%' AND IsReserved = 'no'";
    $result1 = mysqli_query($link, $sql_query1)  or die(mysqli_error($link));
    if ($result1 == false) {
        echo 'The query by Title failed.';
        exit();
    }
} elseif ($_POST['dept'] != null) {
    $dept = $_POST['dept'];
    $_SESSION['dept'] = $dept;
    $sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, AvailableCopy From book Where Dept like '%$dept%' AND IsReserved = 'no'";
    $result1 = mysqli_query($link, $sql_query1)  or die(mysqli_error($link));
    if ($result1 == false) {
        echo 'The query by Department failed.';
        exit();
    }
} elseif ($_POST['author'] != null) {
    $author = $_POST['author'];
    $_SESSION['author'] = $author;
    $sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, AvailableCopy From book Where Author like '%$author%' AND IsReserved = 'no'";
    $result1 = mysqli_query($link, $sql_query1)  or die(mysqli_error($link));
    if ($result1 == false) {
        echo 'The query by Author failed.';
        exit();
    }
} else
    header('Location: SearchBooks_user.php');

$numrow = mysqli_num_rows($result1);
if ($numrow == 0)
    echo 'There are no available copies right now.';
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
            <h1>Search Results for Books</h1>
        </I></center>
    <table id="booksResult">
        <tr>
            <th>ISBN</th>
            <th>Title of the book</th>
            <th>Edition</th>
            <th>Publisher</th>
            <th>Authors</th>
            <th>Department</th>
            <th># copies available</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($result1)) {
            $ISBN = $row['ISBN'];
            $Title = $row['Title'];
            $Edition = $row['Edition'];
            $publisher = $row['Publisher'];
            $Author = $row['Author'];
            $dept = $row['Dept'];
            $available = $row['AvailableCopy'];
        ?>
            <tr>
                <td><?php echo $ISBN; ?></td>
                <td><?php echo $Title; ?></td>
                <td><?php echo $Edition; ?></td>
                <td><?php echo $publisher; ?></td>
                <td><?php echo $Author; ?></td>
                <td><?php echo $dept; ?></td>
                <td><?php echo $available; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>

    <br><br>
    <center>
        <form action="SearchBooks_user.php" method="post">
            <input type="submit" class="btn btn-warning" value="BACK">
        </form>
    </center>
</body>
</html>
