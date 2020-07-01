<?php
    class Artist {
        private $id;
        private $conn;

        public function __construct($conn, $id) {
            $this->conn = $conn;
            $this->id = $id;
        }

        public function getName() {
            $query = "SELECT name FROM artists WHERE id='$this->id'";
            $artistQuery = mysqli_query($this->conn, $query);
            $artist = mysqli_fetch_array($artistQuery);
            return $artist['name'];
        }

        public function getId() {
            return $this->id;
        }

        public function getSongsIds() {
            $query = mysqli_query($this->conn, "SELECT id FROM songs WHERE artist='$this->id'");
            $array = array();

            while($row = mysqli_fetch_array($query)) {
                array_push($array, $row['id']);
            }

            return $array;
        }
    }

?>