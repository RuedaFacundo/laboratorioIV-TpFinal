<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\CareerDAO as CareerDAO;
    use Models\User as User;
    use Models\Career as Career;

    class UserController
    {
        private $userDAO;
        private $careerDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
            $this->careerDAO = new careerDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."add-user.php");
        }

        public function ShowProfileView($studentApi)
        {
            $career =  $this->careerDAO->getById($studentApi->getCareerId());
            require_once(VIEWS_PATH."student-profile.php");
        }

        public function ShowAdminProfileView()
        {
            require_once(VIEWS_PATH."admin-profile.php");
        }

        public function ShowListStudent()
        {
            $studentApi = new User();
            $career = new Career();
            $arrayStudents =  $this->userDAO->GetAllStudents();
            require_once(VIEWS_PATH."student-list.php");
        }

        public function ShowRegisterView(){
            require_once(VIEWS_PATH."registration.php");
        }

        public function AddAdmin ($email, $password)
        {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setProfile('Admin');

            $this->userDAO->Add($user);
            $this->ShowAddView();
        }

        public function AddStudent ($email, $password) // primero verifico que este en la API y luego lo registro en la base 
        {
            $student = $this->userDAO->GetApiByEmail($email);

            if($student){
                $user = new User();
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setProfile('Student');
                $this->userDAO->Add($user); 
                require_once(VIEWS_PATH."home.php");
            } else {
                echo "<script> if(alert('No se pudo registar')); </script>";
                $this->ShowRegisterView();
            }
        }

        public function Login($email, $password)
        {
            $loggedUser = $this->userDAO->GetUserByEmail($email);
            $studentApi = $this->userDAO->GetApiByEmail($email);

            if($loggedUser != NULL){
                if($loggedUser[0]->getProfile() == 'Student') {
                    if ($studentApi->getActive() == true){
                        $_SESSION['loggedUser'] = $loggedUser;
                        $this->ShowProfileView($studentApi);
                    } else {
                        require_once(VIEWS_PATH."home.php");
                    }
                } else {
                    $_SESSION['loggedUser'] = $loggedUser;
                    require_once(VIEWS_PATH."admin-profile.php");
                }
            } else {
                require_once(VIEWS_PATH."home.php");
            }
        }

        public function Logout () {
			session_destroy();
			require_once(VIEWS_PATH."home.php");
        }
        
    }
?>