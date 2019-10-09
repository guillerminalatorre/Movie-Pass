<?php 
require "Config/Autoload.php"; 

use Config\Autoload as Autoload;

Autoload::start();

use Models\Cine as Cine;
use DAO\CineDAO as DAO;

require_once("Views/header.php");

?>

<div class="container container-fluid mt-4">
    <h2>Selecciona un cine para operar: </h2>
    <?php 
        $cineDAO = new CineDAO();
        $cines = $cineDAO->getAll();

        foreach ($cines as $cine) {
            ?>
                <br>
                <button type="button" class="btn btn-info btn-block" href="ficha-cine.php" value = "<?php $cine->getId();?>">  <?php $cine->getNombre();?></button>
                <hr>
            <?php
        }
    ?>

    <button type="button" class="btn btn-success btn-block" ><i class="fas fa-plus-circle"></i> Agregar cine</button>
</div>
<?php require_once("Views/footer.php");?>