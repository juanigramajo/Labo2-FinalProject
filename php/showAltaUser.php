<?php
    session_start();
    
    $ruta = '../css';
    
    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {


        echo '<article id="articleShowAltaUser">

                <p>ALTA EXITOSA<p>

                <p>Usuario cargado: <strong>'. $user. '</strong></p>
                <p>Email: <strong>'. $email. '</strong></p>
                
            ';

            if ( $newName == NULL) {
                echo '<img class="imgShowed" src="../img/usuarios/usuario_default.png" alt="'. $user. ' no tiene foto de perfil" title="'. $user. ' no tiene foto de perfil">';
            } else {
                echo '<img class="imgShowed" src="../img/usuarios/'. $newName. '" alt="Foto de perfil de '. $user. '" title="Foto de perfil de '. $user. '">';
            }

        echo    '</article>';

    } else {
        echo '<p class="textUsuaroNoAurizado">Usuario no autorizado</p>';
        header('refresh:3; ../index.php');
    }

?>