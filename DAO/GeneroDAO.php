<?php

namespace DAO;
use Models\Genero as Genero;

class GeneroDAO
{
	private $generoList = array ();

	function GetAllGenders()
    { 
        $this->getCurl();
        return $this->generoList;
    }

	public function getCurl()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.themoviedb.org/3/genre/movie/list?language=es&api_key=6a65158231eaaf71a3446b747cff20ec",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $arrayToDecode = ($response) ? json_decode($response, true) : array();
            
            foreach ($arrayToDecode["genres"] as $categoryValues) {
                $category = new Genero();
                $category->setId($categoryValues["id"]);
                $category->setNombre($categoryValues["name"]);
                array_push($this->generoList, $category);
            }
        }
    }

}
?>