<?php
    namespace DAO;

    use Models\JobOffer as JobOffer;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class JobOfferDAO implements IJobOfferDAO
    {
        private $connection;
        private $tableName = "jobOffers";
        private $tableJobPosition = "jobPositions";
        private $tableCompany = "companies";

        public function Add(JobOffer $jobOffer)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobPositionId, copmanyId, datePublished, remote, salary, skills, projectDescription, active) VALUES (:jobPositionId, :copmanyId, :datePublished, :remote, :salary, :skills, :projectDescription, :active);";
                
                $parameters["jobPositionId"] = $jobOffer->getJobPositionId();
                $parameters["copmanyId"] = $jobOffer->getCompanyId();
                $parameters["datePublished"] = $jobOffer->getDatePublished();
                $parameters["remote"] = $jobOffer->getRemote();
                $parameters["salary"] = $jobOffer->getSalary();
                $parameters["skills"] = $jobOffer->getSkills();
                $parameters["projectDescription"] = $jobOffer->getProjectDescription();
                $parameters["active"] = $jobOffer->getActive();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            try
            {
                $jobOfferList = array();

                $query = "SELECT jo.jobOfferId, jo.projectDescription, jo.salary, jo.remote, jp.description, c.name FROM ". $this->tableName. " jo INNER JOIN ". $this->tableJobPosition. " jp on jp.jobPositionId = jo.jobPositionId INNER JOIN ". $this->tableCompany. " c on c.copmanyId = jo.copmanyId;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobOff['jobOfferId'] = $row["jobOfferId"];
                    $jobOff['projectDescription'] = $row["projectDescription"];
                    $jobOff['salary'] = $row["salary"];
                    $jobOff['remote'] = $row["remote"];
                    $jobOff['description'] = $row["description"];
                    $jobOff['name'] = $row["name"];

                    array_push($jobOfferList, $jobOff);
                }

                return $jobOfferList;
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function GetJobOfferStudent($careerId)
        {
            try
            {
                $jobOfferList = array();

                $query = "SELECT jo.jobOfferId, jo.projectDescription, jo.salary, jo.remote, jp.description, c.name FROM ". $this->tableName. " jo INNER JOIN ". $this->tableJobPosition. " jp on jp.jobPositionId = jo.jobPositionId INNER JOIN ". $this->tableCompany. " c on c.copmanyId = jo.copmanyId WHERE (jp.careerId = :careerId)";

                $parameters['careerId'] = $careerId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {             
                    $jobOff['jobOfferId'] = $row["jobOfferId"];
                    $jobOff['projectDescription'] = $row["projectDescription"];
                    $jobOff['salary'] = $row["salary"];
                    $jobOff['remote'] = $row["remote"];
                    $jobOff['description'] = $row["description"];
                    $jobOff['name'] = $row["name"];

                    array_push($jobOfferList, $jobOff);
                }

                return $jobOfferList;
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        
        function remove($jobOfferId)
        {
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE (jobOfferId = :jobOfferId)";
    
                $parameters["jobOfferId"] =  $jobOfferId;
    
                $this->connection = Connection::GetInstance();
    
                return $count=$this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        function modify(JobOffer $jobOffer)
        {
            try
            {
                $query= "UPDATE ".$this->tableName." SET copmanyId = :copmanyId, datePublished = :datePublished, remote = :remote, salary = :salary, skills = :skills, projectDescription = :projectDescription
                WHERE (jobOfferId = :jobOfferId)";
    
                $parameters['jobOfferId']=$jobOffer->getJobOfferId();
                $parameters['copmanyId']=$jobOffer->getCompanyId();
                $parameters['datePublished']=$jobOffer->getDatePublished();
                $parameters['remote']=$jobOffer->getRemote();
                $parameters['salary']=$jobOffer->getSalary();
                $parameters['skills']=$jobOffer->getSkills();
                $parameters['projectDescription']=$jobOffer->getProjectDescription();
    
                $this->connection = Connection::GetInstance();
    
                return $count= $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }
        
    }
?>