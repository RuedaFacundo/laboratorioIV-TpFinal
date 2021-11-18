<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\CareerDAO as CareerDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;
    use Models\User as User;
    use Models\Career as Career;

    class UserController
    {
        private $userDAO;
        private $careerDAO;
        private $companyDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
            $this->careerDAO = new careerDAO();
            $this->companyDAO = new CompanyDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."add-user.php");
        }

        public function ShowProfileView()
        {
            $studentApi = $this->userDAO->GetApiByEmail($_SESSION['loggedUser']->getEmail());
            $career =  $this->careerDAO->getById($studentApi->getCareerId());
            require_once(VIEWS_PATH."student-profile.php");
        }

        public function ShowAdminProfileView()
        {
            require_once(VIEWS_PATH."admin-profile.php");
        }

        public function ShowAddCompany()
        {
            require_once(VIEWS_PATH."add-companyUser.php");
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

        public function AddCompany ($name, $cuit, $adress, $founded, $email, $password)
        {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setProfile('Company');

            $company = new Company();
            $company->setName($name);
            $company->setCuit($cuit);
            $company->setAdress($adress);
            $company->setFounded($founded);
            $company->setEmail($email);

            $this->companyDAO->Add($company);
            $this->userDAO->Add($user);
            require_once(VIEWS_PATH."home.php");
        }

        public function Login($email, $password)
        {
            $loggedUser = $this->userDAO->GetUserByEmail($email);
            $studentApi = $this->userDAO->GetApiByEmail($email);

            if($loggedUser != NULL){
                if($loggedUser->getProfile() == 'Student') {
                    if ($studentApi->getActive() == true){
                        $_SESSION['loggedUser'] = $loggedUser;
                        $this->ShowProfileView();
                    } else {
                        require_once(VIEWS_PATH."home.php");
                    }
                } else if ($loggedUser->getProfile() == 'Admin') {
                    $_SESSION['loggedUser'] = $loggedUser;
                    $this->ShowAdminProfileView();
                } else if ($loggedUser->getProfile() == 'Company'){
                    $_SESSION['loggedUser'] = $loggedUser;
                    require_once(VIEWS_PATH."company-profile.php");
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