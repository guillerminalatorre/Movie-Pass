<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\Sala as Sala;
    
    class SalaDAO
    {
        private $connection;
        private $tableName = "Salas";

        public function add($sala)
        {
            try 
            {
                $query = "INSERT INTO " . $this->tableName . " (id_cine, nombre, precio, capacidad) VALUES (:id_cine, :nombre, :precio, :capacidad);";

                $parameters["id_cine"] = $sala->getIdCine();
                $parameters["nombre"] = $sala->getNombre();
                $parameters["precio"] = $sala->getPrecio();
                $parameters["capacidad"] = $sala->getCapacidad();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                return true;
            } 
            catch (Exception $ex) 
            {
                return false;
            }
        }

        function remove($sala)
        {
            try 
            {
                $query = "UPDATE " . $this->tableName . " SET deleted = 1 WHERE id_sala = :id_sala;";

                $parameters['id_sala'] = $sala->getId();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                return true;
            } 
            catch (Exception $ex) 
            {
                return false;
            }
        }

        public function getAll()
        {
            try 
            {
                $list = array();
                $query = "SELECT * FROM " . $this->tableName." WHERE deleted = 0;";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) 
                {
                    $sala = new Sala();
                    $sala->setId($row["id_sala"]);
                    $sala->setIdCine($row["id_cine"]);
                    $sala->setNombre($row["nombre"]);
                    $sala->setPrecio($row["precio"]);
                    $sala->setCapacidad($row["capacidad"]);
                    array_push($list, $sala);
                }
                return $list;
            }
            catch (Exception $ex) 
            {
                return null;
            }
        }

        public function getSala($sala)
        {
            try 
            {
                $query = "SELECT * FROM " . $this->tableName . " WHERE id_sala = '" . $sala->getId() . "' AND deleted = 0;";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {
                    $sala->setId($row["id_sala"]);
                    $sala->setIdCine($row["id_cine"]);
                    $sala->setNombre($row["nombre"]);
                    $sala->setPrecio($row["precio"]);
                    $sala->setCapacidad($row["capacidad"]);
                    return $sala;
                }
            } 
            catch (Exception $ex) 
            {
                return null;
            }
        }

        public function getByCine($cine)
        {
            try 
            {
                $list = array();
                $query = "SELECT * FROM " . $this->tableName . " WHERE id_cine = '" . $cine->getId() . "' AND deleted = 0;";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) 
                {
                    $sala = new Sala();
                    $sala->setId($row["id_sala"]);
                    $sala->setIdCine($row["id_cine"]);
                    $sala->setNombre($row["nombre"]);
                    $sala->setPrecio($row["precio"]);
                    $sala->setCapacidad($row["capacidad"]);
                    array_push($list, $sala);
                }
                return $list;
            } 
            catch (Exception $ex) 
            {
                return null;
            }
        }

        public function edit($sala)
        {
            try 
            {
                $query = "UPDATE " . $this->tableName . " SET id_cine = :id_cine, nombre = :nombre, precio = :precio, capacidad = :capacidad WHERE id_sala = :id_sala;";

                $parameters["id_cine"] = $sala->getIdCine();
                $parameters["nombre"] = $sala->getNombre();
                $parameters["precio"] = $sala->getPrecio();
                $parameters["capacidad"] = $sala->getCapacidad();
                $parameters["id_sala"] = $sala->getId();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                return true;
            } 
            catch (Exception $ex) 
            {
                return false;
            }
        }
    }
?>