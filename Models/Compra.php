<?php
require_once ('Usuario.php');

namespace Models;



use Models;
/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:07:11
 */
class Compra
{

	private $id;
	private $fecha;
	private $cantEntradas;
	private $descuento;
	private $total;
	private $Usuario;
	public $m_Usuario;

	function __construct()
	{
	}

	function __destruct()
	{
	}



	private function logicaDescuento()
	{
	}

}
?>