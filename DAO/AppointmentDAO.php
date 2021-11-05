<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use Models\Appointment as Appointment;

    class AppointmentDAO implements IAppointmentDAO
    {
        private $connection;
        private $tableName = "appointments";

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

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $appointment = new Appointment();
                    $appointment->setJobOfferId($row["jobOfferId"]);
                    $appointment->setStudentId($row["studentId"]);
                    $appointment->setMessage($row["message"]);
                    $appointment->setCv($row["cv"]);

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