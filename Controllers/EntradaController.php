<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:05:37
	 */
	namespace Controllers;

	use DAO\EntradaDAO as EntradaDAO;
	use Models\Entrada as Entrada;

	class EntradaController
	{
		private $entradasDAO;

		function __construct()
		{
			$this->entradasDAO = new EntradaDAO();
		}

		public function Add(int $id, string $qr, int $id_Compra, int $id_Funcion)
		{
			$entrada = new Entrada($id, $qr, $id_Compra, $id_Funcion);

			$this->entradasDAO->add($entrada);

			Functions::getInstance()->redirect("Home");
		}
	}
?>