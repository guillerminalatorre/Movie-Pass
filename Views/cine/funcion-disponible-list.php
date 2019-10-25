<?php if(isset($funcionList) && count($funcionList) > 0) { ?>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <?php foreach ($funcionList as $funcion) {
                ?>
                <tr>
                    <th scope="col" style="text-align:center"><?php echo $funcion->getFecha();?></th>
                    <th scope="col" style="text-align:center"><?php echo $funcion->getHora();?></th>
                    <th scope="col" style="text-align:right">
                        <a class="btn btn-danger" href='<?php echo FRONT_ROOT ?>Entrada/comprarEntrada/<?php echo $funcion->getId(); ?>';">Comprar Entrada</a>
                    </th>
                </tr>
                <?php } ?>
            </tr>
        </thead>
    </table>
<?php } ?>