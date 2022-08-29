<?php
include 'dbinfo.php';
?>
<?php
session_start(); //connect to the db 
$username = $_SESSION['username'];
?>

<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #submit1 {
            background-color: blue;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 6px;
            color: #fff;
            font-family: 'Oswald';
            font-size: 18px;
            text-decoration: none;
            cursor: pointer;
        }

        #submitBack {
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

        #submitLogout {
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 6px;
            color: red;
            font-family: 'Oswald';
            font-size: 20px;
            text-decoration: none;
            cursor: pointer;
            border: none;
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
        <br><br>
        <I><U>
                <h1>Search Books</h1></I></U>
        <br>
        <form action="SearchBooksResult_admin.php" method="post">
            <table>
                <tr>
                    <td>ISBN</td>
                    <td><input type="text" name="isbn" /></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td><input type="text" name="dept" /></td>
                </tr>
                <tr>
                    <td>BookTitle</td>
                    <td><input type="text" name="title" /></td>
                </tr>
                <tr>
                    <td>Author</td>
                    <td><input type="text" name="author" /></td>
                </tr>
            </table>
            <br>
            <input type="submit" value="Search" class="btn btn-primary">
        </form>
        <br><br>
        <form action="AdminSummary.php" method="post">
            <input class="btn btn-warning" type="submit" value="HOME">
        </form>
    </center>
</body>
</html>
