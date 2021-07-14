<?php
class Customers
{
    private $db;

    function __construct($conn)
    {
        $this->db = $conn;
    }

    public function getCustomers()
    {
        try {
            $sql = "SELECT * FROM users";
            $results = $this->db->query($sql);
            return $results;
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function getCustomersProfile($user_id)
    {
        try {
            $sql = "SELECT * FROM users WHERE user_id = :user_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('user_id', $user_id);
            $stmt->execute();
            $results = $stmt->fetch();

            return $results;

        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
}
