<?php
    include "connection.php";
    session_start();

    if(isset($_POST["email"], $_POST["message"])){
        $sender = $_POST["email"];
        $content = $_POST["message"];

        $sql = "INSERT INTO contact (sender, content) VALUES ('$sender', '$content')";
        mysqli_query($conn, $sql);

        echo "<script>alert('Thanks for your contact, we will reply soon.');</script>";
        header("Refresh: 0; url=index.php" );
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!--Do not change thing in header-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>A Simple Ticketing Website</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
        crossorigin="anonymous">

</head>

<body>
<header>
<div class="pos-f-t">
<nav class="navbar navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- member login judgement php -->
        <?php
            if(!isset($_SESSION['email'], $_SESSION['pwd'])){
                echo'<form class="form-inline navbar-form" action="index.php" method="POST">
                    <div class="form-group">
                        <input type="email" class="form-control form-control-sm" name="email" placeholder="Your email" required>
                        <input type="password" class="form-control form-control-sm mx-sm-2" name="pwd" placeholder="Your password" required>
                        <input type="submit" class="btn btn-primary btn-sm" value="Login">
                    </div>
                </form>';
            }else{
                echo'<form class="form-inline navbar-form" action="logout.php" method="POST">
                    <div class="form-group">
                        <input type="text" readonly class="form-control-plaintext text-light col-md-9" value="'.$_SESSION['email']. '" readonly>
                        <input type="submit" class="btn btn-primary btn-sm" value="Logout">
                    </div>
                </form>';
            }

            if(isset($_POST['email'], $_POST['pwd'])){
                $email = $_POST['email'];
                $pwd = $_POST['pwd'];
                
                $loginsql = "SELECT * FROM user WHERE account = '$email'";

                if(mysqli_num_rows(mysqli_query($conn,$loginsql))>0){
                    $row = mysqli_fetch_array(mysqli_query($conn, $loginsql));
                    $checkpwd = $row['pwd'];
                    if ($pwd == $checkpwd){
                        $_SESSION['email'] = $email;
                        $_SESSION['pwd'] = $pwd;
                        header('Location: '. 'index.php');
                    }else{
                        echo "<script>alert('Wrong password.');</script>";
                        header("Refresh: 0; url=index.php" );
                        session_destroy();
                    }
                }else{
                    echo "<script>alert('You are not one of us, join us by going to the submit page.');</script>";
                    header("Refresh: 0; url=Signup.php" );
                    session_destroy();
                }
            }
        ?>
    </nav>
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
            <span class="text-muted">
                <ul class="navbar-nav">
                    <li class="list-inline-item">
                        <a class="nav-link" href="index.php" style="color:whitesmoke">Homepage</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="nav-link" href="Member.php" style="color:whitesmoke">Member</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="nav-link" href="Cart.php" style="color:whitesmoke">Cart</a>
                    </li>

                    <li class="list-inline-item">
                        <a class="nav-link" href="Signup.php" style="color:whitesmoke">Signup</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="nav-link" href="Contact.php" style="color:whitesmoke">Contact</a>
                    </li>
                </ul>
            </span>
        </div>
    </div>
    
</header>


    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Contact us</h1>
            <p>Tell us anything you want to say.</p>
        </div>
    </div>

    <div class="container">

        <main role="main">
            <div class="col-md-8 col-md-offset-2">
                <form action="Contact.php" method="POST">
                    <div class="form-group">
                        <h2>
                            <label for="Email">Email address</label>
                        </h2>
                        <input type="email" class="form-control" name="email" 
                        <?php
                        if(isset($_SESSION['email'], $_SESSION['pwd'])){
                            echo ' value="'. $_SESSION['email']. '"';
                        }else{
                            echo 'placeholder="Your Email address"';
                        }   
                        ?>
                        required>
                        <div class="invalid-feedback">
                            Please provide a valid Email.
                        </div>
                    </div>
                    <div class="form-group">
                        <h2>
                            <label for="Message">Message you want to say</label>
                        </h2>
                        <textarea class="form-control" name="message" placeholder="Anything you like to share with us." rows="5" required></textarea>
                        <div class="invalid-feedback">
                            Things you want to tell us.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
    </div>

    </div>
    </main>
    <footer class = "bg-dark">
    <hr>
        <div class ="container">
            <div class="row">
                <div class="col-md-9">
                    <p class = "text-light">&copy; CCUMIS 2017</p>
                </div>
                <div class="col-md-3">
                    <a href="adminlogin.php" class="text-light">Login as administrator</a>
                </div>
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