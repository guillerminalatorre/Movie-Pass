<script>
    function borrarCine(nombre){
        preg = window.confirm('¿Desea borrar el cine '+ nombre+'?');
        if(preg==true) 
        {
            alert('Se ha borrado el cine '+ nombre);
            location.href="<?php echo FRONT_ROOT ?>Cine/eliminarCineYredirect/<?php echo $cine->getNombre();?>";
        }
    }

    function borrarFuncion(id){
        preg = window.confirm('¿Desea borrar la funcion?');
        if(preg==true) 
        {
            alert('Se ha borrado la funcion');
            location.href="<?php echo FRONT_ROOT ?>Funcion/eliminarFuncionYredirect/id";
        }
    }
</script>

<div class="container container-fluid mt-4">
    <a class="btn btn-secondary" href="<?php echo FRONT_ROOT ?>Cine/ShowListView" role="button">Volver a lista de cines</a>
    <br>
    <table class="table table-striped">
        <thead class="thead-dark">       
            <tr>
            <th scope="col" style="text-align:left">
                <h2>Ficha de Cine</h2>
            </th>
            </tr>
        </thead>
    </table>
    <table class="table table-striped">
        <thead class="thead-dark">       
            <tr>
            <th scope="col" style="text-align:left">
                <a class="btn btn-warning" onclick = "borrarCine('<?php echo $cine->getNombre(); ?>');">Eliminar Cine</a>
            </th>
            <th scope="col" style="text-align:center">
                <h1><?php echo $cine->getNombre(); ?></h1>
            </th>
            <th scope="col" style="text-align:right">
                <a class="btn btn-info" href="<?php echo FRONT_ROOT ?>Cine/ShowModificarCine/<?php echo $cine->getNombre();?>">Modificar Cine</a>
            </th>
            </tr>
        </thead>
    </table>
    <table class="table table-dark">
    <tbody style="text-align:center">
        <tr>
        <th scope="row">Dirección</th>
        <td><?php echo $cine->getDireccion(); ?></td>
        </tr>
        <tr>
        <th scope="row">Capacidad</th>
        <td><?php echo $cine->getCapacidad(); ?> personas </td>
        </tr>
        <tr>
        <th scope="row">Precio</th>
        <td>$<?php echo $cine->getPrecio(); ?></td>
        </tr>
    </tbody>


    <table class="table table-striped">
        <thead class="thead-dark">       
            <tr>
            <th scope="col" style="text-align:left">Funciones</th>
            </tr>
        </thead>
    </table>
    <table class="table table-striped">
        <thead class="thead-dark">       
            <tr>
                <th scope="col" style="text-align:center">Id</th>
                <th scope="col" style="text-align:center">Pelicula</th>
                <th scope="col" style="text-align:center">Fecha</th>
                <th scope="col" style="text-align:center">Hora</th>
                <th scope="col" style="text-align:center">Cant. Entradas</th>
                <th scope="col" style="text-align:center">Cant. Vendidas</th>
                <th scope="col" style="text-align:right">
                    <a class="btn btn-info" href="<?php echo FRONT_ROOT ?>Funcion/ShowAgregarFuncion/<?php echo $cine->getNombre(); ?>">Agregar función</a>
                </th>
            </tr>
        </thead>
        <thead ody class="thead-dark">
            <tr>
                <?php foreach ($funciones as $funcion) {
                 ?>
                 <tr>
                <th scope="col" style="text-align:center"><?php echo $funcion->getId();?></th>
                <th scope="col" style="text-align:center"><?php echo $funcion->getId_Pelicula();?></th>
                <th scope="col" style="text-align:center"><?php echo $funcion->getFecha();?></th>
                <th scope="col" style="text-align:center"><?php echo $funcion->getHora();?></th>
                <th scope="col" style="text-align:center"><?php echo $funcion->getCantEntradas();?></th>
                <th scope="col" style="text-align:center"><?php echo $funcion->getCantVendidas();?></th>
                <th scope="col" style="text-align:right">
                <a class="btn btn-danger" onclick = "borrarFuncion('<?php echo $funcion->getId();?>');">Eliminar Funcion</a>
                </th>
                </tr>
                <?php } ?>
            </tr>
        </thead>
    </table>

</div>