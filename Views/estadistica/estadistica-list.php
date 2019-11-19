<?php if($count > 0) { ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-md-10 offset-sm-0 offset-md-1 bg-dark-transparent text-white rounded shadow p-2">
        <h2 class="col-12 text-light pb-2 mb-2">Estadisticas por funcion</h2>
        <?php require_once(VIEWS_PATH."estadistica/estadistica-table.php"); ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#sortable').DataTable( {
        "columnDefs": [
            { "orderable": false, "targets": [3,4]}
        ]
        } );
    } );
</script>

<?php 
}
?>