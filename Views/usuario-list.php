<?php
require_once(VIEWS_PATH . "check-login-admin.php");
require_once(VIEWS_PATH."navbar.php");
?>

<div class="container container-fluid bg-dark rounded mt-4 my-3 p-3 shadow-sm">
    <h2 class="col-md-6 pb-2 text-light">Lista de usuarios</h2>
    <table class="table table-striped text-light align-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Mail</th>
                <th>IP</th>
                <th>Registro</th>
                <th>Ultima conexion</th>
                <th>Rol</th>
                <th>Ver</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarioList as $id=>$usuario) { ?>
            <tr>
                <td><?php echo $id+1; ?></td>
                <td><a href="" class="text-light"><img src="https://www.tutorialrepublic.com/examples/images/avatar/1.jpg" height="35" class="rounded-circle z-depth-0 mr-2" alt="avatar image"><b><?php echo $usuario->getNombre(); ?> <?php echo $usuario->getApellido(); ?></b></a></td>
                <td><?php echo $usuario->getEmail(); ?></td>
                <td><?php echo $usuario->getIp(); ?></td>
                <td>
                <?php 
                $date = $usuario->getRegisterDate();
                $registerDate = date("d/m/Y H:i",$date);
                echo $registerDate; 
                ?>
                </td>
                <td>
                <?php 
                $date = $usuario->getLastConnection();
                $lastConnection = date("d/m/Y H:i",$date);
                echo $lastConnection;
                if($usuario->getLoggedIn() == TRUE) { ?>
                    <span class="status text-success">•</span>
                <?php 
                } else { 
                ?>
                    <span class="status text-danger">•</span>
                <?php } ?>
                </td>
                <td>
                <?php 
                    echo $this->getUserRol($usuario->getId_Rol());
                ?>
                </td>
                <td><a href="<?php echo FRONT_ROOT ?>Usuario/ShowProfileView/<?php echo $usuario->getEmail(); ?>" class="view" title="" data-toggle="tooltip" data-original-title="View Details"><h4><i class="fas fa-arrow-circle-right"></i></h4></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>