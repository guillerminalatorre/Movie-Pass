<?php

namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;
use Models\Funcion as Funcion;
use Models\Cine as Cine;
use Models\Pelicula as Pelicula;
use Controllers\Functions as Functions;

class EstadisticaDAO
{
    private $connection;
    private $tableNameEntradas = "Entradas";
    private $tableNameCompras = "Compras";
    private $tableNameFunciones = "Funciones";
    private $tableNameSalas = "Salas";

    public function getCantidadVendidaFuncion(Funcion $funcion)
    {
        try 
        {
            $query = "SELECT COUNT(id_entrada) AS 'cantidad' FROM " . $this->tableNameEntradas .
            " WHERE id_funcion = :id_funcion;";
            
            $parameters["id_funcion"] = $funcion->getId();

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) 
            {
                $cantidad = $row["cantidad"];
            }
            return $cantidad;
        } 
        catch (Exception $ex)
        {
            return null;
        }
    }

    public function getRemanenteFuncion(Funcion $funcion)
    {
        try 
        {
            $query = "SELECT ((SELECT capacidad FROM " . $this->tableNameFunciones . 
            " JOIN " . $this->tableNameSalas . " ON (" . $this->tableNameFunciones . ".id_sala = " . $this->tableNameSalas . ".id_sala) WHERE id_funcion = :id_funcion ) - COUNT(id_entrada)) as 'remanente' FROM " . $this->tableNameEntradas . 
            " JOIN " . $this->tableNameCompras . " ON (" . $this->tableNameEntradas . ".id_compra = " . $this->tableNameCompras . ".id_compra)".
            " WHERE id_funcion = :id_funcion;";
            
            $parameters['id_funcion'] = $funcion->getId();
            
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) 
            {
                $remanente = $row["remanente"];
            }
            return $remanente;
        } 
        catch (Exception $ex)
        {
            return null;
        }
    }

    public function getRecaudacionFuncion(Funcion $funcion)
    {
        try 
        {
            $query = "SELECT SUM(totalfuncion) as recaudacion FROM".
            " (SELECT DISTINCT SUM(total) AS totalfuncion FROM " . $this->tableNameEntradas . " e".
            " JOIN " . $this->tableNameCompras . " c ON e.id_compra = c.id_compra"
            ." WHERE id_funcion = :id_funcion GROUP BY e.id_entrada) as r";
            
            $parameters["id_funcion"] = $funcion->getId();

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) 
            {
                $recaudacion = $row["recaudacion"];
                return $recaudacion;
            }
        } 
        catch (Exception $ex)
        {
            return null;
        }
    }
}
