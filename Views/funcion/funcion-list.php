<?php 
if(isset($funcionList) && count($funcionList) > 0) {
    foreach ($funcionList as $funcion) 
    {
?>

        <tr>
            <th scope="row"><?php echo $funcion->getId();?></th>
            <td scope="col"><?php echo $funcion->getIdPelicula(); ?></td>
            <td scope="col"><?php echo $funcion->getFecha();?></td>
            <td scope="col"><?php echo $funcion->getHora();?></td>
            <td scope="col"><?php echo $funcion->getCantEntradas();?></td>
            <td scope="col" style="text-align:right">
                <a class="btn btn-danger shadow-sm" onclick = "if(borrarFuncion('<?php echo $funcion->getId();?>')) href='<?php echo FRONT_ROOT ?>Funcion/eliminarFuncion/<?php echo $funcion->getId(); ?>';">Eliminar Funcion</a>
            </td>
        </tr>

<?php
    }
} 
?>