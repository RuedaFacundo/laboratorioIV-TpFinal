<?php
    namespace Controllers;

    use DAO\AppointmentDAO as AppointmentDAO;
    use Models\Appointment as Appointment;
    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class AppointmentController
    {
        private $appointmentDAO;
        private $userDAO;

        public function __construct()
        {
            $this->appointmentDAO = new AppointmentDAO();
            $this->userDAO = new UserDAO;
        }

        public function showAddView($jobOfferId, $company, $jobPosition )
        {
            $appointmentList = $this->appointmentDAO->GetByIdStudent($_SESSION['loggedUser'][0]->getStudentId());
            if($appointmentList){
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
            $appointmentList = $this->appointmentDAO->GetByIdStudent($_SESSION['loggedUser'][0]->getStudentId());
            if ($appointmentList){
                require_once(VIEWS_PATH."appointment.php");
            } else {
                require_once(VIEWS_PATH."student-profile.php");
            }
        }

        public function Add($id, $message, $cv)
        {
            $file = $this->Upload($cv);
            
            $student = $this->userDAO->GetStudentsByEmail($_SESSION['loggedUser'][0]->getEmail());

            $appointment = new Appointment();
            $appointment->setJobOfferId($id);
            $appointment->setStudentId($student[0]->getStudentId());
            $appointment->setMessage($message);
            $appointment->setCv($file);
    
            $this->appointmentDAO->Add($appointment);

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
    }
?>