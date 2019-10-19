<script>
    function borrarUsuario(nombreUsuario)
    {
        preg = window.confirm('¿Desea borrar el usuario'+ nombreUsuario +'?');
        if(preg==true) 
        {
            alert('Se ha borrado el usuario '+ nombreUsuario);
        }
        return preg;
    }

    function toggleAdmin(nombreUsuario, rolActual)
    {
        var preg;
        preg = window.confirm('¿Desea dar/quitar administrador a '+ nombreUsuario +'?');
        
        if(preg == true) 
        {
            alert('Se ha cambiado el acceso de '+ nombreUsuario);
        }
        return preg;
    }
</script>

<div class="container mb-4">
    <div class="row">
        <div class="col-sm bg-light rounded p-4 text-center mr-4">

            <!-- Volver a lista de usuarios solo para admins -->
            <?php if($_SESSION["loggedUser"]->getId_Rol() === 2 || $_SESSION["loggedUser"]->getId_Rol() === 3) { ?>
            <a class="btn btn-secondary mb-4" href="<?php echo FRONT_ROOT ?>Home/ListUsers" role="button">Ver lista de usuarios</a>
            <?php } ?>

            <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRbezqZpEuwGSvitKy3wrwnth5kysKdRqBW54cAszm_wiutku3R" width="140" height="140" class="rounded-circle z-depth-0" alt="avatar image">
            <h3 class="mt-2"><?php echo $usuario->getNombre()." ".$usuario->getApellido(); ?></h3>

            <!-- Dar/Quitar admin: Solo si es main admin y no es su propia cuenta -->
            <?php if(($_SESSION["loggedUser"]->getId_Rol() === 3) && ($_SESSION["loggedUser"]->getEmail() != $usuario->getEmail())) { ?>
            <a onclick = "if(toggleAdmin('<?php echo $usuario->getNombre(); ?> <?php echo $usuario->getApellido(); ?>', <?php $usuario->getId_Rol(); ?>)) href='<?php echo FRONT_ROOT ?>Usuario/toggleAdmin/<?php echo $usuario->getEmail(); ?>' ;" class="btn btn-info btn-md mt-2" role="button">
                <?php if($usuario->getId_Rol() === 1) { ?>Hacer admin<?php } else { ?>Quitar admin<?php } ?>
            </a>
            <?php } ?>
            
            <!-- Modificar perfil -->
            <a href="<?php echo FRONT_ROOT ?>Home/EditProfile/<?php echo $usuario->getEmail();?>" class="btn btn-warning btn-md mt-2" role="button">Modificar</a>
            
            <!-- Eliminar cuenta -->
            <?php if(($_SESSION["loggedUser"]->getId_Rol() === 2 || $_SESSION["loggedUser"]->getId_Rol() === 3 || $_SESSION["loggedUser"]->getEmail() === $email) && ($_SESSION["loggedUser"]->getId_Rol() === 3 && $_SESSION["loggedUser"]->getEmail() != $usuario->getEmail()) && ($usuario->getId_Rol() != 3)) { ?>
            <a onclick = "if(borrarUsuario('<?php echo $usuario->getNombre(); ?> <?php echo $usuario->getApellido(); ?>')) href='<?php echo FRONT_ROOT ?>Usuario/eliminarUsuario/<?php echo $usuario->getEmail(); ?>' ;" class="btn btn-danger btn-md mt-2" role="button">Eliminar</a>
            <?php } ?>

            <ul class="list-group mt-4">
                <li class="list-group-item">Email: <?php echo $usuario->getEmail(); ?></li>
                <li class="list-group-item">Nombre: <?php echo $usuario->getNombre().", ".$usuario->getApellido(); ?></li>
                <li class="list-group-item">DNI: <?php echo $usuario->getDni(); ?></li>
                <li class="list-group-item">Registro: 
                <?php $date = $usuario->getRegisterDate();
                $registerDate = date("d/m/Y H:i",$date);
                echo $registerDate; ?>
                </li>
            </ul>
        </div>
        <div class="col-md-8 bg-light rounded p-4">
            <tr><h4 class="border-bottom border-gray pb-2 mb-0">Lista de entradas</h4></tr>
            <table class="table table-striped">
                <thead>
                    
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pelicula</th>
                    <th scope="col">Cine</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td>@mdo</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>