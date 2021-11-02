<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;

    class CompanyController
    {
        private $companyDAO;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."add-company.php");
        }

        public function ShowListView()
        {
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."company-list.php");
        }

        public function ShowListViewStudent()
        {
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."student-company.php");
        }

        public function ShowModifyView()
        {
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."modify-company.php");
        }

        public function ShowCompanyView($name)
        {
            $company = $this->companyDAO->GetByName($name);
            $companyList = $this->companyDAO->GetAll();
            if($company != null){
                require_once(VIEWS_PATH."company.php");
            } else {
                echo "<script> if(alert('No se encontro la empresa')); </script>";
                require_once(VIEWS_PATH."student-company.php");
            }
        }

        public function Add($name, $cuit, $adress, $founded)
        {

            $company = new Company();
            $company->setName($name);
            $company->setCuit($cuit);
            $company->setAdress($adress);
            $company->setFounded($founded);
    
            $this->companyDAO->Add($company);

            $this->ShowAddView();
        }

        public function Remove($cuit)
        {
            try {
                $this->companyDAO->remove($cuit);
                $this->ShowListView();
            } catch (\PDOException $ex) {
                throw $ex;
            }
        }

        public function Modify($name, $cuit, $adress, $founded)
        {
            $companyModify = new Company();
            $companyModify->setName($name);
            $companyModify->setCuit($cuit);
            $companyModify->setAdress($adress);
            $companyModify->setFounded($founded);

            $this->companyDAO->modify($companyModify);

            $this->ShowListView();
        }
    }
?>