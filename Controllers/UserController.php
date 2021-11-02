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
            $careerList = $this->careerDAO->GetAllApi();
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


        public function Logout () {
			session_destroy();
			require_once(VIEWS_PATH."home.php");
        }

        public function ShowRegisterView(){
            require_once(VIEWS_PATH."registration.php");
        }



        // QUE TOME EL CAMPO VALIDO PARA INICIAR SESION O REGISTRARSE

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
            $arrayStudents = $this->userDAO->GetAllApi();
            $student = null; // esto no lo tengo que instanciar como obejto? en el foreach no tengo q hacer sets?

            foreach ($arrayStudents as $key => $value) {
                if($email == $value->getEmail() && $value->getActive() == true){
                    $student = $value;
                }
            }

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
            $arrayStudents =  $this->userDAO->GetAllStudents();
            $arrayAdmin =  $this->userDAO->GetAllAdmin();
            $studentApi = $this->userDAO->GetApiByEmail($email);
            $loggedUser = NULL;

            $loggedUser = $this->Session($arrayStudents, $email, $password);
            if ($loggedUser == NULL){
                $loggedUser = $this->Session($arrayAdmin, $email, $password);
            }
            
            if($loggedUser != NULL && $studentApi->getActive() == true){ // con el estudiante traido por la api, verificar si esta activo
                if($loggedUser->getProfile() == 'Student') {
                    $_SESSION['loggedUser'] = $loggedUser;
                    $this->ShowProfileView($studentApi);
                } else {
                    $_SESSION['loggedUser'] = $loggedUser;
                    require_once(VIEWS_PATH."admin-profile.php");
                }
            } else {
                require_once(VIEWS_PATH."home.php");
            }
        }

        private function Session ($array, $email, $password)
        {
            $student = NULL;

            foreach ($array as $key => $value) {
                if($email == $value->getEmail() && $password == $value->getPassword()){
                    $student = $value;
                }
            }
            return $student;
        }
        
    }
?>