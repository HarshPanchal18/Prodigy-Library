<?php
include 'dbinfo.php';
?>
<?php
session_start();
$link = mysqli_connect($host, $user, $pass) or die("Unable to connect");
mysqli_select_db($link, $database) or die("Unable to select database");

if (isset($_POST['isbn']) and isset($_POST['title']) and isset($_POST['author']) and isset($_POST['edition']) and isset($_POST['publisher']) and isset($_POST['cost']) and isset($_POST['noofcopies'])) {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $edition = $_POST['edition'];
    $publisher = $_POST['publisher'];
    $author = $_POST['author'];
    $cost = $_POST['cost'];
    $noofcopies = $_POST['noofcopies'];
    $AvailableCopy = $noofcopies;
    $isreserved = $_POST['isreserved'];
    $dept = $_POST['dept'];

    $check_qry = "select * from book where ISBN='$isbn'";
    $result0 = mysqli_query($link, $check_qry)  or die(mysqli_error($link));

    if (mysqli_num_rows($result0) > 0) echo '<center><B><br>Book with this ISBN already exists, Try Updating!</B></center><br><br>';
    else {
        $insertStatement1 = "INSERT INTO book (ISBN, Title, Edition, Publisher, Author, Dept, Cost, IsReserved, NoOfCopy, AvailableCopy) VALUES ('$isbn', '$title', '$edition', '$publisher', '$author', '$dept', '$cost', '$isreserved', '$noofcopies', '$AvailableCopy')";
        $result1 = mysqli_query($link, $insertStatement1)  or die(mysqli_error($link));

        if ($result1 == false) {
            echo '<center><B><br>The query failed!</B></center><br><br>';
            exit();
        } else {
            //header('Location: index.php');
            echo '<center><B><br>Book Insertion successful</B></center><br><br>';
        }
    }
} else if (isset($_POST['isbn1']) and isset($_POST['noofcopies1'])) {
    $isbn1 = $_POST['isbn1'];
    $noofcopies1 = $_POST['noofcopies1'];

    $check_qry = "select * from book where ISBN='$isbn1'";
    $result0 = mysqli_query($link, $check_qry)  or die(mysqli_error($link));
    if (mysqli_num_rows($result0) == 0) echo '<center><B><br>Book with this ISBN does not exist</B></center><br><br>';
    else {
        $updateStatement1 = "update book set NoOfCopy=NoOfCopy+'$noofcopies1', AvailableCopy=AvailableCopy+'$noofcopies1' where ISBN='$isbn1'";
        $result1 = mysqli_query($link, $updateStatement1)  or die(mysqli_error($link));

        if ($result1 == false) {
            echo '<center><B><br>The query failed!</B></center><br><br>';
            exit();
        } else {
            //header('Location: index.php');
            echo '<center><B><br>Book Updation successful!!</B></center><br><br>';
        }
    }
} else if (isset($_POST['isbn2'])) {
    $isbn2 = $_POST['isbn2'];

    $check_qry = "select * from book where ISBN='$isbn2'";
    $result0 = mysqli_query($link, $check_qry)  or die(mysqli_error($link));
    if (mysqli_num_rows($result0) == 0) echo '<center><B><br>Book with this ISBN does not exist</B></center><br><br>';
    else { // delete that ISBN from all tables...
        $deleteStatement1 = "delete from issue where ISBN='$isbn2'";
        $deleteStatement2 = "delete from book where ISBN='$isbn2'";
        $result1 = mysqli_query($link, $deleteStatement1)  or die(mysqli_error($link));
        $result2 = mysqli_query($link, $deleteStatement2)  or die(mysqli_error($link));

        if ($result1 == false || $result2 == false) {
            echo '<center><B><br>The query failed!</B></center><br><br>';
            exit();
        } else {
            //header('Location: index.php');
            echo '<center><B><br>Book Data Deletion successful!!</B></center><br><br>';
        }
    }
}
?>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #tableData2 {
            background-color: lightgreen;
            border-radius: 15px;
            width: 50%;
        }

        #tableData3 {
            background-color: lightcoral;
            border-radius: 15px;
            width: 50%;
        }

        body {
            background-color: #939aed;
        }
    </style>
</head>

<body>
    <center>
        <U>
            <h1>Add Book Section</h1>
        </U>
        <h3>Fill Book Details</h3>
        <form action="" method="post">
            <table>
                <tr>
                    <td>ISBN</td>
                    <td><input type="text" name="isbn" required /></td>
                </tr>
                <tr>
                    <td>Title of Book</td>
                    <td><input type="text" name="title" required /></td>
                </tr>
                <tr>
                    <td>Edition</td>
                    <td><input type="text" name="edition" required /></td>
                </tr>
                <tr>
                    <td>Publisher</td>
                    <td><input type="text" name="publisher" required /></td>
                </tr>
                <tr>
                    <td>Authors</td>
                    <td><input type="text" name="author" required /></td>
                </tr>
                <tr>
                    <td>Cost</td>
                    <td><input type="number" name="cost" min="0" step="0.01" required /></td>
                </tr>
                <tr>
                    <td># of copies</td>
                    <td><input type="number" name="noofcopies" min="1" step="1" required /></td>
                </tr>
                <tr>
                    <td>Is the Book Reserved</td>
                    <td>
                        <select name="isreserved">
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Book Category</td>
                    <td>
                        <select name="dept">
                            <option value="Computer Science & Engineering">Computer Science & Engineering</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="Mechanical Engineering">Mechanical Engineering</option>
                            <option value="Civil Engineering">Civil Engineering</option>
                            <option value="Chemical Engineering">Chemical Engineering</option>
                            <option value="Mathematics & Computing">Mathematics & Computing</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="HSS Department">HSS Department</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Physics">Physics</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="Fictional Books">Fictional Books</option>
                            <option value="Biography">Biography</option>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
            <input type="submit" value="Submit" class="btn btn-secondary">
        </form>
    </center>
    <br>
    <table style="width:100%">
        <tr>
            <td id="tableData2">
                <center>
                    <U>
                        <h1>Update Book Section</h1>
                    </U>
                    <form action="" method="post">
                        <table>
                            <tr>
                                <td><b>Enter ISBN</b></td>
                                <td><input type="text" name="isbn1" required /></td>
                            </tr>
                            <tr>
                                <td><b># of copies added</b></td>
                                <td><input type="number" name="noofcopies1" min="1" step="1" required /></td>
                            </tr>
                        </table>
                        <br>
                        <input type="submit" value="Update" class="btn btn-success">
                    </form>
                </center>
            </td>
            <td id="tableData3">
                <center>
                    <U>
                        <h1>Delete Book Section</h1><br>
                    </U>
                    <form action="" method="post">
                        <table>
                            <tr>
                                <td><b>Enter ISBN:</b></td>
                                <td><input type="text" name="isbn2" required /></td>
                            </tr>
                        </table>
                        <br>
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </center>
            </td>
    </table>
    <br><br><br>
    <center>
        <form action="AdminSummary.php" method="post">
            <input class="btn btn-warning" type="submit" value="HOME">
        </form>
    </center>
</body>
</html>
