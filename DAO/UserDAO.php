<?php
    namespace DAO;

    use Models\User as User;

    class UserDAO
    {
        private $userList = array();

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->userList;
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
    }
?>