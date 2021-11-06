<?php
    namespace DAO;

    use Models\JobPosition as JobPosition;
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use Models\Career as Career;
    use DAO\IJobPositionDAO as IJobPositionDAO;

    class JobPositionDAO implements IJobPositionDAO
    {
        private $connection;
        private $tableName = "jobpositions";

        private function Add(JobPosition $jobPosition)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobPositionId, careerId, description) VALUES (:jobPositionId, :careerId, :description);";
                
                $parameters["jobPositionId"] = $jobPosition->getJobPositionId();
                $parameters["careerId"] = $jobPosition->getCareerId();
                $parameters["description"] = $jobPosition->getDescription();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        private function RetrieveDataApi ()
        {
            try {
                $ch = curl_init();
            
                if ($ch === false) {
                    throw new Exception('failed to initialize');
                }
            
                curl_setopt($ch, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/JobPosition');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            
                $content = curl_exec($ch);
                $toJson = json_decode($content, true);
            
                if ($content === false) {
                    throw new Exception(curl_error($ch), curl_errno($ch));
                }
                $httpReturnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            } catch(Exception $e) {         
                trigger_error(sprintf(
                    'Curl failed with error #%d: %s',
                    $e->getCode(), $e->getMessage()),
                    E_USER_ERROR);
            }
            return $toJson;
        }

        public function GetAllApi ()
        {
            $jsonApi = $this->RetrieveDataApi();

            foreach($jsonApi as $value){
                $jobPosition = new JobPosition ();
                $jobPosition->setJobPositionId($value['jobPositionId']);
                $jobPosition->setCareerId($value['careerId']);
                $jobPosition->setDescription($value['description']);

                $this->Add($jobPosition);
            }

            return $jsonApi;
        }

        public function GetAll()
        {
            try
            {
                $jobPositionList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobPosition = new JobPosition();
                    $jobPosition->setJobPositionId($row["jobPositionId"]);
                    $jobPosition->setCareerId($row["careerId"]);
                    $jobPosition->setDescription($row["description"]);

                    array_push($jobPositionList, $jobPosition);
                }

                return $jobPositionList;
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function getById ($id)
        {
            $jobPositionList = $this->GetAllApi();

            foreach($jobPositionList as $jobPosition){
                if($jobPosition->getJobPositionId() == $id){
                    return $jobPosition;
                }
            }
        }
    }
?>