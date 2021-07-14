<?php
class Transition
{
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function getTransitionHistory($user_id)
    {

        try {
            $sql = "SELECT * FROM `transition records` WHERE sender =:sender OR receiver=:sender";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('sender', $user_id);
            $stmt->execute();
            return $stmt;
        }  catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
}
