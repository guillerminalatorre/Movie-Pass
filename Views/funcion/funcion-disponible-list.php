<?php 
if(isset($funcionList) && count($funcionList) > 0) { 
    foreach ($funcionList as $funcion) {
?>
            <tr>
                <td><?php echo $funcion->getFecha();?></td>
                <td><?php echo $funcion->getHora();?></td>
                <td>en proceso</td>
                <?php if($idPelicula != null) { ?>
                <td style="text-align:right">
                    <a class="btn btn-success shadow-sm" href='<?php echo FRONT_ROOT ?>Entrada/comprarEntrada/<?php echo $funcion->getId(); ?>';">Comprar entrada</a>
                </td>
                <?php } ?>
            </tr>
<?php
    }
} 
?>