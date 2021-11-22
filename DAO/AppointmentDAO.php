<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\IAppointmentDAO as IAppointmentDAO;
    use Models\Appointment as Appointment;
    use Models\User as User;
    use Models\JobPosition as JobPosition;
    use Models\Company as Company;
    use Models\JobOffer as JobOffer;

    class AppointmentDAO implements IAppointmentDAO
    {
        private $connection;
        private $tableName = "appointments";
        private $tableUsers = "users";
        private $tableJobOffer = "jobOffers";
        private $tableCompany = "companies";
        private $tablePosition = "jobPositions";

        public function Add(Appointment $appointment)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobOfferId, studentId, message, cv, active) VALUES (:jobOfferId, :studentId, :message, :cv, :active);";
                
                $parameters['jobOfferId'] = $appointment->getJobOffer()->getJobOfferId();
                $parameters['studentId'] = $appointment->getStudent()->getStudentId();
                $parameters['message'] = $appointment->getMessage();
                $parameters['cv'] = $appointment->getCv();
                $parameters['active'] = $appointment->getActive();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;                
            }
        }

        public function GetAll()
        {
            try
            {
                $appointmentList = array();

                $query = "SELECT ap.appointmentId, ap.message, ap.cv, ap.active, u.email, jp.description, c.name FROM ".$this->tableName. " ap INNER JOIN ". $this->tableUsers. " u on u.userId = ap.studentId INNER JOIN ". $this->tableJobOffer. " jo on jo.jobOfferId = ap.jobOfferId INNER JOIN ". $this->tableCompany. " c on c.copmanyId = jo.copmanyId INNER JOIN ". $this->tablePosition. " jp on jp.jobPositionId = jo.jobPositionId";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {
                    $appointment = new Appointment(); 
                    $appointment->setAppointmentId([$row["appointmentId"]]);
                    $appointment->setMessage($row["message"]);
                    $appointment->setCv($row["cv"]);
                    $appointment->setActive($row["active"]);

                    $user = new User();
                    $user->setEmail($row["email"]);
                    $appointment->setStudent($user);

                    $jobOffer = new JobOffer();

                    $company = new Company();
                    $company->setName($row["name"]);
                    $jobOffer->setCompany($company);

                    $jobPosition = new JobPosition();
                    $jobPosition->setDescription($row["description"]);
                    $jobOffer->setJobPosition($jobPosition);

                    $appointment->setJobOffer($jobOffer);

                    array_push($appointmentList, $appointment);
                }

                return $appointmentList;
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function GetByIdStudent($idStudent)
        {
            try
            {
                $appointmentList = array();

                $query = "SELECT ap.appointmentId, ap.message, ap.cv, ap.active, u.email, jp.description, c.name FROM ".$this->tableName. " ap INNER JOIN ". $this->tableUsers. " u on u.userId = ap.studentId INNER JOIN ". $this->tableJobOffer. " jo on jo.jobOfferId = ap.jobOfferId INNER JOIN ". $this->tableCompany. " c on c.copmanyId = jo.copmanyId INNER JOIN ". $this->tablePosition. " jp on jp.jobPositionId = jo.jobPositionId
                WHERE (u.userId = :idStudent)";

                $parameters["idStudent"] =  $idStudent;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {
                    $appointment = new Appointment(); 
                    $appointment->setAppointmentId([$row["appointmentId"]]);
                    $appointment->setMessage($row["message"]);
                    $appointment->setCv($row["cv"]);
                    $appointment->setActive($row["active"]);

                    $user = new User();
                    $user->setEmail($row["email"]);
                    $appointment->setStudent($user);

                    $jobOffer = new JobOffer();

                    $company = new Company();
                    $company->setName($row["name"]);
                    $jobOffer->setCompany($company);

                    $jobPosition = new JobPosition();
                    $jobPosition->setDescription($row["description"]);
                    $jobOffer->setJobPosition($jobPosition);

                    $appointment->setJobOffer($jobOffer);

                    array_push($appointmentList, $appointment);
                }

                return $appointmentList;
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function Disable ($id)
        {
            try
            {
                $query= "UPDATE ".$this->tableName." SET active = 0 WHERE (appointmentId = :id)";
    
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