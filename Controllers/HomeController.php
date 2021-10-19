<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."add-company.php");
        }
        
        public function Login ($user){
            $get_data = $this->CallAPI('GET', 'https://utn-students-api.herokuapp.com/api/Student/', false);
            $response = json_decode($get_data, true);
            var_dump($response);
        }

        private function CallAPI($method, $url, $data)
        {
            $curl = curl_init();
        
            switch ($method)
            {
                case "POST":
                    curl_setopt($curl, CURLOPT_POST, 1);        
                    if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    break;
                case "PUT":
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                    if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    break;
                default:
                    if ($data)
                        $url = sprintf("%s?%s", $url, http_build_query($data));
            }
        
            // Optional Authentication:
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08',
                'Content-type: application/json',
            ));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        
            $result = curl_exec($curl);
        
            curl_close($curl);

            var_dump($result);
        
            return $result;
        }
    }
?>