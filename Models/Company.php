<?php
    namespace Models;

    class Company 
    {
        private $companyId;
        private $name;
        private $cuit;
        private $adress;
        private $founded;
        private $email;

        public function getCompanyId() { return $this->companyId; }
        public function setCompanyId($companyId) { $this->companyId = $companyId; }
        public function getName() { return $this->name; }
        public function setName($name) { $this->name = $name; }
        public function getCuit() { return $this->cuit; }
        public function setCuit($cuit) { $this->cuit = $cuit; }
        public function getAdress() { return $this->adress; }
        public function setAdress($adress) { $this->adress = $adress; }
        public function getFounded() { return $this->founded; }
        public function setFounded($founded) { $this->founded = $founded; }
        public function getEmail() { return $this->email; }
        public function setEmail($email) { $this->email = $email; }
    }
?>