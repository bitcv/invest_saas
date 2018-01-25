<?php
include_once __DIR__ . '/../config/Database.conf.php';

class DB {
    private $conn;

    public function __construct () {
        if (!$this->conn) {
            $this->conn = mysqli_connect(
                Database::HOST,
                Database::USER,
                Database::PASSWD,
                Database::DBNAME
            );
            if (!$this->conn) {
                throw new Exception('Mysql connect error' . mysqli_connect_error());
            }
        }
    }
    
    public function select($sql) {
        $result = mysqli_query($this->conn, $sql);
        if ($result === false) {
            throw new Exception('Mysql query error:' . $sql);
        }
        $dataList = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $dataList[] = $row;
        }
        return $dataList;
    }

    public function update($sql) {
        $result = mysqli_query($this->conn, $sql);
        if ($result === false) {
            throw new Exception('Mysql query error:' . $sql);
        }
        return mysqli_affected_rows($this->conn);
    }

    public function insert($sql) {
        $result = mysqli_query($this->conn, $sql);
        if ($result === false) {
            throw new Exception('Mysql query error:' . $sql);
        }
        return mysqli_insert_id($this->conn);
    }
}
