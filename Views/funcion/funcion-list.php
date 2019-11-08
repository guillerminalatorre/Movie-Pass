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
        $sala = $this->salaDAO->getSala();
        echo $sala->getNombre." (".$sala->getCapacidad().")";
    ?>    
    </td>
    <td><?php echo $funcion->getFecha();?></td>
    <td><?php echo $funcion->getHora();?></td>
    <td>
    <?php
    echo count($this->entradaDAO->getByFuncion($funcion));
    echo "/";
    echo $cine->getCapacidad();
    ?>
    </td>
    <?php if(isset($idPelicula) && $idPelicula != null) { ?>
        <form action="<?php echo FRONT_ROOT ?>Compra/Pay" method="POST">
            <td style="text-align:right; width:35%">
            <input type="hidden" name="idFuncion" value="<?php echo $funcion->getId(); ?>">
            <input type="number" class="form-control d-inline align-middle col-2 input-sm" name="cantidad" value="1" min="1" required>

            <?php if($this->loggedIn() && $esAdmin == false) { ?>            
            <button type="submit" class="btn btn-success shadow-sm align-middle">Comprar entrada</button>
            <?php } else { ?>
            <a class="btn btn-secondary shadow-sm align-middle" href="<?php echo FRONT_ROOT ?>Login" role="button">Iniciar sesion para comprar</a>
            <?php } ?>

            </td>
        </form>
    <?php } else { ?>
        <td scope="col" style="text-align:right">
        <a class="btn btn-danger btn-sm shadow-sm" onclick = "if(borrarFuncion('<?php echo $funcion->getId();?>')) href='<?php echo FRONT_ROOT ?>Funcion/Remove/<?php echo $funcion->getId(); ?>';">Eliminar Funcion</a>
        </td>
    <?php } ?>
</tr>