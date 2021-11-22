<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\UserDAO as UserDAO;
    use DAO\CareerDAO as CareerDAO;
    use Models\JobPosition as JobPosition;
    use Models\JobOffer as JobOffer;
    use Models\Company as Company;
    use Models\User as User;
    use Models\Career as Career;

    class JobOfferController
    {
        private $JobOfferDAO;
        private $JobPositionDAO;
        private $CompanyDAO;
        private $UserDAO;
        private $CareerDAO;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
            $this->JobPositionDAO = new JobPositionDAO();
            $this->CompanyDAO = new CompanyDAO();
            $this->UserDAO = new UserDAO ();
            $this->careerDAO = new CareerDAO();
        }

        public function ShowAddView()
        {
            $jobPositionList = $this->JobPositionDAO->GetAll();
            $careerList = $this->careerDAO->GetAll();
            if($jobPositionList == null){
                $jobPositionList = $this->JobPositionDAO->getAllApi();
            }
            $companyList = $this->CompanyDAO->GetAll();
            require_once(VIEWS_PATH."add-jobOffer.php");
        }

        public function ShowAddViewCompany()
        {
            $jobPositionList = $this->JobPositionDAO->GetAll();
            $careerList = $this->careerDAO->GetAll();
            if($jobPositionList == null){
                $jobPositionList = $this->JobPositionDAO->getAllApi();
            }
            require_once(VIEWS_PATH."add-jobOfferCompany.php");
        }

        public function ShowModifyView()
        {
            $jobOfferList = $this->jobOfferDAO->GetAll();
            $jobPositionList = $this->JobPositionDAO->GetAll();
            $careerList = $this->careerDAO->GetAll();
            if($jobPositionList == null){
                $jobPositionList = $this->JobPositionDAO->getAllApi();
            }
            $companyList = $this->CompanyDAO->GetAll();
            require_once(VIEWS_PATH."modify-jobOffer.php");
        }

        public function ShowListView()
        {
            $jobOfferList = $this->jobOfferDAO->GetAll();

            require_once(VIEWS_PATH."jobOffer-list.php");
        }

        public function ShowListStudent()
        {
            $student = $this->UserDAO->GetApiByEmail($_SESSION['loggedUser']->getEmail());
            $jobOfferList = $this->jobOfferDAO->GetJobOfferStudent($student->getCareerId());

            require_once(VIEWS_PATH."jobOffer-listStudent.php");
        }

        public function ShowListOffersByJobPosition($jobPosition)
        {
            $jobOfferList = $this->jobOfferDAO->GetOffersByJobPosition($jobPosition);
            if($jobOfferList){
                require_once(VIEWS_PATH."jobOffer-listFilter.php");
            } else {
                echo "<script> if(alert('No se encontraron ofertas laborales del puesto ingresado')); </script>";
                $this->ShowListView();
            }
        }

        public function ShowListOffersByCareer($career)
        {
            $jobOfferList = $this->jobOfferDAO->GetOffersByCareer($career);
            if($jobOfferList){
                require_once(VIEWS_PATH."jobOffer-listFilter.php");
            } else {
                echo "<script> if(alert('No se encontraron ofertas laborales de la carrera ingresada')); </script>";
                $this->ShowListView();
            }
        }

        public function ShowListOffersByCompany()
        {
            $jobOfferList = $this->jobOfferDAO->GetOffersByCompany($_SESSION['loggedUser']->getEmail());
            if($jobOfferList){
                require_once(VIEWS_PATH."jobOffer-listFilter.php");
            } else {
                echo "<script> if(alert('No se encontraron ofertas laborales de la empresa ingresada')); </script>";
                $this->ShowAddViewCompany();
            }
        }

        public function Add($nameCompany, $jobPositionId, $datePublished, $remote, $salary, $skills, $projectDescription)
        {
            $jobOffer = new JobOffer();
            $company = new Company();
            $jobPosition = new JobPosition();
            $company = $this->CompanyDAO->GetByName($nameCompany);
            $jobPosition = $this->JobPositionDAO->GetById($jobPositionId);
            $jobOffer->setCompany($company[0]);
            $jobOffer->setJobPosition($jobPosition[0]);
            $jobOffer->setDatePublished($datePublished);
            $jobOffer->setRemote($remote);
            $jobOffer->setSalary($salary);
            $jobOffer->setSkills($skills);
            $jobOffer->setProjectDescription($projectDescription);
            $jobOffer->setActive(true);

            try {
                $this->jobOfferDAO->Add($jobOffer);
            } catch (Exception $e){
                echo "<script> if(alert('No se pudo agregar la oferta laboral')); </script>";
            }

            $this->ShowAddView();
        }

        public function AddByCompany($emailCompany, $jobPositionId, $datePublished, $remote, $salary, $skills, $projectDescription)
        {
            $jobOffer = new JobOffer();
            $company = new Company();
            $jobPosition = new JobPosition();
            $company = $this->CompanyDAO->GetByEmail($emailCompany);
            $jobPosition = $this->JobPositionDAO->GetById($jobPositionId);
            $jobOffer->setCompany($company[0]);
            $jobOffer->setJobPosition($jobPosition[0]);
            $jobOffer->setDatePublished($datePublished);
            $jobOffer->setRemote($remote);
            $jobOffer->setSalary($salary);
            $jobOffer->setSkills($skills);
            $jobOffer->setProjectDescription($projectDescription);
            $jobOffer->setActive(true);

            $this->jobOfferDAO->Add($jobOffer);

            $this->ShowAddViewCompany();
        }

        public function Remove($id)
        {
            $JobOfferRemove = $this->jobOfferDAO->remove($id);
            if($JobOfferRemove == null ){
                echo "<script> if(alert('No se pudo eliminar la oferta laboral')); </script>";
            }
            $this->ShowListView();
        }

        public function Modify($id, $nameCompany, $jobPositionId, $datePublished, $remote, $salary, $skills, $projectDescription)
        {
            $jobOffer = new JobOffer();
            $jobOffer->setJobOfferId($id);
            $company = new Company();
            $jobPosition = new JobPosition();
            $company = $this->CompanyDAO->GetByName($nameCompany);
            $jobPosition = $this->JobPositionDAO->GetById($jobPositionId);
            $jobOffer->setCompany($company[0]);
            $jobOffer->setJobPosition($jobPosition[0]);
            $jobOffer->setDatePublished($datePublished);
            $jobOffer->setRemote($remote);
            $jobOffer->setSalary($salary);
            $jobOffer->setSkills($skills);
            $jobOffer->setProjectDescription($projectDescription);

            try {
                $this->jobOfferDAO->modify($jobOffer);
            } catch (Exception $e){
                echo "<script> if(alert('No se pudo modificar la oferta laboral')); </script>";
            }

            $this->ShowListView();
        }

        public function Cancel ($id)
        {
            try {
                $this->jobOfferDAO->Disable($id);
            } catch (Exception $e) {
                echo "<script> if(alert('No se pudo desactivar la postulacion')); </script>"; 
            }

            if($_SESSION['loggedUser']->getProfile() == 'Company'){
                $this->ShowListOffersByCompany();
            } else if ($_SESSION['loggedUser']->getProfile() == 'Admin'){
                $this->ShowListView();
            }
        }
    }
?>