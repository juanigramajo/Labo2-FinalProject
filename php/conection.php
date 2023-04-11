
<?php

function connect(){
    $user = 'root';
    $password = '';
    $db = 'peliculas';

    $conection = mysqli_connect($server, $user, $password, $db); //me dí cuenta que no es necesario declarar un servidor, me lo toma por defecto

    if (!$conection) {
        echo '<p class="pError">Error de conexión a la DB </p>';
    } else {
        return($conection);
    }
}


function disconnect($conection){

    if ($conection) {
        
        $disconnect = mysqli_close($conection);

        if (!$disconnect) {
            echo '<p class="pError">Error al desconectar</p>';
        }
    } else {
        echo '<p class="pError">Conexión inexistente para desconectar</p>';
    }
}

?>