<?php
include 'dbinfo.php';
?>
<?php
session_start();
$link = mysqli_connect($host, $user, $pass) or die("Unable to connect");
mysqli_select_db($link, $database) or die("Unable to select database");
$username = $_SESSION['username'];
//if ($_POST['username'] != null) {
if ($_POST['username'] ?? null) {
    $username1 = $_POST['username'];
    $_SESSION['username1'] = $username1; // store session data	
    $sql_query2 = "select stud_fac_emp.Username, count(ISBN) as noOfIssuedBooks, Name, DOB, Email, Gender, Address, UserType, Dept, Penalty from stud_fac_emp left join issue on stud_fac_emp.Username=issue.Username group by stud_fac_emp.Username having stud_fac_emp.Username = '$username1'";
    $result2 = mysqli_query($link, $sql_query2)  or die(mysqli_error($link));
    if ($result2 == false) {
        echo 'The query by Username failed.';
        exit();
    }
    //} elseif ($_POST['name'] != null) {
} elseif ($_POST['name'] ?? null) {
    $name = $_POST['name'];
    $_SESSION['name'] = $name;
    $sql_query2 = "select stud_fac_emp.Username, count(ISBN) as noOfIssuedBooks, Name, DOB, Email, Gender, Address, UserType, Dept, Penalty from stud_fac_emp left join issue on stud_fac_emp.Username=issue.Username group by stud_fac_emp.Username having Name like '%$name%'";
    $result2 = mysqli_query($link, $sql_query2)  or die(mysqli_error($link));
    if ($result2 == false) {
        echo 'The query by NAME failed.';
        exit();
    }
    //} elseif ($_POST['department'] != null) {
} elseif ($_POST['department'] ?? null) {
    $department = $_POST['department'];
    $_SESSION['department'] = $department;
    $sql_query2 = "select stud_fac_emp.Username, count(ISBN) as noOfIssuedBooks, Name, DOB, Email, Gender, Address, UserType, Dept, Penalty from stud_fac_emp left join issue on stud_fac_emp.Username=issue.Username group by stud_fac_emp.Username having Dept like '%$department%'";
    $result2 = mysqli_query($link, $sql_query2)  or die(mysqli_error($link));
    if ($result2 == false) {
        echo 'The query by Department failed.';
        exit();
    }
    //} elseif ($_POST['allstud'] != null) {
} elseif ($_POST['allstud'] ?? null) {
    $allstud = $_POST['allstud'];
    $sql_query2 = "select stud_fac_emp.Username, count(ISBN) as noOfIssuedBooks, Name, DOB, Email, Gender, Address, UserType, Dept, Penalty from stud_fac_emp left join issue on stud_fac_emp.Username=issue.Username group by stud_fac_emp.Username having UserType='student'";
    $result2 = mysqli_query($link, $sql_query2)  or die(mysqli_error($link));
    if ($result2 == false) {
        echo 'The query by AllStudent failed.';
        exit();
    }
} elseif ($_POST['allfac'] != null) {
    $allfac = $_POST['allfac'];
    $sql_query2 = "select stud_fac_emp.Username, count(ISBN) as noOfIssuedBooks, Name, DOB, Email, Gender, Address, UserType, Dept, Penalty from stud_fac_emp left join issue on stud_fac_emp.Username=issue.Username group by stud_fac_emp.Username having UserType='faculty'";
    $result2 = mysqli_query($link, $sql_query2)  or die(mysqli_error($link));
    if ($result2 == false) {
        echo 'The query by AllFaculty failed.';
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
    <center><I>
            <h1>List of Users</h1>
        </I></center>
    <table id="booksResult">
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>DateOfBirth</th>
            <th>Email</th>
            <th>Gender(M/F)</th>
            <th>Type of User</th>
            <th># of issued books</th>
            <th>Department</th>
            <th>Address</th>
            <th>Penalty Amount</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($result2)) {
            $Username = $row['Username'];
            $Name = $row['Name'];
            $DOB = $row['DOB'];
            $Email = $row['Email'];
            $Gender = $row['Gender'];
            $UserType = $row['UserType'];
            $noOfIssuedBooks = $row['noOfIssuedBooks'];
            $Dept = $row['Dept'];
            $Address = $row['Address'];
            $Penalty = $row['Penalty'];
        ?>
            <tr>
                <td><?php echo $Username; ?></td>
                <td><?php echo $Name; ?></td>
                <td><?php echo $DOB; ?></td>
                <td><?php echo $Email; ?></td>
                <td><?php echo $Gender; ?></td>
                <td><?php echo $UserType; ?></td>
                <td><?php echo $noOfIssuedBooks; ?></td>
                <td><?php echo $Dept; ?></td>
                <td><?php echo $Address; ?></td>
                <td><?php echo $Penalty; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    </form>
    <br><br>
    <center>
        <form action="SearchUser_admin.php" method="post">
            <input type="submit" class="btn btn-info" value="Back" />
            <!--id="submitForm" />-->
        </form>
    </center>
</body>
</html>
