<?php
    class Trafficdata {
        private $conn;
        private $table = 'Daily';


        public $date;
        public $ip;
        public $inBytes;
        public $outBytes;



        public function __construct($db) {
            $this->conn = $db;
        }

        public function read(){
            $query = 'SELECT * from '.$this->table.' WHERE date LIKE ?"/%"';

            $stmt= $this->conn->prepare($query);
            $stmt->bindParam(1, $this->month);
            $stmt->execute();

            return $stmt;
        }

        public function readip(){
            $query = 'SELECT * from '.$this->table.' WHERE ip= ? AND date LIKE ?"/%"';

            $stmt= $this->conn->prepare($query);
            $stmt->bindParam(1, $this->ip);
            $stmt->bindParam(2, $this->month);
         
            $stmt->execute();
 
	
            return $stmt;
        }
  
    }

?>
