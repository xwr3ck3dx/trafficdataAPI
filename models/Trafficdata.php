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
            $query = 'SELECT * from '.$this->table.' ORDER BY date INC';

            $stmt= $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }
    }

?>