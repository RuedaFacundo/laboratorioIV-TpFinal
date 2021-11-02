<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\CareerDAO as CareerDAO;
    use Models\JobPosition as JobPosition;
    use Models\JobOffer as JobOffer;
    use Models\Company as Company;
    use Models\Career as Career;

    class JobOfferController
    {
        private $JobOfferDAO;
        private $JobPositionDAO;
        private $CompanyDAO;
        private $CareerDAO;
        private $careerList;
        private $jobPositionList;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
            $this->JobPositionDAO = new JobPositionDAO();
            $this->CompanyDAO = new CompanyDAO();
            $this->CareerDAO = new CareerDAO ();
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

        public function ShowListView()
        {
            $jobOfferList = $this->jobOfferDAO->GetAll();

            require_once(VIEWS_PATH."jobOffer-list.php");
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
    }
?>