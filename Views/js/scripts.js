function borrarCine(nombreCine)
{
    preg = window.confirm('¿Desea borrar el cine'+ nombreCine +'?');
    if(preg == true) 
    {
        alert('Se ha borrado el cine '+ nombreCine);
    }
    return preg;
}

function borrarFuncion(id)
{
    preg = window.confirm('¿Desea borrar la funcion ID:'+ id +'?');
    if(preg == true) 
    {
        alert('Se ha borrado la funcion '+ id);
    }
    return preg;
}

function borrarUsuario(nombreUsuario)
{
    preg = window.confirm('¿Desea borrar el usuario'+ nombreUsuario +'?');
    if(preg == true) 
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

function API()
{
    var preg;
    preg = window.confirm('¿Desea conectar a TMDB para obtener datos de la API?');
    
    if(preg == true) 
    {
        alert('Obteniendo datos de la API.');
    }
    return preg;
}