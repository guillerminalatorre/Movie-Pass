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
            return 0;
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
            return 0;
        }
    }

    public function getRecaudacionFuncion(Funcion $funcion)
    {
        try 
        {
            $query = "SELECT c.total - c.descuento AS recaudacion FROM " . $this->tableNameEntradas .
            " e JOIN " . $this->tableNameCompras . " c ON (e.id_compra = c.id_compra)".
            " WHERE id_funcion = :id_funcion GROUP BY c.id_compra;";
            
            $parameters["id_funcion"] = $funcion->getId();

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            $recaudacion = 0;
            foreach ($resultSet as $row) 
            {
                $recaudacion += $row["recaudacion"];
            }
            return $recaudacion;          
        } 
        catch (Exception $ex) 
        {
            return 0;
        }
    }

    public function getVentasPelicula(Pelicula $pelicula, $fechaInicio = null, $fechaFin = null)
    {
        try 
        {
            $query = "SELECT SUM(total) AS 'total' FROM " . $this->tableNameEntradas . 
            " JOIN " . $this->tableNameCompras . " ON (" . $this->tableNameEntradas . ".id_compra = " . $this->tableNameCompras . ".id_compra)".
            " JOIN " . $this->tableNameFunciones . " ON (" . $this->tableNameEntradas . ".id_funcion = " . $this->tableNameFunciones . ".id_funcion)".
            " WHERE id_pelicula = :id_pelicula";
           
            if($fechaInicio != null) $query = $query . " AND " . $this->tableNameFunciones . ".fecha_hora >= :fecha_inicio";
            if($fechaFin != null) $query = $query . " AND " . $this->tableNameFunciones . ".fecha_hora <= :fecha_fin";

            $query = $query . ";";

            $parameters["id_pelicula"] = $pelicula->getId();
            $parameters["fecha_inicio"] = $fechaInicio;
            $parameters["fecha_fin"] = $fechaFin;
            
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);
           
            foreach ($resultSet as $row) 
            {
                $ventas = $row["total"];
            }
            return $ventas;
        } 
        catch (Exception $ex) 
        {
            return null;
        }
    }

    public function getVentasCine(Cine $cine, $fechaInicio = null, $fechaFin = null)
    {
        try 
        {
            $query = "SELECT SUM(total) AS 'total' FROM " . $this->tableNameEntradas . 
            " JOIN " . $this->tableNameCompras . " ON (" . $this->tableNameEntradas . ".id_compra = " . $this->tableNameCompras . ".id_compra)".
            " JOIN " . $this->tableNameFunciones . " ON (" . $this->tableNameEntradas . ".id_funcion = " . $this->tableNameFunciones . ".id_funcion)".
            " WHERE id_cine = :id_cine";
            
            if($fechaInicio != null) $query = $query . " AND " . $this->tableNameFunciones . ".fecha_hora >= :fecha_inicio";
            if($fechaFin != null) $query = $query . " AND " . $this->tableNameFunciones . ".fecha_hora <= :fecha_fin";

            $query = $query . ";";

            $parameters["id_cine"] = $cine->getId();
            $parameters["fecha_inicio"] = $fechaInicio;
            $parameters["fecha_fin"] = $fechaFin;
            
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);
            
            foreach ($resultSet as $row)
            {
                $ventas = $row["total"];
            }
            return $ventas;
        } 
        catch (Exception $ex) 
        {
            return null;
        }
    }
}
