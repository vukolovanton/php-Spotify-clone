<?php
    class Album {
        private $id;
        private $conn;
        private $title;
        private $artistId;
        private $genre;
        private $artworkPath;

        public function __construct($conn, $id) {
            $this->conn = $conn;
            $this->id = $id;

            $query = "SELECT * FROM albums WHERE id='$this->id'";
            $albumQuery = mysqli_query($this->conn, $query);
            $album = mysqli_fetch_array($albumQuery);

            $this->title = $album['title'];
            $this->artistId = $album['artist'];
            $this->genre = $album['genre'];
            $this->artworkPath = $album['artworkPath'];
        }

        public function getTitle() {
            return $this->title;
        }

        public function getArtworkPath() {
            return $this->artworkPath;
        }

        public function getGenre() {
            return $this->genre;
        }

        public function getArtist() {
            return new Artist($this->conn, $this->artistId);
        }

        public function getNumberOfSongs() {
            $query = mysqli_query($this->conn, "SELECT * FROM songs WHERE album='$this->id' ");
            return mysqli_num_rows($query);
        }

        public function getSongIds() {
            $query = mysqli_query($this->conn, "SELECT id FROM songs WHERE album='$this->id' ORDER BY albumOrder ASC");
            $array = array();
            while ($row = mysqli_fetch_array($query)) {
                array_push($array, $row['id']);
            }

            return $array;
        }
    }

?>