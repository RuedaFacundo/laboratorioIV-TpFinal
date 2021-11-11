<?php
    namespace Models;

    class Appointment 
    {
        private $jobOffer;
        private $student;
        private $message;
        private $cv;

        public function getJobOffer() { return $this->jobOffer; }
        public function setJobOffer(JobOffer $jobOffer) { $this->jobOffer = $jobOffer; }
        public function getStudent() { return $this->student; }
        public function setStudent(User $student) { $this->student = $student; }
        public function getMessage() { return $this->message; }
        public function setMessage($message) { $this->message = $message; }
        public function getCv() { return $this->cv; }
        public function setCv($cv) { $this->cv = $cv; }
    }
?>