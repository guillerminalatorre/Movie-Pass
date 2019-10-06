<?php
require_once ('Funcion.php');
require_once ('Compra.php');

namespace Models;



use Models;
use Models;
/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:07:11
 */
class Entrada
{

	private $id;
	private $qr;
	private $compra;
	private $funcion;
	public $m_Funcion;
	public $m_Compra;

	function __construct()
	{
	}

	function __destruct()
	{
	}



}
?>