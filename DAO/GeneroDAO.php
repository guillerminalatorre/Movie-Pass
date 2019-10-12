<?php

namespace DAO;

use Models\Genero as Genero;
use API\APIController as APIController;

class GeneroDAO
{
    private $generoList = array();

    public function getAll()
    {
        $this->getGendersFromApi();
        return $this->generoList;
    }

    public function getGenderForId($id){
        if(count($this->generoList)==0){
            $this->getAll();
        }
            foreach($this->generoList  as $genero ){
                if($genero->getId()==$id){
                    $genderName=$genero->getNombre();
                };
            }
        return $genderName;
    }

    private function getGendersFromApi()
    {
        $arrayReque=array("api_key"=>API_KEY, "language"=>LANGUAGE_ES);

		$get_data = APIController::callAPI('GET', API .'/genre/movie/list', $arrayReque);

        $arrayToDecode = json_decode($get_data, true);
        
        foreach ($arrayToDecode["genres"] as $categoryValues) {
            $category = new Genero();
            $category->setId($categoryValues["id"]);
            $category->setNombre($categoryValues["name"]);
            array_push($this->generoList, $category);
        }
    }
}

?>