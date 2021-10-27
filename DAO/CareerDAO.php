<?php
    namespace DAO;

    use Models\Career as Career;

    class CareerDAO implements ICareerDAO
    {
        private function RetrieveDataApi ()
        {
            try {
                $ch = curl_init();
            
                if ($ch === false) {
                    throw new Exception('failed to initialize');
                }
            
                curl_setopt($ch, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/Career');
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
            $careerList = array();

            foreach($jsonApi as $value){
                $career = new Career ();
                $career->setCareerId($value['careerId']);
                $career->setDescription($value['description']);
                $career->setActive($value['active']);

                array_push($careerList, $career);
            }
            return $careerList;
        }

        public function getById($id)
        {
            $careerList = $this->GetAllApi();

            foreach($careerList as $career){
                if($career->getCareerId() == $id){
                    return $career;
                }
            }
        }
    }
?>