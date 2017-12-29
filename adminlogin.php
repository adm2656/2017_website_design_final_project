<!DOCTYPE html>
<html lang="en">

<head>
    <!--Do not change thing in header-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>administrator Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
        crossorigin="anonymous">
    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <form class="form-signin" action="adminlogin.php " method="POST">
                <h2 class="form-signin-heading">Please Login First</h2>
                <label for="inputaccount" class="sr-only">account</label>
                <input type="text" name="account" class="form-control" placeholder="Account" required autofocus>
                <p></p>
                <label for="inputPassword" class="sr-only">password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            </form>
        </div>
        <br>
        <hr>
    </main>
    <footer class="container">
        <div class="row">
            <div class="col-md-10">
                <p>&copy; CCUMIS 2017</p>
            </div>
        </div>
    </footer>
    <!--Do not change thing under this comment-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
        crossorigin="anonymous"></script>
</body>

</html>

<?php       
        session_start();
        include "connection.php";
        if (isset($_POST["account"], $_POST["password"])){
            $admin_account = $_POST["account"];
            $password = $_POST["password"];
            $sql = "SELECT * FROM Administrator WHERE admin_account = '$admin_account' and pwd = '$password'";

            if(mysqli_num_rows(mysqli_query($conn,$sql))>0){
                $_SESSION["admin_account"] = $admin_account;
                $_SESSION["password"] = $password;
                header('Location: '. 'backstage.php');
            }
            else{
                echo "<script>alert('You are not administrator');</script>";
                header("Refresh: 0; url=index.php" );
                session_destroy();
            }
        }
?>