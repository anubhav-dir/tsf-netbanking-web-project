<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>NetBanking Web</title>

    <style>
        #customer-data {
            margin-top: 25px;
        }

        #customer-data h1 {
            text-align: center;
        }

        .send-amount {
            color: #dd2538;
        }

        .recive-amount {
            color: #14db9f;
        }

        .balance-amount {
            color: #0765f1;
        }
    </style>
</head>

<body>

    <!-- <div w3-include-html="navbar.html"></div> -->

    <!-- Nav section  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="customers.php">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transition.php">Transition</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    $user_id = $_GET['id'];
    require_once "db/dbconn.php";
    $sql = "SELECT * FROM users WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam('user_id', $user_id);
    $stmt->execute();
    $results = $stmt->fetch();
    ?>

    <!-- Details  -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 ">
                <div id="customer-data">
                    <h1>Details</h1>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>User I'd</td>
                                <td><?php echo $results['user_id']; ?> </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><?php echo $results['name']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?php echo $results['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Contact No</td>
                                <td><?php echo $results['contactNo']; ?></td>
                            </tr>
                            <tr>
                                <td>Amount</td>
                                <td>₹<?php echo $results['bankAmount']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php
            require_once "db/dbconn.php";
            $user_id = $_GET['id'];
            $sql = "SELECT * FROM `transition records` WHERE sender =:sender OR receiver=:sender";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam('sender', $user_id);
            $stmt->execute();
            // $results = $stmt->fetch();
            ?>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div id="customer-data">
                            <a class="" href="transition.php">send money</a>
                            <!-- <a href="customerDetalis.php?id=<?php //echo $user_id; ?>">Profile</a> -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Transition I'd</th>
                                        <th>Transition With</th>
                                        <!-- <th>Sender</th> -->
                                        <th>Transition</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sn = 0;
                                    while ($sr = $stmt->fetch()) {
                                        $sn++; ?>
                                        <tr>
                                            <td><?php echo $sn; ?></td>
                                            <td><?php echo $sr['transition_id']; ?></td>
                                            <td><?php if ($sr['receiver'] == $user_id) {
                                                    echo $sr['sender'];
                                                } else {
                                                    echo $sr['receiver'];
                                                } ?></td>
                                            <td <?php if ($sr['receiver'] == $user_id) {
                                                    echo "class='text-success'";
                                                } else {
                                                    echo 'class="text-danger"';
                                                } ?>>₹<?php echo $sr['amount']; ?></td>
                                            <td><?php echo $sr['date']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>