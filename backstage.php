<?php
    session_start();
    include "connection.php";

    $sqlgetticket = "SELECT * FROM ticket ORDER BY ticket_id";
    $sqlgetmessage = "SELECT * FROM contact ORDER BY message_id";

    $resultforedit = mysqli_query($conn, $sqlgetticket);
    $resultfordelete = mysqli_query($conn, $sqlgetticket);
    $resultformessage = mysqli_query($conn, $sqlgetmessage);
    if(isset($_SESSION['admin_account'])){
    echo
    '<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Backstage</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
            crossorigin="anonymous">
    </head>

    <body>
        <main>
            <div class="container">
                <div class="jumbotron mt-3">
                    <h1>Welcome, ';
                        echo $_SESSION["admin_account"];
                echo'
                </h1>
                </div>
                <div>
                    <div id="accordion" role="tablist">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" href="#edit" aria-expanded="true" aria-controls="collapseOne" >
                                        <h3 class="text-dark">Edit Ticket</h3>
                                    </a>
                                </h5>
                            </div>
                            <div id="edit" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">City</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                                                while($row = mysqli_fetch_array($resultforedit)){
                                                $total = $row['quantity'];
                                                $Des = $row['destination'];
                                                $edit_id = $row['ticket_id'];
                                                echo'<tr>
                                                <form action="update.php" method="POST">
                                                <th>
                                                    <input type="text" name="destination" readonly class="form-control-plaintext" value="' .$Des .'">
                                                </th>
                                                <td>
                                                    <input type="number" name="quantity" class="form-control" value="' .$total .'">
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary" name="edit_id" value="' .$edit_id .'">Edit</button>
                                                </td>
                                                </form>
                                                </tr>';
                                            }
                                            echo '
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingTwo">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" href="#add" aria-expanded="true" aria-controls="collapseOne" >
                                        <h3 class="text-dark">Add ticket</h3>
                                    </a>
                                </h5>
                            </div>                           
                            <div id="add" class="collapse show" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <form action="add.php" method="POST">
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead class="thead-dark">
                                                <tr>
                                                <th scope="col">City</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Add</th>
                                                <th scope="col">Clear</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">
                                                        <input type="text" name="destination" class="form-control" placeholder="City">
                                                    </th>
                                                    <td>
                                                        <input type="number" name="total" class="form-control" placeholder="Amount">
                                                    </td>
                                                    <td>
                                                       <button type="submit" class="btn btn-primary">Add</button>
                                                    </td>
                                                    <td>
                                                        <button type="reset" class="btn btn-danger">Clear</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingThree">
                                <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#delete" aria-expanded="false" aria-controls="collapseThree">
                                        <h3 class="text-dark">Delete ticket</h3>
                                    </a>
                                </h5>
                            </div>
                            <div id="delete" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    <div id="delete" class="collapse show" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <table class="table table-striped table-hover table-bordered">
                                                <thead class="thead-dark">
                                                    <tr>
                                                    <th scope="col">City</th>
                                                    <th scope="col">Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';

                                                    while($row = mysqli_fetch_array($resultfordelete)){
                                                    $total = $row['quantity'];
                                                    $Des = $row['destination'];
                                                    $delete_id = $row['ticket_id'];
                                                    echo'
                                                    <tr>
                                                        <form action="delete.php" method="POST">
                                                        <th>
                                                            <input type="text" name="destination" readonly class="form-control-plaintext" value="' .$Des .'" readonly>
                                                        </th>
                                                        <td>
                                                            <button type="submit" class="btn btn-danger" name="delete_id" value="' .$delete_id. '">Delete</button>
                                                        </td>
                                                        </form>
                                                    </tr>';
                                                    }
                                                    echo '
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingFour">
                                <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#Message" aria-expanded="false" aria-controls="collapseFour">
                                        <h3 class="text-dark">Message</h3>
                                    </a>
                                </h5>
                            </div>
                            <div id="Message" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
                                <div class="card-body">
                                    <div id="message" class="collapse show" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
                                        <div class="card-body">
                                            <table class="table table-striped table-hover table-bordered" id="message">
                                                <thead class="thead-dark">
                                                    <tr>
                                                    <th scope="col-md-3">From</th>
                                                    <th scope="col-md-6">Content</th>
                                                    <th scope="col-md-3">Replied</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                                    while($row = mysqli_fetch_array($resultformessage)){
                                                        $sender = $row['sender'];
                                                        $content = $row['content'];
                                                        $message_id = $row['message_id'];
                                                        echo'
                                                        <tr>
                                                        <form action="replied.php" method="POST">
                                                            <th>
                                                                <input type="text" name="destination[]" readonly class="form-control-plaintext" value="' .$sender .'" readonly>
                                                            </th>
                                                            <td>
                                                                ' .$content .'
                                                            </td>
                                                            <td>
                                                                <button type="submit" class="btn btn-warning text-white" name="message_id" value="' .$message_id. '">Replied</button>
                                                            </td>
                                                        </form>
                                                        </tr>
                                                        ';
                                                        }
                                               echo '</tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingFive">
                                <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#record" aria-expanded="false" aria-controls="collapseFive">
                                        <h3 class="text-dark">Record</h3>
                                    </a>
                                </h5>
                            </div>
                            <div id="record" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
                                <div class="card-body">
                                    <div id="record" class="collapse show" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion">
                                        <div class="card-body">
                                            <table class="table table-striped table-hover table-bordered" id="message">
                                                <thead class="thead-dark">
                                                    <tr>
                                                    <th scope="col-md-3">Buyer</th>
                                                    <th scope="col-md-6">Destination</th>
                                                    <th scope="col-md-3">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                                    $getrecord = "SELECT user.account, ticket.destination, record.amount FROM (user INNER JOIN record ON user.user_id = record.buyer_id)INNER JOIN ticket on ticket.ticket_id = record.ticket_id ORDER BY buyer_id";
                                                    $resultforrecord = mysqli_query($conn, $getrecord);
                                                    while($row = mysqli_fetch_array($resultforrecord)){
                                                        $account = $row['account'];
                                                        $city = $row['destination'];
                                                        $amount = $row['amount'];
                                                        echo'
                                                        <tr>
                                                            <th>
                                                                <input type="text" readonly class="form-control-plaintext" value="' .$account .'" readonly>
                                                            </th>
                                                            <td>
                                                                ' .$city .'
                                                            </td>
                                                            <td>
                                                                <input type="text" readonly class="form-control-plaintext" value="' . $amount. '" readonly>
                                                            </td>
                                                        </tr>
                                                        ';
                                                    }        
                                           echo '</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
        <br>
        <br>
        <br>
        <footer>
            <nav class="navbar fixed-bottom navbar-dark bg-dark">
                <a class="navbar-brand text-light">Backstage</a>
                <form action="logout.php" method="POST">
                    <input class="btn btn-primary" type="submit" value="logout">
                </form>
            </nav>
        </footer>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
            crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
            crossorigin="anonymous"></script>
    </body>

    </html>';
    }else{
        echo "<script>alert('You are not administrator');</script>";
        header("Refresh: 0; url=index.php" );
        session_destroy();
        }
                                                
?>