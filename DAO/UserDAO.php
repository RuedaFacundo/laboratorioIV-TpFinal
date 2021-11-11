<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class UserDAO implements IUserDAO
    {
        private $connection;
        private $tableName = "users";

        private function RetrieveDataApi ()
        {
            try {
                $ch = curl_init();
            
                if ($ch === false) {
                    throw new Exception('failed to initialize');
                }
            
                curl_setopt($ch, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/Student');
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
            $userList = array();

            foreach($jsonApi as $value){
                $user = new User ();
                $user->setStudentId($value['studentId']);
                $user->setCareerId($value['careerId']);
                $user->setFirstName($value['firstName']);
                $user->setLastName($value['lastName']);
                $user->setDni($value['dni']);
                $user->setFileNumber($value['fileNumber']);
                $user->setGender($value['gender']);
                $user->setBirthDate($value['birthDate']);
                $user->setEmail($value['email']);
                $user->setPhoneNumber($value['phoneNumber']);
                $user->setActive($value['active']);
                $user->setProfile('Student');

                array_push($userList,$user);
            }
            return $userList;
        }
        
        public function Add(User $user)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (email, password, profile) VALUES (:email, :password, :profile);";
                
                $parameters["email"] = $user->getEmail();
                $parameters["password"] = $user->getPassword();
                $parameters["profile"] = $user->getProfile();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\PDOException $ex)
            {
                echo "<script> if(alert('No se pudo agregar el usuario')); </script>";
            }
        }
        
        public function GetAllStudents() 
        {
            try
            {
                $userList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE (profile = 'Student')";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $user = new User();
                    $user->setEmail($row["email"]);
                    $user->setPassword($row["password"]);
                    $user->setProfile($row["profile"]);

                    array_push($userList, $user);
                }

                return $userList;
            }
            catch(\PDOException $ex)
            {
                echo "<script> if(alert('No se pudo listar los estudiantes registrados')); </script>";
            }
        }

        public function GetUserByEmail($email) 
        {
            try
            {
                $userList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE (email = :email)";

                $parameters['email'] = $email;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {                
                    $user = new User();
                    $user->setStudentId($row["userId"]);
                    $user->setEmail($row["email"]);
                    $user->setPassword($row["password"]);
                    $user->setProfile($row["profile"]);

                    array_push($userList, $user);
                }

                return $userList[0];
            }
            catch(\PDOException $ex)
            {
                echo "<script> if(alert('No se encontro el usuario registrado')); </script>";
            }
        }

        public function GetApiByEmail ($email){
            $studentList = $this->GetAllApi();
            $student = null;

            foreach($studentList as $value){
                if ($value->getEmail() == $email && $value->getActive() == true){
                    $student = $value;
                }
            }
            return $student;
        }

        public function GetStudentsByEmail($email) 
        {
            try
            {
                $userList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE (profile = 'Student' and email = :email)";

                $parameters['email'] = $email;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {                
                    $user = new User();
                    $user->setStudentId($row["userId"]);
                    $user->setEmail($row["email"]);
                    $user->setPassword($row["password"]);
                    $user->setProfile($row["profile"]);

                    array_push($userList, $user);
                }

                return $userList;
            }
            catch(\PDOException $ex)
            {
                echo "<script> if(alert('No se encontro el estudiante por email')); </script>";
            }
        }
    }
?>