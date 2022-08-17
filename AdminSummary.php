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
        body {
            background-image: url('images/slider2.jpg');
            background-size: cover;
        }

        #btnLists {
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 8px;
            color: forestgreen;
            font-family: 'Oswald';
            font-size: 20px;
            text-decoration: none;
            cursor: pointer;
            border: none;
        }
    </style>
</head>

<body style="background-color: #5439a5">
    <center>
        <br>
        <h1>
            <p style="font-family:'Courier New';color:rebeccapurple;font-size:160%">📚 <u>Pro</u>digy Library 📚</p>
        </h1>
        <br>
        <form action="SearchUser_admin.php" method="post">
            <input type="submit" id="btnLists" value="Search among Users" />
        </form>
        <form action="SearchBooks_admin.php" method="post">
            <input type="submit" id="btnLists" value="Search Books" />
        </form>
        <form action="TrackUnreturnedBooks_admin.php" method="post">
            <input type="hidden" name="checkedbooks" value="99">
            <input type="submit" id="btnLists" value="Track Unreturned Books">
        </form>
        <form action="AddRemoveBooks_admin.php" method="post">
            <input type="submit" id="btnLists" value="Add or Remove Books" />
        </form>
        <form action="AddRemoveUser_admin.php" method="post">
            <input type="submit" id="btnLists" value="Add or Remove Users" />
        </form>
        <form action="IssueBooks_admin.php" method="post">
            <input type="submit" id="btnLists" value="Issue or Return Books" />
        </form>
        <form action="AllReIssueRequests_admin.php" method="post">
            <input type="hidden" name="allreissue" value="60">
            <input type="submit" id="btnLists" value="View All Re-Issue Requests">
        </form>
        <br><br>
        <form action="index.php" method="post">
            <input class="btn btn-danger" type="submit" value="Logout --]">
        </form>
    </center>
</body>
</html>
