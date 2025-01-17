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
            <h2>FORGOT PASSWORD</h2>
        </center>
        <form action="" method="post">
            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" id="username" name="username" required>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" id="email" name="email" required>
                <button name="submit" type="submit">Send</button>
                <!-- <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label> -->
            </div>
            <!-- <div class="container" style="background-color:#f1f1f1">
            <button type="button" class="cancelbtn" onclick="window.location.href='REGISTER.php'">Register</button>
                <span class="psw"><a href="forget-password.php">Forgot password?</a></span>
            </div> -->
        </form>
    </div>
</body>
<?php
include 'include/footer.php';
include ('../PHPMailer/src/DSNConfigurator.php');
include ('../PHPMailer/src/Exception.php');
include ('../PHPMailer/src/OAuth.php');
include ('../PHPMailer/src/PHPMailer.php');
include ('../PHPMailer/src/POP3.php');
include ('../PHPMailer/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "vutoan131102@gmail.com";
            $mail->Password = "ocxfxoygymnmdtln";
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->CharSet = "UTF-8";
            $mail->setFrom("vutoan131102@gmail.com");
            $mail->addAddress($_POST["email"], 'Vu Toan');
            $mail->isHTML(true);
            $mail->Subject = "Reveal Your Password!!!";
            $mail->Body = "Your password is " . $checkLogin->fetch_assoc()["password"] . " .Please don't share with anyone else.";
            $mail->send();
            echo "Email has been send";

        } catch (Exception $e) {
            echo "Message could not send. Mailer error : " . $mail->ErrorInfo;
        }
    }
}
?>

</html>