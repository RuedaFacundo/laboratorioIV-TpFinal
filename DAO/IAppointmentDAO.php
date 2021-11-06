<?php
    namespace DAO;

    use Models\Appointment as Appointment;

    interface IAppointmentDAO
    {
        function Add(Appointment $appointment);
        function GetAll ();
    }
?>