<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-md-10 offset-sm-0 offset-md-1 bg-dark-transparent text-white rounded shadow p-2">
        <?php require_once(VIEWS_PATH."alert.php"); ?>
        <h2 class="col-sm-12 col-md-6 text-light pb-2 mb-2">Lista de entradas</h2>
        <table id="sortable" class="table table-striped table-responsive-md text-light align-center">
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
                    <td class="align-middle"><?php echo $entrada->getId(); ?></td>
                    <?php 
                        $idFuncion = $entrada->getIdFuncion();
                        $funcion->setId($idFuncion);
                        $funcion = $this->funcionDAO->getFuncion($funcion);
                        $idPelicula = $funcion->getIdPelicula();
                        $pelicula->setId($idPelicula);
                        $pelicula = $this->peliculaDAO->getPelicula($pelicula);
                    ?>
                    <td class="align-middle"><b><?php echo $pelicula->getTitulo(); ?></b></a></td>
                    <td class="align-middle"><?php echo $funcion->getId(); ?></td>
                    <td class="align-middle"><?php echo $entrada->getIdCompra(); ?></td>
                    <td class="align-middle"><a href="#modal<?php echo $entrada->getId();?>" class="view" title="" data-toggle="modal" data-original-title="View Details"><img src="https://chart.googleapis.com/chart?chs=75x75&cht=qr&chl=<?php echo $entrada->getQr(); ?>" class="rounded-circle z-depth-0" alt="qr"></a></td>
                    <td class="align-middle"><a href="#modal<?php echo $entrada->getId();?>" class="view" title="" data-toggle="modal" data-original-title="View Details"><h4><i class="fa fa-arrow-circle-right"></i></h4></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#sortable').DataTable();
    } );
</script>

<!-- Modal que muestra entrada -->
<?php 
foreach($entradaList as $entrada) 
{
    $idFuncion = $entrada->getIdFuncion();
    $funcion->setId($idFuncion);
    $funcion = $this->funcionDAO->getFuncion($funcion);
    $idPelicula = $funcion->getIdPelicula();
    $pelicula->setId($idPelicula);
    $pelicula = $this->peliculaDAO->getPelicula($pelicula);
    require(VIEWS_PATH."entrada/entrada.php");
}
?>