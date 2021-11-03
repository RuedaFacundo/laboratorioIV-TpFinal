<?php
    namespace Models;

    class Appointment 
    {
        private $jobOfferId;
        private $studentId;
        private $message;
        private $cv;

        public function getJobOfferId() { return $this->jobOfferId; }
        public function setJobOfferId($jobOfferId) { $this->jobOfferId = $jobOfferId; }
        public function getStudentId() { return $this->studentId; }
        public function setStudentId($studentId) { $this->studentId = $studentId; }
        public function getMessage() { return $this->message; }
        public function setMessage($message) { $this->message = $message; }
        public function getCv() { return $this->cv; }
        public function setCv($cv) { $this->cv = $cv; }
    }
?>