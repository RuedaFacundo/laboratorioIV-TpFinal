<?php
    namespace Models;

    class User 
    {
        private $studentId;
        private $careerId;
        private $firstName;
        private $lastName;
        private $dni;
        private $fileNumber;
        private $gender;
        private $birthDate;
        private $email;
        private $phoneNumber;
        private $active;
        private $profile;
        private $password;

        public function setStudentId($studentId) { $this->studentId = $studentId; }
        public function setCareerId($careerId) { $this->careerId = $careerId; }
        public function setFirstName($firstName) { $this->firstName = $firstName; }
        public function setLastName($lastName) { $this->lastName = $lastName; }
        public function setDni($dni) { $this->dni = $dni; }
        public function setFileNumber($fileNumber) { $this->fileNumber = $fileNumber; }
        public function setGender($gender) { $this->gender = $gender; }
        public function setBirthDate($birthDate) { $this->birthDate = $birthDate; }
        public function setEmail($email) { $this->email = $email; }
        public function setPhoneNumber($phoneNumber) { $this->phoneNumber = $phoneNumber; }
        public function setActive($active) { $this->active = $active; }
        public function setProfile($profile) { $this->profile = $profile; }
        public function setPassword($password) { $this->password = $password; }

        public function getStudentId () { return $this->studentId; }
        public function getCareerId () { return $this->careerId; }
        public function getFirstName () { return $this->firstName; }
        public function getLastName () { return $this->lastName; }
        public function getDni () { return $this->dni; }
        public function getFileNumber () { return $this->fileNumber; }
        public function getGender () { return $this->gender; }
        public function getBirthDate () { return $this->birthDate; }
        public function getEmail () { return $this->email; }
        public function getPhoneNumber () { return $this->phoneNumber; }
        public function getActive () { return $this->active; }
        public function getProfile() { return $this->profile; }
        public function getPassword() { return $this->password; }
    }
?>

