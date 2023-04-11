<?php
    session_start();
    
    $ruta = '../css';
    
    echo '<body>';

    echo '<main>';

    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {
    
        if (!empty($_SESSION['user'])) {
            session_destroy();

            header('refresh:0; ../index.php');
            
        } else {
            echo '<p>Error al cerrar sesión</p>';
        }
        
    } else {
        echo '<p class="textUsuaroNoAurizado">Usuario no autorizado</p>';
        header('refresh:3; ../index.php');
    }
    
    
    echo '</main>';
    
    require_once('../html/footer.html');

    echo '</body>';


?>
