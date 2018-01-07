<?php
    include "connection.php";
    session_start();
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
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900);


        .homepage-hero-module {
            border-right: none;
            border-left: none;
            position: relative;
        }

        .no-video .video-container video,
        .touch .video-container video {
            display: none;
        }

        .no-video .video-container .poster,
        .touch .video-container .poster {
            display: block !important;
        }

        .video-container {
            position: relative;
            bottom: 0%;
            left: 0%;
            height: 100%;
            width: 100%;
            overflow: hidden;
            background: #000;
        }

        .video-container .poster img {
            width: 100%;
            bottom: 0;
            position: absolute;
        }

        .video-container .filter {
            z-index: 100;
            position: absolute;
            background: rgba(0, 0, 0, 0.4);
            width: 100%;
        }

        .video-container video {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 0;
            bottom: 0;
        }

        .video-container video.fillWidth {
            width: 100%;
            -webkit-filter: blur(3px);
            -moz-filter: blur(3px);
            -o-filter: blur(3px);
            -ms-filter: blur(3px);
            filter: blur(3px);
        }

        .title-container {
            position: absolute;
            top: 35%;
            left: 0;
            right: 0;

            font-family: 'Roboto', sans-serif;

            z-index: 999;
        }

        .title-container .headline {
            text-align: center;
            color: #fff;
        }

        .title-container h3,
        .title-container h5 {
            position: relative;
            font-weight: 350;
        }

        .title-container h3 {
            font-size: 100px;
            line-height: 44px;
            margin: 15px 0 10px;
            color: white;

        }

        .title-container h5 {
            font-size: 22px;
            margin: 20px 0 0;
        }

        .form-submit {
            margin: 0 auto;
            width: 80%
        }
    </style>
    <script>
        //jQuery is required to run this code
        $(document).ready(function () {

            scaleVideoContainer();

            initBannerVideoSize('.video-container .poster img');
            initBannerVideoSize('.video-container .filter');
            initBannerVideoSize('.video-container video');

            $(window).on('resize', function () {
                scaleVideoContainer();
                scaleBannerVideoSize('.video-container .poster img');
                scaleBannerVideoSize('.video-container .filter');
                scaleBannerVideoSize('.video-container video');
            });

        });

        function scaleVideoContainer() {

            var height = $(window).height() + 5;
            var unitHeight = parseInt(height) + 'px';
            $('.homepage-hero-module').css('height', unitHeight);

        }

        function initBannerVideoSize(element) {

            $(element).each(function () {
                $(this).data('height', $(this).height());
                $(this).data('width', $(this).width());
            });

            scaleBannerVideoSize(element);

        }

        function scaleBannerVideoSize(element) {

            var windowWidth = $(window).width(),
                windowHeight = $(window).height() + 5,
                videoWidth,
                videoHeight;

            console.log(windowHeight);

            $(element).each(function () {
                var videoAspectRatio = $(this).data('height') / $(this).data('width');

                $(this).width(windowWidth);

                if (windowWidth < 1000) {
                    videoHeight = windowHeight;
                    videoWidth = videoHeight / videoAspectRatio;
                    // $(this).css({'margin-top' : 0, 'margin-left' : -(videoWidth - windowWidth) / 2 + 'px'});

                    $(this).width(videoWidth).height(videoHeight);
                }

                $('.homepage-hero-module .video-container video').addClass('fadeIn animated');

            });
        }
    </script>
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

    <main role="main">
        <div class="homepage-hero-module">
            <div class="video-container">
                <div class="title-container">
                    <div class="headline">
                        <h3>JOIN US NOW</h3>
                        <br>
                        <br>
                        <h5>
                            <div class="container">
                                <form class="form-submit" style="width: 30%;" action="signup_method.php" method="POST">
                                    <label for="inputEmail" class="sr-only">Email address</label>
                                    <input type="email" name="inputemail" class="form-control" placeholder="Email address" required autofocus>
                                    <label for="inputPassword" class="sr-only">Password</label>
                                    <input type="password" name="inputpwd" class="form-control" placeholder="Password" required>
                                    <br>
                                    <button class="btn btn-lg btn-light btn-block" type="submit">Submit</button>
                                </form>
                            </div>
                        </h5>
                    </div>
                </div>
                <div class="filter"></div>
                <video autoplay loop class="fillWidth">
                    <source src="./img/Cloud_Surf/Cloud_Surf.mp4" type="video/mp4" />Your browser does not support the video tag. I suggest you upgrade your browser.
                    <source src="./img/Cloud_Surf/Cloud_Surf.webm" type="video/webm" />Your browser does not support the video tag. I suggest you upgrade your browser.
                </video>
                <!-- Image fallback if video is not supported by browser -->
                <div class="poster hidden" style="display: none">
                    <img src="./img/Cloud_Surf/Cloud_Surf.jpg" alt="">
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
    <script>$(document).ready(function () {

            scaleVideoContainer();

            initBannerVideoSize('.video-container .poster img');
            initBannerVideoSize('.video-container .filter');
            initBannerVideoSize('.video-container video');

            $(window).on('resize', function () {
                scaleVideoContainer();
                scaleBannerVideoSize('.video-container .poster img');
                scaleBannerVideoSize('.video-container .filter');
                scaleBannerVideoSize('.video-container video');
            });

        });

        function scaleVideoContainer() {

            var height = $(window).height() + 5;
            var unitHeight = parseInt(height) + 'px';
            $('.homepage-hero-module').css('height', unitHeight);

        }

        function initBannerVideoSize(element) {

            $(element).each(function () {
                $(this).data('height', $(this).height());
                $(this).data('width', $(this).width());
            });

            scaleBannerVideoSize(element);

        }

        function scaleBannerVideoSize(element) {

            var windowWidth = $(window).width(),
                windowHeight = $(window).height() + 5,
                videoWidth,
                videoHeight;

            // console.log(windowHeight);

            $(element).each(function () {
                var videoAspectRatio = $(this).data('height') / $(this).data('width');

                $(this).width(windowWidth);

                if (windowWidth < 1000) {
                    videoHeight = windowHeight;
                    videoWidth = videoHeight / videoAspectRatio;
                    $(this).css({ 'margin-top': 0, 'margin-left': -(videoWidth - windowWidth) / 2 + 'px' });

                    $(this).width(videoWidth).height(videoHeight);
                }

                $('.homepage-hero-module .video-container video').addClass('fadeIn animated');

            });
        }
    </script>
</body>

</html>