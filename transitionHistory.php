<?php session_start(); ?>
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
    </style>
</head>

<body>

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

    <!-- History  -->

    <?php
    if (!isset($_GET['id'])) {
        header("Location: customers.php");
    }
    $user_id = $_GET['id'];

    require_once "db/dbconn.php";
    require_once "db/transistionDB.php";

    $history = new Transition($pdo);
    $results = $history->getTransitionHistory($user_id);
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div id="customer-data">

                    <h6 class="text-end">
                        <a href="customerDetalis.php?id=<?php echo $user_id; ?>">Profile</a>
                    </h6>
                    <h6 class="text-end">
                        <a class="" href="transition.php?id=<?php echo $user_id; ?>">send money</a>
                    </h6>
                    <?php if (isset($_SESSION['errorMessage'])) {
                        echo $_SESSION['errorMessage'];
                        unset($_SESSION['errorMessage']);
                    } ?>

                    <h1 class="text-center" style="padding-bottom: 25px;"><u> User I'd - <?php echo $user_id;?></u></h1>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Transition I'd</th>
                                <th>Transition With</th>
                                <th>Transition</th>
                                <th>Re Mark</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sn = 0;
                            while ($sr = $results->fetch()) {
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
                                    <td><?php echo $sr['re_mark']; ?></td>
                                    <td><?php echo $sr['date']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>