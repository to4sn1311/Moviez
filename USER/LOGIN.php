<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    include 'include/head.php';
    ?>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
        }

        .form {
            border: 5px solid #f1f1f1;
            border-radius: 20px;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            border-radius: 12px;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #f3665b;
            color: white;
            border-radius: 12px;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f3665b;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container {
            padding: 20px;
            border-radius: 20px;
            border: 1px solid #f5f5f7;
        }

        .form-container {
            padding-top: 80px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }
    </style>
    <title>TO4SN / LOGIN</title>
</head>
<?php
include 'include/header.php';
?>

<body>
    <div class="form-container">
        <center>
            <h2>Login</h2>
        </center>
        <form action="" method="post">
            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" id="username" name="username" required>
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" id="password" name="password" required>
                <button name="submit" type="submit">Login</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>
            <div class="container" style="background-color:#f1f1f1">
                <button type="button" class="cancelbtn" onclick="window.location.href='REGISTER.php'">Register</button>
                <span class="psw"><a href="forget-password.php">Forgot password?</a></span>
            </div>
        </form>
    </div>
</body>
<?php
include 'include/footer.php';
//include '../control.php';
if (isset($_POST['submit'])) {
    $user = new USER();
    $checkLogin = $user->checkLogin($_POST['username']);
    if (mysqli_num_rows($checkLogin) == 0) {
        echo "<script>
                alert('Username not found');
                document.getElementById('username').focus();
            </script>";
    } else {
        if ($_POST["password"] != $checkLogin->fetch_assoc()["password"]) {
            echo "<script>
                    alert('Incorrect Password!!');
                    document.getElementById('username').focus();
                </script>";
        } else {
            echo "<script>
                    alert('Login Success!!');
                    window.location = 'test.php';
                </script>";
            $_SESSION["username"] = $_POST['username'];
        }
    }
}
?>

</html>