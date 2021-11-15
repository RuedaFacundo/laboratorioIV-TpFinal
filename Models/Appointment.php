<?php
    namespace Models;

    class Appointment 
    {
        private $appointmentId;
        private $jobOffer;
        private $student;
        private $message;
        private $cv;
        private $active;

        public function getAppointmentId() { return $this->appointmentId; }
        public function setAppointmentId($appointmentId) { $this->appointmentId = $appointmentId; }
        public function getJobOffer() { return $this->jobOffer; }
        public function setJobOffer(JobOffer $jobOffer) { $this->jobOffer = $jobOffer; }
        public function getStudent() { return $this->student; }
        public function setStudent(User $student) { $this->student = $student; }
        public function getMessage() { return $this->message; }
        public function setMessage($message) { $this->message = $message; }
        public function getCv() { return $this->cv; }
        public function setCv($cv) { $this->cv = $cv; }
        public function getActive() { return $this->active; }
        public function setActive($active) { $this->active = $active; }
    }
?>