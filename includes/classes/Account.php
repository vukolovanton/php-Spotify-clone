<?php
    class Account {
        private $errorArray;
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
            $this->errorArray = array();
        }

        public function loginAccount($e, $p) {
            $encryptedPassword = md5($p);

            $query = "SELECT * FROM users WHERE email='$e' AND password='$encryptedPassword'";
            $login_query = mysqli_query($this->conn, $query);

            if(mysqli_num_rows($login_query) == 1) {
                return true;
            } else {
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }

        public function registerAccount($u, $e, $p1, $p2) {
            $this->validateUsername($u);
            $this->validateEmail($e);
            $this->validatePasswords($p1, $p2);

            if(empty($this->errorArray)) {
                return $this->insertUserDetails($u, $e, $p1);
            } else {
                return false;
            }
        }

        private function insertUserDetails($u, $e, $p1) {
            $encryptedPassword = md5($p1);
            $profilePic = Constants::$userPlaceholderPic;

            $query = "INSERT INTO users (username, email, password, profilePicture) VALUES ('$u', '$e', '$encryptedPassword', '$profilePic') ";

            $register_query = mysqli_query($this->conn, $query);

            if(!$query) {
                die("QUERY FAILED" . mysqli_error($register_query));
            }

            return $register_query;
        }

        public function getErrorMessage($error) {
            if(!in_array($error, $this->errorArray)) {
                $error = "";
            }
            return "<span class='errorMessage'>$error</span>";
        }

        private function validateUsername($u) {
            if(strlen($u) > 25 || strlen($u) < 5 ) {
                array_push($this->errorArray, Constants::$usernameError);
                return;
            }

            $query = "SELECT username FROM users WHERE username='$u'";
            $checkUsernameQuery = mysqli_query($this->conn, $query);
            if(mysqli_num_rows($checkUsernameQuery) != 0) {
                array_push($this->errorArray, Constants::$usernameTaken);
            }
        }
        
        private function validateEmail($e) {
            if(!filter_var($e, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailError);
                return;
            }

            $query = "SELECT email FROM users WHERE username='$e'";
            $checkEmailQuery = mysqli_query($this->conn, $query);
            if(mysqli_num_rows($checkEmailQuery) != 0) {
                array_push($this->errorArray, Constants::$emailTaken);
            }
         }
        
        private function validatePasswords($p1, $p2) {
            if (preg_match('/[^A-Za-z0-9]/', $p1)) {
                array_push($this->errorArray, Constants::$passwordContainsError);
                return;
            }

            if ($p1 !== $p2) {
                array_push($this->errorArray, Constants::$passwordNotMatch);
                return;
            }
        }
    }
?>