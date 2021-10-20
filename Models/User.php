<?php
    namespace Models;

    class User 
    {
        private $username;

        public function getUserName() { return $this->username; }
        public function setUserName($username) { $this->username = $username; }
    }
?>