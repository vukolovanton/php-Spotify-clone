<?php
    class Account {
        private $errorArray;

        public function __construct() {
            $this->errorArray = array();
        }

        public function registerAccount($u, $e, $p1, $p2) {
            $this->validateUsername($u);
            $this->validateEmail($e);
            $this->validatePasswords($p1, $p2);

            if(empty($this->errorArray)) {
                return true;
            } else {
                return false;
            }
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
        }
        
        private function validateEmail($e) {
            if(!filter_var($e, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailError);
                return;
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