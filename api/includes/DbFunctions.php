<?php
class DbFunctions{
    
    private $conn;

    function __construct()
    {
        require_once 'DbConfig.php';
        $database = new DbConfig();
        $this->conn = $database->connect();
    }

    /**
     * User Authentication
     */
    public function user_authentication($username, $password)
    {
        $sql = "SELECT * FROM super_admin WHERE username =? AND password =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array($username,$password));
        $result = $stmt->fetch();
        return $result;
    }


    /**
     * Get All users
     */
    public function get_users(){

        $sql = "SELECT * FROM super_admin";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
?>