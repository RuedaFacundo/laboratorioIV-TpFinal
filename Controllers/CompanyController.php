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
            $company = $this->companyDAO->getCompanyName($name);
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
            if($this->companyDAO->checkCompany($cuit) == null){
                $company = new Company();
                $company->setName($name);
                $company->setCuit($cuit);
                $company->setAdress($adress);
                $company->setFounded($founded);
    
                $this->companyDAO->Add($company);

                echo "<script> if(alert('Nueva empresa guardada')); </script>";
            } else {
                echo "<script> if(alert('La empresa ya existe')); </script>";
            }

            $this->ShowAddView();
        }

        public function Remove($codeToDelete)
        {
            $companyList = $this->companyDAO->GetAll();

            foreach($companyList as $company){
                if($company->getCuit() == $codeToDelete){
                    $companyToDelete = $company;
                }
            }
            if(isset($companyToDelete)){
                $this->companyDAO->remove($companyToDelete);
                $this->ShowListView();
            } else {
                echo "<script> if(alert('No se pudo eliminar la empresa')); </script>";
                $this->ShowListView();
            }
        }

        public function Modify($name, $cuit, $adress, $founded)
        {
            if($this->companyDAO->checkCompany($cuit) != null){
                $companyModify = new Company();
                $companyModify->setName($name);
                $companyModify->setCuit($cuit);
                $companyModify->setAdress($adress);
                $companyModify->setFounded($founded);
    
                $this->companyDAO->modify($companyModify);
            } else {
                echo "<script> if(alert('No existe la empresa a modificar')); </script>";
            }
            $this->ShowListView();
        }
    }
?>