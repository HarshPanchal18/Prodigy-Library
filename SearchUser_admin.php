<?php
include 'dbinfo.php';
?>
<?php
session_start();
$username = $_SESSION['username'];
?>

<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #td2 {
            padding-left: 100px;
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
                <h1>Search for Users</h1></I></U>
        <br>
        <form action="SearchUserResult_admin.php" method="post">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" /></td>
                </tr>

                <tr>
                    <td>Department</td>
                    <td><input type="text" name="department" /></td>
                </tr>


                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" /></td>
                </tr>

            </table><br>
            <input type="submit" value="Search" class="btn btn-primary">
        </form>
    </center>
    <br><br>
    <center>
        <table>
            <tr>
                <td>
                    <form action="SearchUserResult_admin.php" method="post">
                        <input type="hidden" name="allstud" value="10">
                        <input type="submit" value="List all Students" class="btn btn-secondary">
                    </form>
                </td>
                <td id="td2">
                    <form action="SearchUserResult_admin.php" method="post">
                        <input type="hidden" name="allfac" value="11">
                        <input type="submit" value="List all Faculties" class="btn btn-secondary">
                    </form>
                </td>
            <tr>
        </table>
    </center>
    <br><br><br>
    <center>
        <form action="AdminSummary.php" method="post">
            <input class="btn btn-warning" type="submit" value="HOME">
        </form>
    </center>
</body>
</html>
