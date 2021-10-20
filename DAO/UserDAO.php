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
                    $user->setUserName($valuesArray["username"]);

                    array_push($this->userList, $user);
                }
            }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {
                $valuesArray["username"] = $user->getUserName();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/User.json', $jsonContent);
        }
    }
?>