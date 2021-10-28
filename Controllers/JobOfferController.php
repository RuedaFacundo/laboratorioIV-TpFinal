<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use Models\JobPosition as JobPosition;
    use Models\JobOffer as JobOffer;
    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;

    class JobOfferController
    {
        private $JobOfferDAO;
        private $JobPositionDAO;
        private $CompanyDAO;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
            $this->JobPositionDAO = new JobPositionDAO();
            $this->CompanyDAO = new CompanyDAO();
        }

        public function ShowAddView()
        {
            $jobPositionList = $this->JobPositionDAO->GetAllApi();
            $companyList = $this->CompanyDAO->GetAll();
            require_once(VIEWS_PATH."add-jobOffer.php");
        }

        public function ShowListView()
        {
            $jobOfferList = $this->jobOfferDAO->GetAll();

            require_once(VIEWS_PATH."jobOffer-list.php");
        }

        public function ShowModifyView()
        {
            $jobOfferList = $this->jobOfferDAO->GetAll();

            require_once(VIEWS_PATH."modify-jobOffer.php");
        }

        public function Add($cuitCompany, $jobPositionId, $datePublished, $remote, $salary, $skills, $projectDescription)
        {
                $jobOffer = new JobOffer();
                $jobOffer->setJobOfferId(1);
                $jobOffer->setCuitCompany($cuitCompany);
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
    }
?>