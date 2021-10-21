<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class UserController
    {
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."add-user.php");
        }

        public function ShowProfileView()
        {
            require_once(VIEWS_PATH."student-profile.php");
        }

        public function Login($user)
        {
            $arrayUsers =  $this->userDAO->GetAll();
            $arrayStudents = $this->userDAO->GetAllApi();
            $loggedUser = NULL;

            foreach ($arrayUsers as $key => $value) {
                if($user == $value->getEmail()){
                    $loggedUser = $value;
                }
            }

            foreach ($arrayStudents as $key => $value) {
                if($user == $value->getEmail()){
                    $loggedUser = $value;
                }
            }

            if($loggedUser != NULL && $loggedUser->getActive() == true){
                if($loggedUser->getProfile() == 'Student') {
                    $_SESSION['loggedUser'] = $loggedUser;
                    $this->ShowProfileView();
                } else {
                    $_SESSION['loggedUser'] = $loggedUser;
                    require_once(VIEWS_PATH."add-company.php");
                }
            } else {
                require_once(VIEWS_PATH."home.php");
            }
        }

        public function Logout () {
			session_destroy();
			require_once(VIEWS_PATH."home.php");
        }

        public function Add($name, $lastName, $email, $telephone, $gender, $birthDate, $cellphone, $dni, $profile)
        {
            $user = new User();
            $user->setFirstName($name);
            $user->setLastName($lastName);
            $user->setDni($dni);
            $user->setEmail($email);
            $user->setFileNumber($telephone);
            $user->setGender($gender);
            $user->setBirthDate($birthDate);
            $user->setPhoneNumber($cellphone);
            $user->setActive('active');
            $user->setProfile($profile);

            $this->userDAO->Add($user);
            $this->ShowAddView();
        }
    }
?>