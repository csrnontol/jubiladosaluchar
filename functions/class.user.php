<?php

/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 30/01/2017
 * Time: 0:04
 */
class Database {
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'jubiladosaluchar';
    public $conn;

    public function classdbconnection() {
        $this->conn = null;
        $this->conn = new mysqli($this->hostname, $this->username, $this->password);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        $this->conn->select_db($this->database);

        if (!$this->conn->set_charset("utf8")) {
            die("Error loading character set. " . $this->conn->error);
        }
        return $this->conn;
    }
}


class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $db = $database->classdbconnection();
        $this->conn = $db;
    }

    public function doLogin($table, $uname, $uemail, $upass) {
        $stmt = $this->conn->prepare("SELECT password FROM $table WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $uname, $uemail);
        if ($stmt->execute()) {
            $res = $stmt->get_result();
            $admin_row = $res->fetch_assoc();
            if ($res->num_rows == 1) {
                return (password_verify($upass, $admin_row['password']));
            } else {
                return false;
            }
        } else {
            echo $this->conn->error;
            return false;
        }
    }

    public function runQuery($sql) {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
}