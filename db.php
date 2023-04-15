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

        $this->conn = new mysqli($this->host_name, $this->user_name, $this->password);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Check if database exists
        $result = $this->conn->query('SHOW DATABASES');
        $databases = array();
        while ($row = $result->fetch_array()) {
            $databases[] = $row[0];
        }
        if (in_array($this->db_name, $databases)) {
            $this->conn->select_db($this->db_name);
            error_log("Database exists");
        } else {
            error_log("Database does not exist");
            $this->create_database();
        }
    }
    function create_database()
    {
        $sql = "CREATE DATABASE $this->db_name";
        if ($this->conn->query($sql) === TRUE) {
            error_log("Database created successfully");
            $this->conn->select_db($this->db_name);
        } else {
            error_log("Error creating database: " . $this->conn->error);
        }

        $this->create_table();
    }
    function create_table()
    {
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
        if ($this->conn->query($sql) === TRUE) {
            error_log("Table user created successfully");
        } else {
            error_log("Error creating table: " . $this->conn->error);
        }
    }
    function insert_data($fullname, $username, $email, $img, $phone, $addr, $pwd, $birthdate)
    {
        $sql = "INSERT INTO user (fullname, username, email, img, phone, addr, pwd, birthdate)
            VALUES ('$fullname', '$username', '$email','$img', '$phone', '$addr', '$pwd', '$birthdate')";
        // use exec() because no results are returned
        if ($this->conn->query($sql) === TRUE) {
            error_log("New record created successfully");
        } else {
            error_log("Error inserting data: " . $this->conn->error);
        }
    }
    function user_exists($username)
    {
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function __destruct()
    {
        $this->conn->close();
    }
}

$database = new Database("localhost", "project", "attai", "j");
