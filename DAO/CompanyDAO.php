<?php
    namespace DAO;

    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;

    class CompanyDAO implements ICompanyDAO
    {
        private $companyList = array();

        public function Add(Company $company)
        {
            $this->RetrieveData();
            
            array_push($this->companyList, $company);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->companyList;
        }

        public function checkCompany($cuit)
        {
            $this->RetrieveData();

            foreach($this->companyList as $company){
                if($company->getCuit() == $cuit){
                    $companyCheck = $company;
                } else {
                    $companyCheck = null;
                }
            }

            return $companyCheck;
        }

        public function remove(Company $companyToDelete){
            
            $this->RetrieveData();
        
            if(($index = array_search($companyToDelete, $this->companyList)) !== false){
                unset($this->companyList[$index]);
            }
        
            $this->saveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->companyList as $company)
            {
                $valuesArray["name"] = $company->getName();
                $valuesArray["cuit"] = $company->getCuit();
                $valuesArray["adress"] = $company->getAdress();
                $valuesArray["founded"] = $company->getFounded();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/Company.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->companyList = array();

            if(file_exists('Data/Company.json'))
            {
                $jsonContent = file_get_contents('Data/Company.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $company = new Company();
                    $company->setName($valuesArray["name"]);
                    $company->setCuit($valuesArray["cuit"]);
                    $company->setAdress($valuesArray["adress"]);
                    $company->setFounded($valuesArray["founded"]);

                    array_push($this->companyList, $company);
                }
            }
        }
    }
?>