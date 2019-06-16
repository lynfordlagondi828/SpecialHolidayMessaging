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
         * add special occasions
         */
        public function add_special_occasions($so_name,$so_acr,$so_date_start,$so_date_end){
            
            $sql = "INSERT INTO special_occasions(so_name,so_acr,so_date_start,so_date_end)VALUES(?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($so_name,$so_acr,$so_date_start,$so_date_end));
            $result = $stmt->fetch();
            return $result;
        }

        /**
         * Check Special Occassions
         */
        public function check_occasion($so_name){

            $sql = "SELECT * FROM special_occasions WHERE so_name = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($so_name));
            $result = $stmt->fetch();
            return $result;
        }

        /**
         * get all employee
         */
        public function get_all_employee(){
            $sql = "SELECT * FROM emp";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array());
            $result = $stmt->fetchAll();
            return $result;
        }
    }
?>