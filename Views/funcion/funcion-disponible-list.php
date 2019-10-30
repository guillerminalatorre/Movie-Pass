<?php 
if(isset($funcionList) && count($funcionList) > 0) { 
    foreach ($funcionList as $funcion) {
?>
            <tr>
                <td><?php echo $funcion->getFecha();?></td>
                <td><?php echo $funcion->getHora();?></td>
                <td>en proceso</td>
                <?php if($idPelicula != null) { ?>
                
                <form action="<?php echo FRONT_ROOT ?>Compra/Payout/<?php echo $funcion->getId(); ?>" method="POST">
                
                    <td style="text-align:right; width:35%">
                    <input type="number" class="form-control d-inline align-middle col-sm-2 input-sm" name="cantidad" value="0" required>
                    <button type="submit" class="btn btn-success shadow-sm align-middle">Comprar entrada</button>
                </td>
                </form>
                <?php } ?>
            </tr>
<?php
    }
} 
?>