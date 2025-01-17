<!DOCTYPE html>
<html>

<head>
    <title>TO4SN / REGISTER</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
        }

        * {
            box-sizing: border-box;
        }

        /* Add padding to containers */
        .container {
            padding: 16px;
            background-color: white;
            border-radius: 20px;
        }

        .form-container {
            padding-top: 80px;
        }

        /* Full-width input fields */
        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
            border-radius: 12px
        }

        input[type=text]:focus,
        input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Overwrite default styles of hr */
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* Set a style for the submit button */
        .registerbtn {
            background-color: #f3665b;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
            border-radius: 12px
        }

        .registerbtn:hover {
            opacity: 1;
        }

        /* Add a blue text color to links */
        a {
            color: dodgerblue;
        }

        /* Set a grey background color and center the text of the "sign in" section */
        .signin {
            background-color: #f1f1f1;
            text-align: center;
        }
    </style>
</head>
<?php
include 'include/header.php'
    ?>

<body>
    <div class="form-container">
        <form action="" method="post">
            <div class="container">
                <h1>Register</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" id="username" required>
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" id="password" required>
                <label for="password-repeat"><b>Repeat Password</b></label>
                <input type="password" placeholder="Repeat Password" name="password-repeat" id="password-repeat" required>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" id="email" required>
                <hr>
                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
                <button type="submit" name="btn_submit" class="registerbtn">Register</button>
            </div>
            <div class="container signin">
                <p>Already have an account? <a href="LOGIN.php">Sign in</a>.</p>
            </div>
        </form>
    </div>
</body>
<?php
    include 'include/footer.php'
?>
</html>
<?php
    //include '../control.php';
    if (isset($_POST['btn_submit'])) {
        if ($_POST['password'] != $_POST['password-repeat']) {
            echo "<script>
                    alert('Password must be the same ');
                    document.getElementById('password-repeat').focus(); 
                </script>";
        } else {
            $user = new USER();
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            
            if ($user->checkUser($username)){
                echo "<script>
                        alert('Username already exist!!');
                        document.getElementById('username').focus(); 
                    </script>";
            }
            else {
                if ($user->signup($username, $password, $email)) {
                    echo "<script>
                            alert('Signup Success!');
                            window.location.href='LOGIN.php';
                        </script>";
                }
                else{
                    echo "<script>
                        alert('Signup Fail!!');
                    </script>";
                }
            }
        }
    }
?>
