<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\Genero as Genero;
    use DAO\Connection as Connection;

    class GeneroDAO
    {
        private $connection;
        private $tableName = "Generos";

        public function getAll()
        {
            try 
            {
                $list = array();
                $query = "SELECT * FROM " . $this->tableName . " ORDER BY nombre;";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {
                    $genero = new Genero();
                    $genero->setId($row["id_genero"]);
                    $genero->setNombre($row["nombre"]);
                    array_push($list, $genero);
                }
                return $list;
            } 
            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function add($genero)
        {
            try 
            {
                $query = "INSERT INTO " . $this->tableName . " (id_genero, nombre) VALUES (:id_genero, :nombre);";
                $parameters["id_genero"] = $genero->getId();
                $parameters["nombre"] = $genero->getNombre();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } 
            catch (Exception $ex) 
            {
                throw $ex;
            }
        }

        function remove($genero)
        {
            try 
            {
                $query = "DELETE FROM " . $this->tableName . " WHERE id_genero = " . $genero->getId() . ";";

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            } 
            catch (Exception $ex) 
            {
                throw $ex;
            }
        }

        public function getGenero($genero)
        {
            try 
            {
                $query = "SELECT * FROM " . $this->tableName . "WHERE id_genero = " . $genero->getId() . ";";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) 
                {
                    $genero->setId($row["id_genero"]);
                    $genero->setNombre($row["nombre"]);
                }
                return $genero->getNombre();
            } 
            catch (Exception $ex) 
            {
                throw $ex;
            }
        }
    }
?>