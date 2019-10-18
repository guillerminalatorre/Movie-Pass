<?php

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
<div class="container mb-4">
    <div class="row">
        <div class="col-sm bg-light rounded p-4 text-center mr-4">     
            <a href="#aboutModal" data-toggle="modal" data-target="#myModal"><img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRbezqZpEuwGSvitKy3wrwnth5kysKdRqBW54cAszm_wiutku3R" name="aboutme" width="140" height="140" class="img-circle"></a>
            <h3 class="mt-2"><?php echo $usuario->getNombre().", ".$usuario->getApellido(); ?></h3>
            <a href="<?php echo FRONT_ROOT ?>Usuario/ShowModificarUsuario/<?php echo $usuario->getEmail();?>" class="btn btn-warning btn-md mt-2" role="button">Modificar perfil</a>

            <ul class="list-group mt-4">
                <li class="list-group-item">Email: <?php echo $usuario->getEmail(); ?></li>
                <li class="list-group-item">Nombre: <?php echo $usuario->getNombre().", ".$usuario->getApellido(); ?></li>
                <li class="list-group-item">DNI: <?php echo $usuario->getDni(); ?></li>
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