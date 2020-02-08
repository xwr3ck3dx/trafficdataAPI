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
            $query = 'SELECT * from '.$this->table;

            $stmt= $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        public function readip(){
            $query = 'SELECT * from '.$this->table.' WHERE ip= ?';

            $stmt= $this->conn->prepare($query);
 	    $stmt->bindParam(1, $this->ip);
            $stmt->execute();
 
	
            return $stmt;
        }
  
    }

?>
