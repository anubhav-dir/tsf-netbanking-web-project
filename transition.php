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
        #transition-table {
            margin-top: 25px;
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
                        <a class="nav-link" href="customers.php">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="transition.php">Transition</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <?php
    require_once "db/dbconn.php";
    require_once "db/customersDB.php";

    $customers = new Customers($pdo);

    if (isset($_GET['id'])) {
        $sender = $_GET['id'];
        $senderId = $customers->getCustomersProfile($sender);
    } else {
        $senderId = $customers->getCustomers();
    }
    $reciverId = $customers->getCustomers();

    // $senderId = $reciverId = $results;
    ?>


    <!-- Transition -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div id="transition-table">
                    <h1 class="text-center">Send Money</h1>
                    <?php if (isset($_SESSION['errorMessage'])) {
                        echo $_SESSION['errorMessage'];
                        unset($_SESSION['errorMessage']);
                    } ?>
                    <form action="db/transitionDao.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label" for="sender">Send From</label>
                            <!-- <input class="form-control" type="text" name="sender" id="sender"> -->
                            <select name="sender" id="sender" class="form-select" aria-label="Default select example">
                                <?php if (isset($_GET['id'])) {  ?>
                                    <option value="<?php echo $senderId['user_id']; ?>">(<?php echo $senderId['user_id']; ?>) <?php echo $senderId['name']; ?></option>
                                <?php } else { ?>
                                    <option selected>Send From</option>
                                    <?php while ($r = $senderId->fetch()) { ?>
                                        <option value="<?php echo $r['user_id']; ?>">(<?php echo $r['user_id']; ?>) <?php echo $r['name']; ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="reciver">Send To</label>
                            <!-- <input class="form-control" type="text" name="reciver" id="reciver"> -->

                            <select name="receiver" id="receiver" class="form-select" aria-label="Default select example">
                                <option selected>Send From</option>
                                <?php while ($r = $reciverId->fetch()) { ?>
                                    <option value="<?php echo $r['user_id']; ?>">(<?php echo $r['user_id']; ?>) <?php echo $r['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="amount">Amount</label>
                            <input class="form-control" type="text" name="amount" id="amount">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="re-mark">Re-Mark</label>
                            <input class="form-control" type="text" name="re-mark" id="re-mark">
                        </div>
                        <div class="mb-3">
                            <input class="form-control btn btn-success" type="submit" name="submit" id="submit" value="Send">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>