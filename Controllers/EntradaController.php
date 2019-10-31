<?php
/**
 * @author Guille
 * @version 1.0
 * @created 06-oct.-2019 19:05:37
 */
namespace Controllers;

use DAO\EntradaDAO as EntradaDAO;
use Models\Entrada as Entrada;
use DAO\CompraDAO as CompraDAO;
use Models\Compra as Compra;
use Models\Usuario as Usuario;

class EntradaController
{
	private $entradaDAO;
	private $compraDAO;

	function __construct()
	{
		$this->entradaDAO = new EntradaDAO();
		$this->compraDAO = new CompraDAO();
	}

	public function ShowListView()
	{
		$entradaList = array();
		$entradaList = $this->entradaDAO->getAll();
		require_once(VIEWS_PATH."entrada/entrada-list.php");
	}

	public function MisEntradas()
	{
		$entradaList = array();
		$compraList = $this->compraDAO->getByUsuario($_SESSION['loggedUser']);
		foreach($compraList as $compra)
		{
			$entradasCompra = $this->entradaDAO->getByCompra($compra);
			$entradaList = array_merge($entradaList,$entradasCompra);
		}
		require_once(VIEWS_PATH."entrada/entrada-list.php");
	}
}
?>