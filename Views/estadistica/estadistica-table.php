<table id="sortable" class="table table-striped table-responsive-md text-light align-center">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Pelicula</th>
            <th scope="col">Sala</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Vendido</th>
            <th scope="col">Remanente</th>
            <th scope="col">Capacidad&nbsp;Total</th>
            <th scope="col">Recaudacion</th>
            <th scope="col">No&nbsp;vendido</th>
            </tr>
        </thead>
        <tbody>
        <?php if($idFuncion != null) { ?>
            <tr>
            <td><?php echo $funcion->getId(); ?></td>

            <?php 
            if(!isset($idPelicula) || $idPelicula == null) {
            $pelicula->setId($funcion->getIdPelicula());
            $pelicula = $this->peliculaDAO->getPelicula($pelicula);
            ?>
            <td><?php echo $pelicula->getTitulo(); ?></td>
            <?php } ?>

            <td>
            <?php 
                $sala->setId($funcion->getIdSala());
                $sala = $this->salaDAO->getSala($sala);
                echo $sala->getNombre();
            ?>    
            </td>
            <td><?php echo $funcion->getFecha();?></td>
            <td><?php echo $funcion->getHora();?></td>
            <td class="text-success"><?php echo (is_null($estadistica['vendido'][0])) ? 0 : $estadistica['vendido'][0]; ?></td>
            <td class="text-warning"><?php echo (is_null($estadistica['remanente'][0])) ? 0 : $estadistica['remanente'][0]; ?></td>
            <td class="text-info"><?php echo (is_null($estadistica['capacidad'][0])) ? 0 : $estadistica['capacidad'][0]; ?></td>
            <td class="text-success">$ <?php echo (is_null($estadistica['recaudacion'][0])) ? 0 : $estadistica['recaudacion'][0]; ?></td>
            <td class="text-danger">$ <?php echo (is_null($estadistica['novendido'][0])) ? 0 : $estadistica['novendido'][0]; ?></td>
        </tr>
        <?php } else {
            foreach ($funcionList as $key=>$funcion) {  ?>
            <tr>
            <td><?php echo $funcion->getId(); ?></td>

            <?php 
            if(!isset($idPelicula) || $idPelicula == null) {
            $pelicula->setId($funcion->getIdPelicula());
            $pelicula = $this->peliculaDAO->getPelicula($pelicula);
            ?>
            <td><?php echo $pelicula->getTitulo(); ?></td>
            <?php } ?>

            <td>
            <?php 
                $sala->setId($funcion->getIdSala());
                $sala = $this->salaDAO->getSala($sala);
                echo $sala->getNombre();
            ?>    
            </td>
            <td><?php echo $funcion->getFecha();?></td>
            <td><?php echo $funcion->getHora();?></td>
            <td class="text-success"><?php echo (is_null($estadistica['vendido'][$key])) ? 0 : $estadistica['vendido'][$key]; ?></td>
            <td class="text-warning"><?php echo (is_null($estadistica['remanente'][$key])) ? 0 : $estadistica['remanente'][$key]; ?></td>
            <td class="text-info"><?php echo (is_null($estadistica['capacidad'][$key])) ? 0 : $estadistica['capacidad'][$key]; ?></td>
            <td class="text-success">$ <?php echo (is_null($estadistica['recaudacion'][$key])) ? 0 : $estadistica['recaudacion'][$key]; ?></td>
            <td class="text-danger">$ <?php echo (is_null($estadistica['novendido'][$key])) ? 0 : $estadistica['novendido'][$key]; ?></td>
        </tr>
        <?php } } ?>
    </tbody>
</table>