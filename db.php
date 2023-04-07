<?php
class Database
{

    private $host_name, $db_name, $user_name, $password, $conn;

    function __construct()
    {
        $this->host_name = "HOST_NAME";
        $this->db_name = "DBNAME";
        $this->user_name = "USERNAME";
        $this->password = "PASSWORD";
        try {
            $this->conn = new PDO("mysql:host=$this->host_name", $this->user_name, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    function create_database()
    {
        try {
            $sql = "CREATE DATABASE $this->db_name";
            $this->conn->exec($sql);
            echo "Database created successfully";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    function create_table()
    {
        try {
            // sql to create table
            $sql = "CREATE TABLE user (
                fullname VARCHAR(200) NOT NULL,
                username VARCHAR(50)  PRIMARY KEY,
                email VARCHAR(50),
                ImageName varchar(200),
                phone VARCHAR(50),
                Addr VARCHAR(50),
                pwd VARCHAR(50),
            )";
            $this->conn->exec($sql);
            echo "Table MyGuests created successfully";

            // use exec() because no results are returned
            $this->conn->exec($sql);
            echo "Table MyGuests created successfully";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    function __destruct()
    {
        $this->conn = null;
    }
}
