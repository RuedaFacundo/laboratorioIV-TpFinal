<?php
    namespace DAO;

    use Models\JobOffer as JobOffer;

    class JobOfferDAO 
    {
        private $jobOfferList = array();

        public function Add(JobOffer $jobOffer)
        {
            $this->RetrieveData();
            
            array_push($this->jobOfferList, $jobOffer);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->jobOfferList;
        }

        public function remove(JobOffer $jobOfferToDelete){
            
            $this->RetrieveData();
        
            if(($index = array_search($jobOfferToDelete, $this->jobOfferList)) !== false){
                unset($this->jobOfferList[$index]);
            }
        
            $this->saveData();
        }

        public function modify(JobOffer $jobOfferToModify){
            
            $this->RetrieveData();

            foreach($this->jobOfferList as $jobOffer){
                if($jobOffer->getJobOfferId() == $jobOfferToModify->getJobOfferId()){
                    $jobOffer->setJobPositionId($jobOfferToModify->getJobPositionId());
                    $jobOffer->setCuitCompany($jobOfferToModify->getCuitCompany());
                    $jobOffer->setDatePublished($jobOfferToModify->getDatePublished());
                    $jobOffer->setRemote($jobOfferToModify->getRemote());
                    $jobOffer->setSalary($jobOfferToModify->getSalary());
                    $jobOffer->setSkills($jobOfferToModify->getSkills());
                    $jobOffer->setProjectDescription($jobOfferToModify->getProjectDescription());
                    $jobOffer->setActive($jobOfferToModify->getActive());
                }
            }
        
            $this->saveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->jobOfferList as $jobOffer)
            {
                $valuesArray["jobOfferId"] = $jobOffer->getJobOfferId();
                $valuesArray["jobPositionId"] = $jobOffer->getJobPositionId();
                $valuesArray["cuitCompany"] = $jobOffer->getCuitCompany();
                $valuesArray["datePublished"] = $jobOffer->getDatePublished();
                $valuesArray["remote"] = $jobOffer->getRemote();
                $valuesArray["salary"] = $jobOffer->getSalary();
                $valuesArray["skills"] = $jobOffer->getSkills();
                $valuesArray["projectDescription"] = $jobOffer->getProjectDescription();
                $valuesArray["active"] = $jobOffer->getActive();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/JobOffer.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->jobOfferList = array();

            if(file_exists('Data/JobOffer.json'))
            {
                $jsonContent = file_get_contents('Data/JobOffer.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($valuesArray["jobOfferId"]);
                    $jobOffer->setJobPositionId($valuesArray["jobPositionId"]);
                    $jobOffer->setCuitCompany($valuesArray["cuitCompany"]);
                    $jobOffer->setDatePublished($valuesArray["datePublished"]);
                    $jobOffer->setRemote($valuesArray["remote"]);
                    $jobOffer->setSalary($valuesArray["salary"]);
                    $jobOffer->setSkills($valuesArray["skills"]);
                    $jobOffer->setProjectDescription($valuesArray["projectDescription"]);
                    $jobOffer->setActive($valuesArray["active"]);

                    array_push($this->jobOfferList, $jobOffer);
                }
            }
        }
    }
?>