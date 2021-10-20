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

        public function Login($user)
        {
            $arrayUsers =  $this->userDAO->GetAll();
            $loggedUser = NULL;

            foreach ($arrayUsers as $key => $value) {
                if($user == $value->getUserName()){
                        $loggedUser = $value;
                }
            }

            if($loggedUser != NULL){
                //session_start();
                $_SESSION['loggedUser'] = $loggedUser;
                require_once(VIEWS_PATH."add-company.php");
            }else{
                require_once(VIEWS_PATH."home.php");
            }
        }

        public function Logout () {
            //session_start();
			session_destroy();
			require_once(VIEWS_PATH."home.php");
        }

        public function Add($username)
        {
            $user = new User();
            $user->setUserName($username);

            $this->userDAO->Add($user);

            $this->ShowAddView();
        }
    }
?>