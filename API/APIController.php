<?php

namespace API;

class APIController{
    
    public static function callAPI($method, $url, $data){
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
              case "GET":
              if ($data){
                 $url = sprintf("%s?%s", $url, http_build_query($data));
                 }
                 curl_setopt_array($curl, array(
                     CURLOPT_URL => $url,
                     CURLOPT_RETURNTRANSFER => true,
                     CURLOPT_ENCODING => "",
                     CURLOPT_SSL_VERIFYPEER => false,
                     CURLOPT_MAXREDIRS => 10,
                     CURLOPT_TIMEOUT => 30,
                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                     CURLOPT_CUSTOMREQUEST => "GET",
                     CURLOPT_POSTFIELDS => "{}",
                 ));
           default:
              if ($data)
                 $url = sprintf("%s?%s", $url, http_build_query($data));
        }
     
        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
     }
     
}
?>