<?php
    namespace DAO;

    use Models\Company as Company;
    use DAO\Connection as Connection;

    interface ICompanyDAO
    {
        function Add(Company $company);
        function GetAll();
        function remove($cuit);
        function modify(Company $company);
        function GetByName($name);
        public function GetByEmail($email);
    }
?>