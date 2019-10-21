function borrarCine(nombreCine)
{
    preg = window.confirm('¿Desea borrar el cine'+ nombreCine +'?');
    if(preg==true) 
    {
        alert('Se ha borrado el cine '+ nombreCine);
    }
    return preg;
}

function borrarFuncion(id)
{
    preg = window.confirm('¿Desea borrar la funcion?');
    if(preg==true) 
    {
        alert('Se ha borrado la funcion '+ id);
    }
    return preg;
}

function verificacion()
{
    alert('La función se ha agregado satisfactoriamente');
}

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

