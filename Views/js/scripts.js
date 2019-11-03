function borrarCine(nombreCine)
{
    var preg;
    preg = window.confirm('¿Desea borrar el cine'+ nombreCine +'?');
    return preg;
}

function borrarFuncion(id)
{
    var preg;
    preg = window.confirm('¿Desea borrar la funcion ID:'+ id +'?');
    return preg;
}

function borrarUsuario(nombreUsuario)
{
    var preg;
    preg = window.confirm('¿Desea borrar el usuario'+ nombreUsuario +'?');
    return preg;
}

function toggleAdmin(nombreUsuario, rolActual)
{
    var preg;
    preg = window.confirm('¿Desea dar/quitar administrador a '+ nombreUsuario +'?');
    return preg;
}

function API()
{
    var preg;
    preg = window.confirm('¿Desea conectar a TMDB para obtener datos de la API?');
    return preg;
}