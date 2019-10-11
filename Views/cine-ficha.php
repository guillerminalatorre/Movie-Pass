<div class="container container-fluid mt-4">
    <h2>FICHA DE CINE</h2>
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col"><?php $cine->getNombre(); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th scope="row">ID</th>
        <td><?php $cine->getId(); ?></td>
        </tr>
        <tr>
        <th scope="row">Dirección</th>
        <td><?php $cine->getDireccion(); ?></td>
        </tr>
        <tr>
        <th scope="row">Capacidad</th>
        <td><?php $cine->getCapacidad(); ?></td>
        </tr>
        <tr>
        <th scope="row">Precio</th>
        <td>$<?php $cine->getPrecio(); ?></td>
        </tr>
    </tbody>
</table>
</div>