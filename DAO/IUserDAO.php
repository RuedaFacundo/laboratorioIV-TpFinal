<?php
    namespace DAO;

    use Models\User as User;

    interface IUserDAO
    {
        function Add(User $user);
        function GetAllStudents();
        function GetAllApi ();
        function GetStudentsByEmail($email);
        function GetApiByEmail ($email);
        function GetAllAdmin();
    }
?>