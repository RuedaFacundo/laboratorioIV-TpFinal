<?php
    namespace Models;

    class JobOffer
    {
        private $jobPositionId;
        private $companyId;
        private $datePublished;
        private $remote;
        private $salary;
        private $skills;
        private $projectDescription;
        private $active;

        public function getJobPositionId() { return $this->jobPositionId; }
        public function setJobPositionId($jobPositionId) { $this->jobPositionId = $jobPositionId; }
        public function getCompanyId() { return $this->companyId; }
        public function setCompanyId($companyId) { $this->companyId = $companyId; }
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