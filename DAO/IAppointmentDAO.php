<?php
    namespace DAO;

    interface IAppointmentDAO
    {
        function Add(Appointment $appointment);
        function GetAll ();
    }
?>