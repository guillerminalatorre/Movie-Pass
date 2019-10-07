<?php

namespace Models;

/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:07:11
 */
class Funcion
{

	private $id;
	private $id_Cine;
	private $fecha;
	private $hora;
	private $id_Pelicula;	
	private $cantEntradas;
	private $cantVendidas;

	function __construct(int $id, int $id_Cine, string $fecha, string $hora, int $id_Pelicula, int $cantEntradas)
	{
		$this->id = $id;
		$this->id_Cine = $id_Cine;
		$this->fecha = $fecha;
		$this->hora= $hora;
		$this->id_Pelicula = $id_Pelicula;
		$this->cantEntradas = $cantEntradas;
		$this->cantVendidas=$cantVendidas;
	}

		/**
	 * Getter for Id
	 *
	 * @return [type]
	 */
	 public function getId()
	 {
		 return $this->id;
	 }
 
	 /**
	  * Setter for Id
	  * @var [type] id
	  *
	  * @return self
	  */
	 public function setId($id)
	 {
		 $this->id = $id;
		 return $this;
	 }
 
 
	 /**
	  * Getter for Id_Cine
	  *
	  * @return [type]
	  */
	 public function getId_Cine()
	 {
		 return $this->id_Cine;
	 }
 
	 /**
	  * Setter for Id_Cine
	  * @var [type] id_Cine
	  *
	  * @return self
	  */
	 public function setId_Cine($id_Cine)
	 {
		 $this->id_Cine = $id_Cine;
		 return $this;
	 }
 
 
	 /**
	  * Getter for Fecha
	  *
	  * @return [type]
	  */
	 public function getFecha()
	 {
		 return $this->fecha;
	 }
 
	 /**
	  * Setter for Fecha
	  * @var [type] fecha
	  *
	  * @return self
	  */
	 public function setFecha($fecha)
	 {
		 $this->fecha = $fecha;
		 return $this;
	 }
 
 
	 /**
	  * Getter for Hora
	  *
	  * @return [type]
	  */
	 public function getHora()
	 {
		 return $this->hora;
	 }
 
	 /**
	  * Setter for Hora
	  * @var [type] hora
	  *
	  * @return self
	  */
	 public function setHora($hora)
	 {
		 $this->hora = $hora;
		 return $this;
	 }
 
 
	 /**
	  * Getter for Id_Pelicula
	  *
	  * @return [type]
	  */
	 public function getId_Pelicula()
	 {
		 return $this->id_Pelicula;
	 }
 
	 /**
	  * Setter for Id_Pelicula
	  * @var [type] id_Pelicula
	  *
	  * @return self
	  */
	 public function setId_Pelicula($id_Pelicula)
	 {
		 $this->id_Pelicula = $id_Pelicula;
		 return $this;
	 }

	 
	/**
	 * Getter for CantEntradas
	 *
	 * @return [type]
	 */
	public function getCantEntradas()
	{
	    return $this->cantEntradas;
	}

	/**
	 * Setter for CantEntradas
	 * @var [type] cantEntradas
	 *
	 * @return self
	 */
	public function setCantEntradas($cantEntradas)
	{
	    $this->cantEntradas = $cantEntradas;
	    return $this;
	}

		/**
	 * Getter for CantVendidas
	 *
	 * @return [type]
	 */
	 public function getCantVendidas()
	 {
		 return $this->cantVendidas;
	 }
 
	 /**
	  * Setter for CantVendidas
	  * @var [type] cantVendidas
	  *
	  * @return self
	  */
	 public function setCantVendidas($cantVendidas)
	 {
		 $this->cantVendidas = $cantVendidas;
		 return $this;
	 }

	 public function agregarEntradasVendidas( int $nuevasEntradasVendidas)
	 {
		if($this->cantEntradas >= ($cantVendidas + $nuevasEntradasVendidas))
		{
			setCantEntradas($this->cantVendidas + $nuevasEntradasVendidas)
			return true;
		}
		return false;
	 }
}
?>