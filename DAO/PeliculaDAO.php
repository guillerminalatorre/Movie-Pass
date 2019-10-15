<?php
	namespace DAO;

	use Models\Pelicula as Pelicula;
	use Models\Genero as Genero;
	use API\APIController as APIController;

	class PeliculaDAO
	{
		private $peliculaList = array();
		private $totalPages;

	public function getNumberOfTotalPages(){
		return $this->totalPages;
	}

	public function getByGenre($id)
    { 
		$this->getMoviesByGender($id);
        return $this->peliculaList;
	}

	public function getNowPlayingMovies(){
		
		if (isset($_GET['page'])) {
			$pageValue = $_GET['page'];
		} else {
			$pageValue = 1;
		}
	
	$arrayReque=array("api_key"=>API_KEY, "language"=>LANGUAGE_ES, "region"=>"AR", "page"=>$pageValue);

	$get_data = APIController::callAPI('GET', API .'/movie/now_playing', $arrayReque);

	$arrayToDecode = json_decode($get_data, true);

	foreach($arrayToDecode["results"] as $valuesArray)
	{
		$pelicula = new Pelicula();
		$pelicula->setPoster($valuesArray["poster_path"]);
		$pelicula->setId($valuesArray["id"] );
		$pelicula->setIdioma($valuesArray["original_language"]);
		$pelicula->setClasificacion($valuesArray["adult"]);

		foreach($valuesArray["genre_ids"] as $genero)
		{
			$pelicula->agregarGenero($genero);
		}

		$pelicula->setTitulo($valuesArray["title"]);
		$pelicula->setPopularidad($valuesArray["vote_average"]);
		$pelicula->setDescripcion($valuesArray["overview"]);
		$pelicula->setFechaDeEstreno($valuesArray["release_date"]);				

		if($valuesArray["video"]!==false)
		{
			$pelicula->setVideo($valuesArray["video"]);
		}

		array_push($this->peliculaList, $pelicula);
	}

	$this->totalPages=$arrayToDecode["total_pages"];
	return $this->peliculaList;
}

	private function getMoviesByGender($id)
    {
	   $actualDate=date("Y-m-d");
	
       $arrayReque=array("api_key"=>API_KEY, "language"=>LANGUAGE_ES, "include_video"=>true,"with_genres"=>$id,"primary_release_date.lte"=>date("Y-m-d", strtotime($actualDate . "+ 5 days")),"primary_release_date.gte"=> date("Y-m-d", strtotime($actualDate . "- 2 month")),"sort_by"=>"primary_release_date.desc", "with_original_language"=>"es,en");

		$get_data = APIController::callAPI('GET', API .'/discover/movie', $arrayReque);

		$arrayToDecode = json_decode($get_data, true);

		foreach($arrayToDecode["results"] as $valuesArray)
		{
			$pelicula = new Pelicula();
			$pelicula->setPoster($valuesArray["poster_path"]);
			$pelicula->setId($valuesArray["id"] );
			$pelicula->setIdioma($valuesArray["original_language"]);

			foreach($valuesArray["genre_ids"] as $genero)
			{
				$pelicula->agregarGenero($genero);
			}

			$pelicula->setTitulo($valuesArray["title"]);
			$pelicula->setPopularidad($valuesArray["vote_average"]);
			$pelicula->setDescripcion($valuesArray["overview"]);
			$pelicula->setFechaDeEstreno($valuesArray["release_date"]);				

			if($valuesArray["video"]!==false)
			{
				$pelicula->setVideo($valuesArray["video"]);
			}
			$this->totalPages=$arrayToDecode["total_pages"];

			array_push($this->peliculaList, $pelicula);
		}
	}
}
?>
