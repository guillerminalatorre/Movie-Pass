<?php if(isset($funcionList) && count($funcionList) > 0) { 
    foreach ($funcionList as $funcion) {
        if($cine->getId() == $funcion->getIdCine()) {  
?>
            <tr>

                <td><?php echo $funcion->getFecha();?></td>
                <td><?php echo $funcion->getHora();?></td>
                <td>32</td>
                <td style="text-align:right">
                    <a class="btn btn-success" href='<?php echo FRONT_ROOT ?>Entrada/comprarEntrada/<?php echo $funcion->getId(); ?>';">Comprar entrada</a>
                </td>
            </tr>
<?php 
        }
    }
} ?>