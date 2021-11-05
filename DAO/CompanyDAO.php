<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;    
    use DAO\Connection as Connection;

    class CompanyDAO implements ICompanyDAO
    {
        private $connection;
        private $tableName = "companies";

        public function Add(Company $company)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (name, cuit, adress, founded) VALUES (:name, :cuit, :adress, :founded);";
                
                $parameters["name"] = $company->getName();
                $parameters["cuit"] = $company->getCuit();
                $parameters["adress"] = $company->getAdress();
                $parameters["founded"] = $company->getFounded();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\Exception $ex)
            {
                echo "<script> if(alert('No se pudo agregar la empresa')); </script>";
            }
        }

        public function GetAll()
        {
            try
            {
                $companyList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $company = new Company();
                    $company->setName($row["name"]);
                    $company->setCuit($row["cuit"]);
                    $company->setAdress($row["adress"]);
                    $company->setFounded($row["founded"]);

                    array_push($companyList, $company);
                }

                return $companyList;
            }
            catch(\Exception $ex)
            {
                echo "<script> if(alert('No se pudo listar las empresas')); </script>";
            }
        }

        public function GetByName($name)
        {
            try
            {
                $companyList = array();
                $toLowerCase = strtolower($name);
                $query = "SELECT * FROM ".$this->tableName. " WHERE (name = :name)";

                $parameters['name'] = $toLowerCase;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {                
                    $company = new Company();
                    $company->setCompanyId($row["copmanyId"]);
                    $company->setName($row["name"]);
                    $company->setCuit($row["cuit"]);
                    $company->setAdress($row["adress"]);
                    $company->setFounded($row["founded"]);

                    array_push($companyList, $company);
                }

                return $companyList;
            }
            catch(\Exception $ex)
            {
                echo "<script> if(alert('No se encontro la empresa')); </script>";
            }
        }

        function remove($cuit)
        {
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE (cuit = :cuit)";
    
                $parameters["cuit"] =  $cuit;
    
                $this->connection = Connection::GetInstance();
    
                return $count=$this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\Exception $e)
            {
                echo "<script> if(alert('No se pudo eliminar la empresa')); </script>";
            }
        }

        function modify(Company $company)
        {
            try
            {
                $query= "UPDATE ".$this->tableName." SET name = :name, cuit = :cuit, adress = :adress, founded = :founded
                WHERE (cuit = :cuit)";
    
                $parameters['name']=$company->getName();
                $parameters['cuit']=$company->getCuit();
                $parameters['adress']=$company->getAdress();
                $parameters['founded']=$company->getFounded();
    
                $this->connection = Connection::GetInstance();
    
                return $count= $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\Exception $ex)
            {
                echo "<script> if(alert('No se pudo modificar la empresa')); </script>";
            }
        }
    }
?>