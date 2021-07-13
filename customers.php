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
        #customer-table {
            margin: 25px 0;
        }

        h1 {
            text-align: center;
            padding: 25px 0 0 0;
        }
    </style>
</head>

<body>

    <div w3-include-html="navbar.html"></div>

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
    require_once "db/dbconn.php";
    $sql = "SELECT * FROM users";
    $results = $pdo->query($sql);
    ?>

    <!-- body section  -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>All Customers</h1>
                <table class="table" id="customer-table">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                User I'd
                            </th>
                            <th>
                                Name
                            </th>
                            <!-- <th>
                                Transition History
                            </th> -->
                            <th>
                                Profile
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sn = 0;
                        while ($r = $results->fetch()) {
                            $sn++; ?>
                            <tr>
                                <td>
                                    <?php echo $sn; ?>
                                </td>
                                <td>
                                    <?php echo $r['user_id']; ?>
                                </td>
                                <td>
                                    <?php echo $r['name']; ?>
                                </td>
                                <!-- <td>
                                    <a href="transitionHistory.php?id=<?php //echo $r['user_id']; ?>">Transition History</a>
                                </td> -->
                                <td>
                                    <a href="customerDetalis.php?id=<?php echo $r['user_id']; ?>">Details</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>