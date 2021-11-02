<?php
    namespace DAO;

    interface ICareerDAO
    {
        function GetAllApi ();
        function getById ($careerId);
    }
?>