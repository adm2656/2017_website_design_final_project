<?php
    include "connection.php";

    $sql = "SELECT * FROM ticket ORDER BY ticket_id";
    $result = mysqli_query($conn, $sql);

    session_start();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!--Do not change thing in header-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>A Simple Ticketing Website</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
            crossorigin="anonymous">
        
	<link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">

        <style>
            .carousel-caption {

                color: rgb(255, 255, 255);

            }
            .table-borderless td,.table-borderless th {

                border: 0;
            }

            thead th:first-child{
                border-radius: 15px 0 0 0;
            }

            thead th:last-child{
                border-radius: 0 15px 0 0;
            }

            tbody tr:last-child th:first-child{
                border-radius: 0 0 0 15px;
            }

            tbody tr:last-child td:last-child{
                border-radius: 0 0 15px 0;
            }
        </style>
    </head>

    <body>
        <header>
            <div class="pos-f-t">
            <nav class="navbar navbar-dark bg-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- §PÂ_·|­ûµn¤J»P§_ -->

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
                                header("Refresh: 0; url=Submit.php" );
                                session_destroy();
                            }
                        }
                    ?>
                </nav>

                <!-- ­¶­±³sµ² -->

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
                                    <a class="nav-link" href="Submit.php" style="color:whitesmoke">Submit</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="nav-link" href="Contact.php" style="color:whitesmoke">Contact</a>
                                </li>
                            </ul>
                        </span>
                    </div>
                </div>
                
        </header>
               

        <!-- ¥D­¶­± -->
        <main>
            <!-- ·Ó¤ùÂà´« -->
            <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselIndicators" data-slide-to="3"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="./img/london.jpg" alt="First slide">
                        <div class="carousel-caption text-center">
                            <h1>Just Ticketing</h1>
                            <h5>Go Wherever You Want.</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="./img/tokyo.jpg" alt="Second slide">
                        <div class="carousel-caption text-center">
                            <h1>Just Ticketing</h1>
                            <h5>Go Wherever You Want.</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="./img/paris.jpg" alt="Third slide">
                        <div class="carousel-caption text-center">
                            <h1>Just Ticketing</h1>
                            <h5>Go Wherever You Want.</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="./img/ny.jpg" alt="Forth slide">
                        <div class="carousel-caption text-center">
                            <h1>Just Ticketing</h1>
                            <h5>Go Wherever You Want.</h5>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <br>
            <br>
            <div class="container">
                <table class="table table-striped table-hover table-borderless">
                    <caption>All of our plans</caption>
                    <thead class="thead-dark">
                        <tr class="text-light">
                            <th scope="col">City</th>
                            <th scope="col">Available</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Add to cart</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row = mysqli_fetch_array($result)){
                                $ticket_id = $row['ticket_id'];
                                $total = $row['quantity'];


                                $getsalesql = "SELECT amount FROM record WHERE ticket_id = '$ticket_id'";
                                $saleresult = mysqli_query($conn, $getsalesql);
                                $sale_numbers = mysqli_fetch_array($saleresult);
                                $sale = $sale_numbers['amount'];
                                $Des = $row['destination'];
                                $available = $total - $sale;
                                echo'
                                    <tr>
                                    <form action="addtocart.php" method="POST" id ="sale">
                                        <th scope="row">
                                            <input type="text" readonly class="form-control-plaintext" name="des" value="' .$Des .'">
                                        </th>
                                    <td>
                                        <input type="text" readonly class="form-control-plaintext" name="amount" value="' .$available .'">
                                    </td>
                                    <td> 
                                        <select class="form-control form-control-sm" name="select' .$ticket_id. '">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-outline-dark btn-sm" name="ticket_id" value="' .$ticket_id. '"">Add</button>
                                    </td>
                                    </form>
                                </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <hr>
        </main>
        <footer class="container">
            <div class="row">
                <div class="col-md-9">
                    <p>&copy; CCUMIS 2017</p>
                </div>
                <div class="col-md-3">
                    <a href="adminlogin.php">Login as administrator</a>
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
