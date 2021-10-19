<?php
    namespace DAO;

    use Models\Company as Company;

    interface ICompanyDAO
    {
        function Add(Company $company);
        function GetAll();
        function remove(Company $companyToDelete);
        function checkCompany($cuit);
        function modify(Company $companyToModify);
    }
?>