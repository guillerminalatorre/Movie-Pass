<?php

namespace DAO;

use Models\Genero as Genero;
use API\APIController as APIController;

class GeneroDAO
{
    protected $generoList = array();

    public function getAll()
    {
        if(!file_exists(ROOT."Data/generos.json"))
        {
             $this->getGendersFromApi();
        }
        else
        {
            $this->getGendersFromFile();
        }   
        return $this->generoList;
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

        //Upload a file with the genders.
        $jsonContent = json_encode($arrayToDecode["genres"], JSON_PRETTY_PRINT);
		file_put_contents("Data/generos.json", $jsonContent);
    }

    private function getGendersFromFile()
    {
        $this->generoList = array();
        if(file_exists(ROOT."Data/generos.json"));
        {
            $jsonContent = file_get_contents("Data/generos.json");

            $arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
            
            foreach($arrayToDecode as $valuesArray)
            {
                $valueGenero = new Genero();
                $valueGenero->setId($valuesArray["id"]);
                $valueGenero->setNombre($valuesArray["name"]);
                array_push($this->generoList, $valueGenero);
            }
        }
    }
}

?>