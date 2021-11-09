<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\UserDAO as UserDAO;
    use Models\JobPosition as JobPosition;
    use Models\JobOffer as JobOffer;
    use Models\Company as Company;
    use Models\User as User;

    class JobOfferController
    {
        private $JobOfferDAO;
        private $JobPositionDAO;
        private $CompanyDAO;
        private $UserDAO;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
            $this->JobPositionDAO = new JobPositionDAO();
            $this->CompanyDAO = new CompanyDAO();
            $this->UserDAO = new UserDAO ();
        }

        public function ShowAddView()
        {
            $jobPositionList = $this->JobPositionDAO->GetAll();
            if($jobPositionList == null){
                $jobPositionList = $this->JobPositionDAO->getAllApi();
            }
            $companyList = $this->CompanyDAO->GetAll();
            require_once(VIEWS_PATH."add-jobOffer.php");
        }

        public function ShowModifyView()
        {
            $jobOfferList = $this->jobOfferDAO->GetAll();
            $jobPositionList = $this->JobPositionDAO->GetAll();
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

            require_once(VIEWS_PATH."jobOffer-listFilter.php");
        }

        public function ShowListOffersByCareer($career)
        {
            $jobOfferList = $this->jobOfferDAO->GetOffersByCareer($career);

            require_once(VIEWS_PATH."jobOffer-listFilter.php");
        }

        public function Add($nameCompany, $jobPositionId, $datePublished, $remote, $salary, $skills, $projectDescription)
        {
            $jobOffer = new JobOffer();
            $company = new Company();
            $company = $this->CompanyDAO->GetByName($nameCompany);
            $jobOffer->setCompanyId($company[0]->getCompanyId());
            $jobOffer->setJobPositionId($jobPositionId);
            $jobOffer->setDatePublished($datePublished);
            $jobOffer->setRemote($remote);
            $jobOffer->setSalary($salary);
            $jobOffer->setSkills($skills);
            $jobOffer->setProjectDescription($projectDescription);
            $jobOffer->setActive(true);

            $this->jobOfferDAO->Add($jobOffer);

            $this->ShowAddView();
        }

        public function Remove($id)
        {
            try {
                $this->jobOfferDAO->remove($id);
                $this->ShowListView();
            } catch (\PDOException $ex) {
                throw $ex;
            }
        }

        public function Modify($id, $nameCompany, $jobPositionId, $datePublished, $remote, $salary, $skills, $projectDescription)
        {
            $jobOffer = new JobOffer();
            $jobOffer->setJobOfferId($id);
            $company = new Company();
            $company = $this->CompanyDAO->GetByName($nameCompany);
            $jobOffer->setCompanyId($company[0]->getCompanyId());
            $jobOffer->setJobPositionId($jobPositionId);
            $jobOffer->setDatePublished($datePublished);
            $jobOffer->setRemote($remote);
            $jobOffer->setSalary($salary);
            $jobOffer->setSkills($skills);
            $jobOffer->setProjectDescription($projectDescription);

            $this->jobOfferDAO->modify($jobOffer);

            $this->ShowListView();
        }
    }
?>