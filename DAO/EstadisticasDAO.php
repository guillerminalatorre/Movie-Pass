<?php

namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;
use Models\Funcion as Funcion;
use Models\Cine as Cine;
use Models\Pelicula as Pelicula;

class EstadisticasDAO
{
    private $connection;
    private $tableNameEntradas = "Entradas";
    private $tableNameCompras = "Compras";
    private $tableNameFunciones = "Funciones";
    private $tableNameSalas = "Salas";


    public function getCantidadVendidaFuncion(Funcion $funcion)
    {
        try {
            $query = "SELECT SUM(cantidad) AS 'cantidadVendida' FROM " . $this->tableNameEntradas . " JOIN " . $this->tableNameCompras . " ON (" . $this->tableNameEntradas . ".id_compra = " . $this->tableNameCompras . ".id_compra) WHERE id_funcion = :id_funcion;";
            $parameters["id_funcion"] = $funcion->getId();

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $cantidad = $row["cantidadVendida"];
            }
            return $cantidad;
        } catch (Exception $ex) {
            return null;
        }
    }

    public function getRemanenteFuncion(Funcion $funcion)
    {

        $query = "SELECT ((SELECT capacidad FROM ".$this->tableNameFunciones." JOIN ".$this->tableNameSalas." ON (".$this->tableNameFunciones.".id_sala = ".$this->tableNameSalas.".id_sala) WHERE id_funcion = :id_funcion ) - COUNT(id_entrada)) as 'remanente' FROM " . $this->tableNameEntradas . " JOIN " . $this->tableNameCompras . " ON (" . $this->tableNameEntradas . ".id_compra = " . $this->tableNameCompras . ".id_compra) WHERE id_funcion = :id_funcion;";
        $parameters['id_funcion'] = $funcion->getId();

        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query, $parameters);

        foreach ($resultSet as $row) {
            $remanente = $row["remanente"];
        }
        return $remanente;
    }

    public function getVentasPelicula(Pelicula $pelicula, $fechaInicio, $fechaCierre)
    {
        try {

            $query = "SELECT SUM(total) AS 'total' FROM " . $this->tableNameEntradas . " JOIN " . $this->tableNameCompras . " ON (" . $this->tableNameEntradas . ".id_compra = " . $this->tableNameCompras . ".id_compra) JOIN "
                . $this->tableNameFunciones . " ON (" . $this->tableNameEntradas . ".id_funcion = "
                . $this->tableNameFunciones . ".id_funcion) WHERE id_pelicula = :id_pelicula AND " . $this->tableNameFunciones . ".fecha_hora >= :fecha_inicio AND " . $this->tableNameFunciones . ".fecha_hora <=:fecha_cierre;";
            $parameters["id_pelicula"] = $pelicula->getId();
            $parameters["fecha_inicio"] = $fechaInicio;
            $parameters["fecha_cierre"] = $fechaCierre;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);
            foreach ($resultSet as $row) {
                $ventas = $row["total"];
            }
            return $ventas;
        } catch (Exception $ex) {
            return null;
        }
    }

    public function getVentasCine(Cine $cine, $fechaInicio, $fechaCierre)
    {
        try {

            $query = "SELECT SUM(total) AS 'total' FROM " . $this->tableNameEntradas . " JOIN " . $this->tableNameCompras . " ON (" . $this->tableNameEntradas . ".id_compra = " . $this->tableNameCompras . ".id_compra) JOIN "
                . $this->tableNameFunciones . " ON (" . $this->tableNameEntradas . ".id_funcion = "
                . $this->tableNameFunciones . ".id_funcion) WHERE id_cine = :id_cine AND " . $this->tableNameFunciones . ".fecha_hora >= :fecha_inicio AND " . $this->tableNameFunciones . ".fecha_hora <=:fecha_cierre;";
            $parameters["id_cine"] = $cine->getId();
            $parameters["fecha_inicio"] = $fechaInicio;
            $parameters["fecha_cierre"] = $fechaCierre;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);
            foreach ($resultSet as $row) {
                $ventas = $row["total"];
            }
            return $ventas;
        } catch (Exception $ex) {
            return null;
        }
    }
}
