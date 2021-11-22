<?php
    namespace Controllers;

    use DAO\AppointmentDAO as AppointmentDAO;
    use Models\Appointment as Appointment;
    use DAO\UserDAO as UserDAO;
    use DAO\CareerDAO as CareerDAO;
    use DAO\JobOfferDAO as JobOfferDAO;
    use Models\Career as Career;
    use Models\User as User;
    use Models\JobOffer as JobOffer;

    class AppointmentController
    {
        private $appointmentDAO;
        private $userDAO;
        private $careerDAO;
        private $jobOfferDAO;

        public function __construct()
        {
            $this->appointmentDAO = new AppointmentDAO();
            $this->userDAO = new UserDAO;
            $this->careerDAO = new CareerDAO;
            $this->jobOfferDAO = new JobOfferDAO;
        }

        public function showAddView($jobOfferId, $company, $jobPosition )
        {
            $appointmentList = $this->appointmentDAO->GetByIdStudent($_SESSION['loggedUser']->getStudentId());
            if($this->validateAppointment($appointmentList) == true){
                echo "<script> if(alert('Se encuentra postulado en una oferta activa')); </script>";
                require_once(VIEWS_PATH."appointment.php");
            } else {
                require_once(VIEWS_PATH."add-appointment.php");
            }
        }

        public function showListView()
        {
            $appointmentList = $this->appointmentDAO->GetAll();
            require_once(VIEWS_PATH."appointment-list.php");
        }

        public function ShowFile($name)
        {
            require_once(VIEWS_PATH."file-show.php");
        }

        public function ShowDownload($name)
        {
            require_once(VIEWS_PATH."file-download.php");
        }

        public function ShowAppointment()
        {
            $appointmentList = $this->appointmentDAO->GetByIdStudent($_SESSION['loggedUser']->getStudentId());
            if ($appointmentList){
                require_once(VIEWS_PATH."appointment.php");
            } else {
                echo "<script> if(alert('No tiene postulaciones realizadas')); </script>";
                $studentApi = $this->userDAO->GetApiByEmail($_SESSION['loggedUser']->getEmail());
                $career =  $this->careerDAO->getById($studentApi->getCareerId());
                require_once(VIEWS_PATH."student-profile.php");
            }
        }

        public function SendEmail()
        {
            require_once(VIEWS_PATH."email.php");
        }

        public function Add($id, $message, $cv)
        {
            $file = $this->Upload($cv);
            
            $student = new User();
            $student = $this->userDAO->GetUserByEmail($_SESSION['loggedUser']->getEmail());
            $jobOffer = new JobOffer ();
            $jobOffer = $this->jobOfferDAO->GetOfferById($id);
            $appointment = new Appointment();
            $appointment->setJobOffer($jobOffer);
            $appointment->setStudent($student);
            $appointment->setMessage($message);
            $appointment->setCv($file);
            $appointment->setActive(true);

            try {
                $this->appointmentDAO->Add($appointment);
            } catch (Exception $e){
                echo "<script> if(alert('No se pudo realizar la postulacion')); </script>";
            }

            $this->ShowAppointment();
        }

        private function Upload($file)
        {
            try
            {
                $fileName = $file["name"];
                $tempFileName = $file["tmp_name"];
                $type = $file["type"];
                
                $filePath = UPLOADS_PATH.basename($fileName);            

                $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                $extension_correcta = ($fileType == 'doc' or $fileType == 'docx' or $fileType == 'pdf');

                if($extension_correcta !== false)
                {
                    if (move_uploaded_file($tempFileName, $filePath))
                    {
                        $message = "Archivo subido correctamente";
                        return $fileName;
                    }
                    else
                        $message = "Ocurrió un error al intentar subir el archivo";
                }
                else   
                    $message = "El archivo no corresponde a una extension valida";
            }
            catch(Exception $ex)
            {
                echo "<script> if(alert('Ocurrió un error al intentar subir el archivo')); </script>";
            }
        }    

        private function validateAppointment ($appointmentList){
            
            foreach($appointmentList as $value){
                if ($value->getActive() == 1){
                    return true;
                }
            }
        }

        public function Cancel ($id)
        {
            try {
                $this->appointmentDAO->Disable($id);
                $this->SendEmail();
            } catch (Exception $e) {
                echo "<script> if(alert('No se pudo desactivar la postulacion')); </script>"; 
            }

            if ($_SESSION['loggedUser']->getProfile() == 'Student'){
                $this->ShowAppointment();
            } else {
                $this->showListView();
            }
        }
    }
?>