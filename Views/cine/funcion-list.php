<?php if(isset($funcionList) && count($funcionList) > 0) { ?>
<table class="table">
    <thead class="table-dark">
        <tr>
            <?php foreach ($funcionList as $funcion) {
            ?>
            <tr>
                <th scope="col" style="text-align:center"><?php echo $funcion->getId();?></th>
                <th scope="col" style="text-align:center"><?php echo $funcion->getId_Pelicula();?></th>
                <th scope="col" style="text-align:center"><?php echo $funcion->getFecha();?></th>
                <th scope="col" style="text-align:center"><?php echo $funcion->getHora();?></th>
                <th scope="col" style="text-align:center"><?php echo $funcion->getCantEntradas();?></th>
                <th scope="col" style="text-align:center"><?php echo $funcion->getCantVendidas();?></th>
                <th scope="col" style="text-align:right">
                    <a class="btn btn-danger" onclick = "if(borrarFuncion('<?php echo $funcion->getId();?>')) href='<?php echo FRONT_ROOT ?>Funcion/eliminarFuncion/<?php echo $funcion->getId(); ?>';">Eliminar Funcion</a>
                </th>
            </tr>
            <?php } ?>
        </tr>
    </thead>
</table>
<?php } ?>