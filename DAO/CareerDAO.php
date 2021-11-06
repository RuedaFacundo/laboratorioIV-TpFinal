<?php
    namespace DAO;

    use Models\Career as Career;
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\ICareerDAO as ICareerDAO;

    class CareerDAO implements ICareerDAO
    {
        private $connection;
        private $tableName = "careers";

        private function Add(Career $career)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (careerId, description, active) VALUES (:careerId, :description, :active);";
                
                $parameters["careerId"] = $career->getCareerId();
                $parameters["description"] = $career->getDescription();
                $parameters["active"] = $career->getActive();

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
            
                curl_setopt($ch, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/Career');
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

        public function GetAllApi () // paso todas las carreras a la base de datos
        {
            $jsonApi = $this->RetrieveDataApi();

            foreach($jsonApi as $value){
                $career = new Career ();
                $career->setCareerId($value['careerId']);
                $career->setDescription($value['description']);
                $career->setActive($value['active']);
                
                $this->Add($career);
            }
            return $jsonApi;
        }

        public function GetAll()
        {
            try
            {
                $careerList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $career = new Career();
                    $career->setCareerId($row["careerId"]);
                    $career->setDescription($row["description"]);
                    $career->setActive($row["active"]);

                    array_push($careerList, $career);
                }

                return $careerList;
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function getById($careerId)
        {
            try
            {
                $careerList = array();
                $query = "SELECT careers.description FROM ".$this->tableName. " WHERE (careerId = :careerId)";

                $parameters['careerId'] = $careerId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {                
                    $career['description'] = $row["description"];

                    array_push($careerList, $career);
                }

                return $careerList;
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }
    }
?>