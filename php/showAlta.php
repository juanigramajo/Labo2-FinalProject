<?php
    session_start();
    
    $ruta = '../css';
    
    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {


        echo '<article id="articleShowAlta">

                <p>ALTA EXITOSA<p>

                <p>Pelicula cargada: <strong>'. $titulo. '</strong></p>
                
            ';

            if ($newName != NULL ) {
                echo '<img class="imgShowed" src="../img/portadas/'. $newName. '" alt="Portada de la película '. $titulo. '" title="Portada de la película '. $titulo. '">';
            } else {
                echo '<img class="imgShowed" src="../img/sin_imagen.png" alt="Película sin portada" title="Película sin portada">';
            }

        echo    '</article>';

    } else {
        echo '<p class="textUsuaroNoAurizado">Usuario no autorizado</p>';
        header('refresh:3; ../index.php');
    }

?>