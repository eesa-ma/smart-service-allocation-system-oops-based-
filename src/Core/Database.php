<?php
    class Database {
        //database credentials
        private $host = "127.0.0.1:3306";
        private $db_name = "smartservice1";
        private $username = "root";
        private $password = "";
        private $conn;

        public function connect() {
            $this->conn = null; //close previous connections

            try {
                //create connection
                $this->conn = new mysqli($this->host,  $this->username, $this->password,$this->db_name);
            } catch (mysqli_sql_exception $e) {
                //shows error
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn; //return the connection object
        }
    }
?>
