<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .error {
            color: #FF0000
        }

        body {
            background-image: url('images/slider1.jpg');
        }

        h1 {
            font-size: 55px;
            color: chocolate;
        }
    </style>
</head>

<body>
    <br><br><br><br><br><br>
    <center>
        <table>
            <tr>
                <td>
                    <center>
                        <h1>LOGIN WINDOW</h1>
                        <form method="post" action="Login_validate.php">
                            <table cellspacing="20" cellpadding="15">
                                <tr>
                                    <td><B>USERNAME : </B></td>
                                    <td><input type="text" name="username" required />
                                    </td>
                                </tr><br>
                                <tr>
                                    <td><B>PASSWORD : </B></td>
                                    <td><input type="password" name="password" required /></td>
                                </tr>
                            </table>
                            <br>
                            <input type="submit" value="Login" class="btn btn-success" />
                        </form>
                    </center>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>
