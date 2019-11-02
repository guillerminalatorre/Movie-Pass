<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container container-fluid bg-dark rounded mt-4 my-3 p-3 shadow">
    <?php require_once(VIEWS_PATH."alert.php"); ?>
    <h2 class="col-6 pb-2 text-light">Lista de entradas</h2>
    <table class="table table-striped text-light align-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Pelicula</th>
                <th>N.Funcion</th>
                <th>N.Compra</th>
                <th>QR</th>
                <th>Entrada</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entradaList as $entrada) { ?>
            <tr>
                <td><?php echo $entrada->getId(); ?></td>
                <?php 
                    $idFuncion = $entrada->getIdFuncion();
                    $funcion->setId($idFuncion);
                    $funcion = $this->funcionDAO->getFuncion($funcion);
                    $idPelicula = $funcion->getIdPelicula();
                    $pelicula->setId($idPelicula);
                    $pelicula = $this->peliculaDAO->getPelicula($pelicula);
                ?>
                <td><b><?php echo $pelicula->getTitulo(); ?></b></a></td>
                <td><?php echo $funcion->getId(); ?></td>
                <td><?php echo $entrada->getIdCompra(); ?></td>
                <td><a href="#modal<?php echo $entrada->getId();?>" class="view" title="" data-toggle="modal" data-original-title="View Details"><img src="https://chart.googleapis.com/chart?chs=75x75&cht=qr&chl=<?php echo $entrada->getQr(); ?>" class="rounded-circle z-depth-0" alt="qr"></a></td>
                <td><a href="#modal<?php echo $entrada->getId();?>" class="view" title="" data-toggle="modal" data-original-title="View Details"><h4><i class="fa fa-arrow-circle-right"></i></h4></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal que muestra entrada -->
<?php 
foreach($entradaList as $entrada) 
{
    require(VIEWS_PATH."entrada/entrada.php");
}
?>