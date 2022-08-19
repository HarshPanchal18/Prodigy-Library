<?php
include 'dbinfo.php'
?>
<?php
session_start(); //connect to the db 
$username = $_SESSION['username'];
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
        <I>
            <h1>Search Books</h1>
        </I>
        <br>
        <form method="post" action="SearchBooksResult_user.php">
            <table>
                <tr>
                    <td><b>ISBN</b></td>
                    <td><input type="text" name="isbn" /></td>
                </tr>
                <tr>
                    <td><b>Book Title</b></td>
                    <td><input type="text" name="title" /></td>
                </tr>
                <tr>
                    <td><b>Department</b></td>
                    <td><input type="text" name="dept" /></td>
                </tr>
                <tr>
                    <td><b>Author</b></td>
                    <td><input type="text" name="author" /></td>
                </tr>
            </table>
            <br><br>
            <input type="submit" value="Search" class="btn btn-primary" name="author" />
        </form>
        <br><br>

        <form action="UserSummary.php" method="post">
            <input type="submit" class="btn btn-warning" value="HOME">
        </form>
    </center>
</body>
</html>
