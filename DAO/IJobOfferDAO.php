<?php
    namespace DAO;

    use Models\JobOffer as JobOffer;

    interface IJobOfferDAO
    {
        function Add(JobOffer $jobOffer);
        function GetAll();
        function GetJobOfferStudent($careerId);
        function remove($jobOfferId);
        function modify(JobOffer $jobOffer);
    }
?>