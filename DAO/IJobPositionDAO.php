<?php
    namespace DAO;

    interface IJobPositionDAO
    {
        function GetAllApi ();
        function getById ($id);
    }
?>