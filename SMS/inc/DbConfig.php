<?php

/**
 * Created by PhpStorm.
 * User: Lynford
 * Date: 16/06/2019
 * Time: 12:50 PM
 */
class DbConfig
{

    private $conn;

    function __construct(){

    }

    /**
     * Database Mysql Connection
     */
    function connect(){

        $this->conn = new PDO('mysql:host=localhost;dbname=hr',"root","");
        return $this->conn;
    }
}