<tr>
    <td><?php echo $sala->getId(); ?></td>
    <td><?php echo $sala->getNombre(); ?></td>
    <td><?php echo $sala->getPrecio();?></td>
    <td><?php echo $sala->getCapacidad(); ?></td>
    <td scope="col" style="text-align:right">
        <a class="btn btn-danger btn-sm shadow-sm" onclick = "if(borrarSala('<?php echo $sala->getId();?>','<?php echo $sala->getNombre();?>')) href='<?php echo FRONT_ROOT ?>Sala/Remove/<?php echo $sala->getId(); ?>';">Eliminar Sala</a>
    </td>
</tr>