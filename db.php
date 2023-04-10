<?php
class Database
{

    private $host_name, $db_name, $user_name, $password, $conn;

    function __construct($host_name, $db_name, $user_name, $password)
    {
        $this->host_name = $host_name;
        $this->db_name = $db_name;
        $this->user_name = $user_name;
        $this->password = $password;

        try {
            $this->conn = new PDO("mysql:host=$this->host_name", $this->user_name, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $this->conn->query('SHOW DATABASES');
            $databases = $result->fetchAll(PDO::FETCH_COLUMN);
            error_log(print_r($databases, true));
            if (in_array($this->db_name, $databases)) {
                $this->conn->exec("USE $this->db_name");
                error_log("Database exists");
            } else {
                error_log("Database does not exist");
                $this->create_database();
            }
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    }
    function create_database()
    {
        try {
            $sql = "CREATE DATABASE $this->db_name";
            $this->conn->exec($sql);
            error_log("Database created successfully");
            $this->conn->exec("USE $this->db_name");
        } catch (PDOException $e) {
            error_log($sql . "<br>" . $e->getMessage());
        }
        $this->create_table();
    }
    function create_table()
    {
        try {
            // sql to create table
            $sql = "CREATE TABLE user (
                fullname VARCHAR(200) NOT NULL,
                username VARCHAR(50)  PRIMARY KEY,
                email VARCHAR(50) NOT NULL,
                img VARCHAR(200) NOT NULL,
                phone VARCHAR(50) NOT NULL,
                addr VARCHAR(50) NOT NULL,
                pwd VARCHAR(50) NOT NULL,
                birthdate VARCHAR(50) NOT NULL
            )";
            // use exec() because no results are returned
            $this->conn->exec($sql);
            error_log("Table user created successfully");
        } catch (PDOException $e) {
            error_log($sql . "<br>" . $e->getMessage());
        }
    }
    function insert_data($fullname, $username, $email, $img, $phone, $addr, $pwd, $birthdate)
    {
        try {
            $sql = "INSERT INTO user (fullname, username, email, img, phone, addr, pwd, birthdate)
            VALUES ('$fullname', '$username', '$email','$img', '$phone', '$addr', '$pwd', '$birthdate')";
            // use exec() because no results are returned
            $this->conn->exec($sql);
            error_log("New record created successfully");
        } catch (PDOException $e) {
            error_log($sql . "<br>" . $e->getMessage());
        }
    }
    function user_exists($username)
    {
        try {
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $result = $this->conn->query($sql);
            $user = $result->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log($sql . "<br>" . $e->getMessage());
        }
    }
    function __destruct()
    {
        $this->conn = null;
    }
}
