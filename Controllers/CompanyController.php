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
                echo "No se pudo eliminar la empresa";
            }
        }
    }
?>