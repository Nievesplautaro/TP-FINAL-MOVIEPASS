<?php
    function callAPI($method, $url, $data){
        
        $curl = curl_init();
            
        switch ($method){
                
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
            // OPTIONS:
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'api_key: d7de7eee1dd5c6bed7940903c861af62',
            'Content-Type: application/json',
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            // EXECUTE:
            $result = curl_exec($curl);
            if(!$result){die("Connection Failure");}
            curl_close($curl);
            return $result;
    }

    $get_data = callAPI('GET', 'https://api.themoviedb.org/3/movie/now_playing', false);
    $response = json_decode($get_data, true);
    $errors = $response['response']['errors'];
    $data = $response['response']['data'][0];

    var_dump($response);
?>