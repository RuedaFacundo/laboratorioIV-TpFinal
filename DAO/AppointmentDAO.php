<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\IAppointmentDAO as IAppointmentDAO;
    use Models\Appointment as Appointment;

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
                $query = "INSERT INTO ".$this->tableName." (jobOfferId, studentId, message, cv) VALUES (:jobOfferId, :studentId, :message, :cv);";
                
                $parameters['jobOfferId'] = $appointment->getJobOfferId();
                $parameters['studentId'] = $appointment->getStudentId();
                $parameters['message'] = $appointment->getMessage();
                $parameters['cv'] = $appointment->getCv();

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

                $query = "SELECT ap.message, ap.cv, u.email, jp.description, c.name FROM ".$this->tableName. " ap INNER JOIN ". $this->tableUsers. " u on u.userId = ap.studentId INNER JOIN ". $this->tableJobOffer. " jo on jo.jobOfferId = ap.jobOfferId INNER JOIN ". $this->tableCompany. " c on c.copmanyId = jo.copmanyId INNER JOIN ". $this->tablePosition. " jp on jp.jobPositionId = jo.jobPositionId";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $appointment['name'] = $row["name"];
                    $appointment['description'] = $row["description"];
                    $appointment['email'] = $row["email"];
                    $appointment['message'] = $row["message"];
                    $appointment['cv'] = $row["cv"];

                    array_push($appointmentList, $appointment);
                }

                return $appointmentList;
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }
    }
?>