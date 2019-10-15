<?php
require_once(VIEWS_PATH."checklogin.php");
require_once(VIEWS_PATH."navbar.php");
?>

<!-- <script>
    function borrarUsuario(nombreUsuario){
        preg = window.confirm('¿Desea borrar el usuario'+ nombreUsuario +'?');
        if(preg==true) 
        {
            alert('Se ha borrado el usuario '+ nombreUsuario);
        }
        return preg;
    }
</script> -->

<div class="container">
    <div>
        <!-- <a class="btn btn-secondary" href="<?php echo FRONT_ROOT ?>Usuario/ShowListView" role="button">Volver a lista de usuarios</a>
        <br> 
        <br>   -->
        <table class="table table-sm table-dark">
            <thead >       
                <tr>
                <!-- <th scope="col" style="text-align:left">
                    <a class="btn btn-warning" onclick = "if(borrarUsuario('<?php echo $usuario->getNombre(); ?>')) href='<?php echo FRONT_ROOT ?>Usuario/eliminarUsuarioYredirect/<?php echo $usuario->getNombre(); ?>' ;">Eliminar Usuario</a>
                </th> -->
                <th scope="col" style="text-align:center" >
                    <h1 class="display-2"><?php echo $usuario->getApellido().", ".$usuario->getNombre(); ?></h1>
                </th>
                <th scope="col" style="text-align:right">
                    <a class="btn btn-info" href="<?php echo FRONT_ROOT ?>Usuario/ShowModificarUsuario/<?php echo $usuario->getEmail();?>">Modificar perfil</a>
                </th>
                </tr>
            </thead>
        </table>
        <table class="table table-striped table-dark">
        <tbody style="text-align:center" >
            <tr>
                <th scope="row">Email</th>
                <td><?php echo $usuario->getEmail(); ?></td>
            </tr>
            <tr>
                <th scope="row">Nombre, Apellido</th>
                <td><?php echo $usuario->getNombre().", ".$usuario->getApellido(); ?></td>
            </tr>
            <tr>
                <th scope="row">DNI</th>
                <td><?php echo $usuario->getDni(); ?></td>
            </tr>
        </tbody>
        
    </div>
</div>