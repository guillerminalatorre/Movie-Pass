<ul class="navbar-nav ml-auto nav-flex-icons">
    <li class="nav-item avatar dropdown">
        <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo $_SESSION["loggedUser"]->getNombre() . " " . $_SESSION["loggedUser"]->getApellido(); ?><img src="<?php echo $_SESSION["loggedUser"]->getImage() ?>" height="30" class="rounded-circle z-depth-0 ml-2" alt="avatar image">
        </a>
        <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-5">
            <a class="dropdown-item waves-effect waves-light" href="<?php echo FRONT_ROOT ?>Usuario/ShowProfileView/<?php echo $_SESSION["loggedUser"]->getId(); ?>"><i class="fa fa-user"></i> Ver perfil</a>
            <a class="dropdown-item waves-effect waves-light" href="<?php echo FRONT_ROOT ?>Usuario/ShowEditView/<?php echo $_SESSION["loggedUser"]->getId(); ?>"><i class="fa fa-edit"></i> Modificar perfil</a>
            <a class="dropdown-item waves-effect waves-light" href="<?php echo FRONT_ROOT ?>Usuario/Logout"><i class="fa fa-sign-out-alt"></i> Cerrar sesión</a>
        </div>
    </li>
</ul>