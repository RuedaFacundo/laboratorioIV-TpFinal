<?php
    namespace DAO;

    use Models\JobPosition as JobPosition;

    class JobPositionDAO
    {
        private function RetrieveDataApi ()
        {
            try {
                $ch = curl_init();
            
                if ($ch === false) {
                    throw new Exception('failed to initialize');
                }
            
                curl_setopt($ch, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/JobPosition');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            
                $content = curl_exec($ch);
                $toJson = json_decode($content, true);
            
                if ($content === false) {
                    throw new Exception(curl_error($ch), curl_errno($ch));
                }
                $httpReturnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            } catch(Exception $e) {         
                trigger_error(sprintf(
                    'Curl failed with error #%d: %s',
                    $e->getCode(), $e->getMessage()),
                    E_USER_ERROR);
            }
            return $toJson;
        }

        public function GetAllApi ()
        {
            $jsonApi = $this->RetrieveDataApi();
            $jobPositionList = array();

            foreach($jsonApi as $value){
                $jobPosition = new JobPosition ();
                $jobPosition->setJobPositionId($value['jobPositionId']);
                $jobPosition->setCareerId($value['careerId']);
                $jobPosition->setDescription($value['description']);

                array_push($jobPositionList, $jobPosition);
            }
            return $jobPositionList;
        }

        public function getById($id)
        {
            $jobPositionList = $this->GetAllApi();

            foreach($jobPositionList as $jobPosition){
                if($jobPosition->getJobPositionId() == $id){
                    return $jobPosition;
                }
            }
        }
    }
?>