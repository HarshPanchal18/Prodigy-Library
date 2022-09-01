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
</head>

<body style="background-color:#524839">
    <center>
        <br>
        <p style="font-family:'Courier New';color:aqua;font-size:160%">📚 <u>Pro</u>digy Library 📚</p><br>
        <form method="post" action="SearchBooks_user.php">
            <input type="submit" class="btn btn-info" value="Search Books" />
        </form>
        <form action="MyIssuedBooks_user.php" method="post">
            <input type="submit" class="btn btn-info" value="My Issued Books" />
        </form>
        <form action="ReIssueRequest_user.php" method="post">
            <input type="submit" class="btn btn-info" value="Re-Issue Request" />
        </form>
        <br><br>
        <form action="index.php" method="post">
            <input class="btn btn-danger" type="submit" value="Logout  --]">
        </form>
    </center>
</body>
</html>
