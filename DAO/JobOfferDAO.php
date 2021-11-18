<?php
    namespace DAO;

    use Models\JobOffer as JobOffer;
    use \Exception as Exception;
    use DAO\IJobOfferDAO as IJobOfferDAO;
    use DAO\Connection as Connection;
    use Models\User as User;
    use Models\JobPosition as JobPosition;
    use Models\Company as Company;

    class JobOfferDAO implements IJobOfferDAO
    {
        private $connection;
        private $tableName = "jobOffers";
        private $tableJobPosition = "jobPositions";
        private $tableCompany = "companies";
        private $tableCareer = "careers";

        public function Add(JobOffer $jobOffer)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobPositionId, copmanyId, datePublished, remote, salary, skills, projectDescription, active) VALUES (:jobPositionId, :copmanyId, :datePublished, :remote, :salary, :skills, :projectDescription, :active);";
                
                $parameters["jobPositionId"] = $jobOffer->getJobPosition()->getJobPositionId();
                $parameters["copmanyId"] = $jobOffer->getCompany()->getCompanyId();
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
                echo "<script> if(alert('No se pudo agregar la oferta laboral')); </script>";
            }
        }

        public function GetAll()
        {
            try
            {
                $jobOfferList = array();

                $query = "SELECT jo.jobOfferId, jo.projectDescription, jo.salary, jo.skills, jo.remote, jo.active, jp.description, c.name FROM ". $this->tableName. " jo INNER JOIN ". $this->tableJobPosition. " jp on jp.jobPositionId = jo.jobPositionId INNER JOIN ". $this->tableCompany. " c on c.copmanyId = jo.copmanyId;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {               
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($row["jobOfferId"]);
                    $jobOffer->setProjectDescription($row["projectDescription"]);
                    $jobOffer->setSalary($row["salary"]);
                    $jobOffer->setRemote($row["remote"]);
                    $jobOffer->setSkills($row["skills"]);
                    $jobOffer->setActive($row["active"]);

                    $jobPosition = new JobPosition();
                    $jobPosition->setDescription($row["description"]);
                    $jobOffer->setJobPosition($jobPosition);

                    $company = new Company();
                    $company->setName($row["name"]);
                    $jobOffer->setCompany($company);

                    array_push($jobOfferList, $jobOffer);
                }

                return $jobOfferList;
            }
            catch(\PDOException $ex)
            {
                echo "<script> if(alert('No se pudo listar las ofertas laborales')); </script>";
            }
        }

        public function GetJobOfferStudent($careerId)
        {
            try
            {
                $jobOfferList = array();

                $query = "SELECT jo.jobOfferId, jo.projectDescription, jo.salary, jo.remote, jo.skills, jo.active, jp.description, c.name FROM ". $this->tableName. " jo INNER JOIN ". $this->tableJobPosition. " jp on jp.jobPositionId = jo.jobPositionId INNER JOIN ". $this->tableCompany. " c on c.copmanyId = jo.copmanyId WHERE (jp.careerId = :careerId)";

                $parameters['careerId'] = $careerId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {             
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($row["jobOfferId"]);
                    $jobOffer->setProjectDescription($row["projectDescription"]);
                    $jobOffer->setSalary($row["salary"]);
                    $jobOffer->setRemote($row["remote"]);
                    $jobOffer->setSkills($row["skills"]);
                    $jobOffer->setActive($row["active"]);

                    $jobPosition = new JobPosition();
                    $jobPosition->setDescription($row["description"]);
                    $jobOffer->setJobPosition($jobPosition);

                    $company = new Company();
                    $company->setName($row["name"]);
                    $jobOffer->setCompany($company);

                    array_push($jobOfferList, $jobOffer);
                }

                return $jobOfferList;
            }
            catch(\PDOException $ex)
            {
                echo "<script> if(alert('No se pudo listar las ofertas laborales')); </script>";
            }
        }

        
        public function remove($jobOfferId)
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
                echo "<script> if(alert('No se pudo eliminar la oferta laboral')); </script>";
            }
        }

        public function modify(JobOffer $jobOffer)
        {
            try
            {
                $query= "UPDATE ".$this->tableName." SET copmanyId = :copmanyId, jobPositionId = :jobPositionId,  datePublished = :datePublished, remote = :remote, salary = :salary, skills = :skills, projectDescription = :projectDescription
                WHERE (jobOfferId = :jobOfferId)";
    
                $parameters['jobOfferId']=$jobOffer->getJobOfferId();
                $parameters["jobPositionId"] = $jobOffer->getJobPosition()->getJobPositionId();
                $parameters["copmanyId"] = $jobOffer->getCompany()->getCompanyId();
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
                echo "<script> if(alert('No se pudo modificar la oferta laboral')); </script>";
            }
        }

        public function GetOffersByJobPosition($jobPosition)
        {
            try
            {
                $jobOfferList = array();

                $query = "SELECT jo.jobOfferId, jo.projectDescription, jo.salary, jo.skills, jo.remote, jo.active, jp.description, c.name FROM ". $this->tableName. " jo INNER JOIN ". $this->tableJobPosition. " jp on jp.jobPositionId = jo.jobPositionId INNER JOIN ". $this->tableCompany. " c on c.copmanyId = jo.copmanyId
                WHERE (jp.description = :jobPosition)";

                $parameters['jobPosition']=$jobPosition;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {             
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($row["jobOfferId"]);
                    $jobOffer->setProjectDescription($row["projectDescription"]);
                    $jobOffer->setSalary($row["salary"]);
                    $jobOffer->setRemote($row["remote"]);
                    $jobOffer->setSkills($row["skills"]);
                    $jobOffer->setActive($row["active"]);

                    $jobPosition = new JobPosition();
                    $jobPosition->setDescription($row["description"]);
                    $jobOffer->setJobPosition($jobPosition);

                    $company = new Company();
                    $company->setName($row["name"]);
                    $jobOffer->setCompany($company);

                    array_push($jobOfferList, $jobOffer);
                }

                return $jobOfferList;
            }
            catch(\PDOException $ex)
            {
                echo "<script> if(alert('No se pudo listar las ofertas laborales')); </script>";
            }
        }

        public function GetOffersByCareer($career)
        {
            try
            {
                $jobOfferList = array();

                $query = "SELECT jo.jobOfferId, jo.projectDescription, jo.skills, jo.salary, jo.remote, jo.active, jp.description, c.name FROM ". $this->tableName. " jo INNER JOIN ". $this->tableJobPosition. " jp on jp.jobPositionId = jo.jobPositionId INNER JOIN ". $this->tableCompany. " c on c.copmanyId = jo.copmanyId INNER JOIN ". $this->tableCareer. " car on car.careerId = jp.careerId
                WHERE (car.description = :career)";

                $parameters['career']=$career;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {            
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($row["jobOfferId"]);
                    $jobOffer->setProjectDescription($row["projectDescription"]);
                    $jobOffer->setSalary($row["salary"]);
                    $jobOffer->setRemote($row["remote"]);
                    $jobOffer->setSkills($row["skills"]);
                    $jobOffer->setActive($row["active"]);

                    $jobPosition = new JobPosition();
                    $jobPosition->setDescription($row["description"]);
                    $jobOffer->setJobPosition($jobPosition);

                    $company = new Company();
                    $company->setName($row["name"]);
                    $jobOffer->setCompany($company);

                    array_push($jobOfferList, $jobOffer);
                }

                return $jobOfferList;
            }
            catch(\PDOException $ex)
            {
                echo "<script> if(alert('No se pudo listar las ofertas laborales')); </script>";
            }
        }

        public function GetOffersByCompany($company)
        {
            try
            {
                $jobOfferList = array();

                $query = "SELECT jo.jobOfferId, jo.projectDescription, jo.skills, jo.salary, jo.remote, jo.active, jp.description, c.name FROM ". $this->tableName. " jo INNER JOIN ". $this->tableJobPosition. " jp on jp.jobPositionId = jo.jobPositionId INNER JOIN ". $this->tableCompany. " c on c.copmanyId = jo.copmanyId INNER JOIN ". $this->tableCareer. " car on car.careerId = jp.careerId
                WHERE (c.email = :company)";

                $parameters['company']=$company;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {            
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($row["jobOfferId"]);
                    $jobOffer->setProjectDescription($row["projectDescription"]);
                    $jobOffer->setSalary($row["salary"]);
                    $jobOffer->setRemote($row["remote"]);
                    $jobOffer->setSkills($row["skills"]);
                    $jobOffer->setActive($row["active"]);

                    $jobPosition = new JobPosition();
                    $jobPosition->setDescription($row["description"]);
                    $jobOffer->setJobPosition($jobPosition);

                    $company = new Company();
                    $company->setName($row["name"]);
                    $jobOffer->setCompany($company);

                    array_push($jobOfferList, $jobOffer);
                }

                return $jobOfferList;
            }
            catch(\PDOException $ex)
            {
                echo "<script> if(alert('No se pudo listar las ofertas laborales')); </script>";
            }
        }

        public function GetOfferById($id)
        {
            try
            {
                $jobOfferList = array();

                $query = "SELECT jo.jobOfferId, jo.projectDescription, jo.skills, jo.salary, jo.remote, jo.active, jp.description, c.name FROM ". $this->tableName. " jo INNER JOIN ". $this->tableJobPosition. " jp on jp.jobPositionId = jo.jobPositionId INNER JOIN ". $this->tableCompany. " c on c.copmanyId = jo.copmanyId INNER JOIN ". $this->tableCareer. " car on car.careerId = jp.careerId
                WHERE (jo.jobOfferId = :id)";

                $parameters['id']=$id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {            
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($row["jobOfferId"]);
                    $jobOffer->setProjectDescription($row["projectDescription"]);
                    $jobOffer->setSalary($row["salary"]);
                    $jobOffer->setRemote($row["remote"]);
                    $jobOffer->setSkills($row["skills"]);
                    $jobOffer->setActive($row["active"]);

                    $jobPosition = new JobPosition();
                    $jobPosition->setDescription($row["description"]);
                    $jobOffer->setJobPosition($jobPosition);

                    $company = new Company();
                    $company->setName($row["name"]);
                    $jobOffer->setCompany($company);

                    array_push($jobOfferList, $jobOffer);
                }

                return $jobOfferList[0];
            }
            catch(\PDOException $ex)
            {
                echo "<script> if(alert('No se pudo listar las ofertas laborales')); </script>";
            }
        }

        public function Disable ($id)
        {
            try
            {
                $query= "UPDATE ".$this->tableName." SET active = 0 WHERE (jobOfferId = :id)";
    
                $parameters['id']= $id;
    
                $this->connection = Connection::GetInstance();
    
                $count= $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\Exception $ex)
            {
                throw $ex;  
            }
        }
        
    }
?>