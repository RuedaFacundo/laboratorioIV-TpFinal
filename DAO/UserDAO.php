<?php
    namespace DAO;

    use Models\User as User;

    class UserDAO implements IUserDAO
    {
        private $userList = array();

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->userList;
        }

        public function Add(User $user)
        {
            $this->RetrieveData();
            
            array_push($this->userList, $user);

            $this->SaveData();
        }

        private function RetrieveData()
        {
            $this->userList = array();

            if(file_exists('Data/User.json'))
            {
                $jsonContent = file_get_contents('Data/User.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $user = new User();
                    $user->setStudentId($valuesArray['studentId']);
                    $user->setCareerId($valuesArray['careerId']);
                    $user->setFirstName($valuesArray['firstName']);
                    $user->setLastName($valuesArray['lastName']);
                    $user->setDni($valuesArray['dni']);
                    $user->setFileNumber($valuesArray['fileNumber']);
                    $user->setGender($valuesArray['gender']);
                    $user->setBirthDate($valuesArray['birthDate']);
                    $user->setEmail($valuesArray['email']);
                    $user->setPhoneNumber($valuesArray['phoneNumber']);
                    $user->setActive($valuesArray['active']);
                    $user->setProfile($valuesArray['profile']);

                    array_push($this->userList, $user);
                }
            }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {
                $valuesArray["studentId"] = $user->getStudentId();
                $valuesArray["careerId"] = $user->getCareerId();
                $valuesArray["firstName"] = $user->getFirstName();
                $valuesArray["lastName"] = $user->getLastName();
                $valuesArray["dni"] = $user->getDni();
                $valuesArray["fileNumber"] = $user->getFileNumber();
                $valuesArray["gender"] = $user->getGender();
                $valuesArray["birthDate"] = $user->getBirthDate();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["phoneNumber"] = $user->getPhoneNumber();
                $valuesArray["active"] = $user->getActive();
                $valuesArray["profile"] = $user->getProfile();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/User.json', $jsonContent);
        }

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
    }
?>