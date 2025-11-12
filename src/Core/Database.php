<?php
    class Database {
        //database credentials
        private $host = "127.0.0.1";
        private $port = 3306;
        private $db_name = "smartservice1";
        private $username = "root";
        private $password = "";
        private $conn;

        public function connect() {
            $this->conn = null; //close previous connections

            try {
                //create connection
                $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name, $this->port);
                
                // Check connection
                if ($this->conn->connect_error) {
                    throw new mysqli_sql_exception("Connection failed: " . $this->conn->connect_error);
                }
                
                // Set charset to utf8mb4 for better compatibility
                $this->conn->set_charset("utf8mb4");
                
            } catch (mysqli_sql_exception $e) {
                //shows error
                error_log('Database Connection Error: ' . $e->getMessage());
                echo 'Connection Error: ' . $e->getMessage();
                return null;
            }

            return $this->conn; //return the connection object
        }
    }
?>
