<?php
require_once "db/dbconn.php";

$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$amount = $_POST['amount'];
$re_mark = $_POST['re-mark'];

try {
    // sender
    $fetchSenderAmount = "SELECT `bankAmount` FROM `users` WHERE user_id =:sender";
    $SenderAmount = $pdo->prepare($fetchSenderAmount);
    $SenderAmount->bindParam('sender', $sender);
    $SenderAmount->execute();
    $sav = $SenderAmount->fetch();
    if ($sav['bankAmount'] < $amount) {
        ?>
        <script>alert('balance not enugph')</script>;
        <?php

        // header("Location: customerDetalis.php?id=$sender");
    } else {
        $remainAmount = $sav['bankAmount'] - $amount;
        // echo $remainAmount;
        $sqlSender = "UPDATE `users` SET `bankAmount`=:remainAmount WHERE user_id =:sender";
        $SenderRemainAmount = $pdo->prepare($sqlSender);
        $SenderRemainAmount->bindParam('remainAmount', $remainAmount);
        $SenderRemainAmount->bindParam('sender', $sender);
        $SenderRemainAmount->execute();
    }

    // receiver
    $fetchReceiverAmount = "SELECT `bankAmount` FROM `users` WHERE user_id =:receiver";
    $ReceiverAmount = $pdo->prepare($fetchReceiverAmount);
    $ReceiverAmount->bindParam('receiver', $receiver);
    $ReceiverAmount->execute();
    $rav = $ReceiverAmount->fetch();


    $newAmount = $rav['bankAmount'] + $amount;
    // echo $newAmount;
    $sqlReceiver = "UPDATE `users` SET `bankAmount`=:newAmount WHERE user_id =:receiver";
    $receiverNewAmount = $pdo->prepare($sqlReceiver);
    $receiverNewAmount->bindParam('newAmount', $newAmount);
    $receiverNewAmount->bindParam('receiver', $receiver);
    $receiverNewAmount->execute();

    $sql = "INSERT INTO `transition records`(`sender`, `receiver`, `amount`) VALUES (:sender ,:receiver ,:amount )";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam('sender', $sender);
    $stmt->bindParam('receiver', $receiver);
    $stmt->bindParam('amount', $amount);
    $stmt->execute();



    // $sql2 = "UPDATE `users` SET `bankAmount`=[value-5] WHERE 1";

    // header("Location: customerDetalis.php?id=$sender");
} catch (PDOException $th) {
    echo $th->getMessage();
}
