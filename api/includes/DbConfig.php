<?php
    class DbConfig{

        private $conn;

        function __construct()
        {
            
        }

        function connect()
        {
            $this->conn = new PDO("mysql:host=localhost;dbname=hr","root","");
            return $this->conn;
        }
    }
?>