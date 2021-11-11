<?php
    namespace Models;

    class JobOffer
    {
        private $jobOfferId;
        private $jobPosition;
        private $company;
        private $datePublished;
        private $remote;
        private $salary;
        private $skills;
        private $projectDescription;
        private $active;

        public function getJobOfferId() { return $this->jobOfferId; }
        public function setJobOfferId($jobOfferId) { $this->jobOfferId = $jobOfferId; }
        public function getJobPosition() { return $this->jobPosition; }
        public function setJobPosition(JobPosition $jobPosition) { $this->jobPosition = $jobPosition; }
        public function getCompany() { return $this->company; }
        public function setCompany(Company $company) { $this->company = $company; }
        public function getDatePublished() { return $this->datePublished; }
        public function setDatePublished($datePublished) { $this->datePublished = $datePublished; }
        public function getRemote() { return $this->remote; }
        public function setRemote($remote) { $this->remote = $remote; }
        public function getSalary() { return $this->salary; }
        public function setSalary($salary) { $this->salary = $salary; }
        public function getSkills() { return $this->skills; }
        public function setSkills($skills) { $this->skills = $skills; }
        public function getProjectDescription() { return $this->projectDescription; }
        public function setProjectDescription($projectDescription) { $this->projectDescription = $projectDescription; }
        public function getActive() { return $this->active; }
        public function setActive($active) { $this->active = $active; }
    }
?>