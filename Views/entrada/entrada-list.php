<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-md-10 offset-sm-0 offset-md-1 bg-dark-transparent text-white rounded shadow p-2">
        <?php require_once(VIEWS_PATH."alert.php"); ?>
        <h2 class="col-sm-12 col-md-6 text-light pb-2 mb-2">Lista de entradas</h2>
        <?php require_once(VIEWS_PATH."entrada/entrada-table.php"); ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#sortable').DataTable( {
        "columnDefs": [
            { "orderable": false, "targets": [4,5]}
        ]
        } );
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