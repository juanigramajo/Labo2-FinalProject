

<?php
    session_start();
    
    $ruta = '../css';
    
    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {

        echo '<p>Usuario: '. $_SESSION['user']. '</p>';        
        
        echo '<img src="../img/usuarios/'. $_SESSION['foto']. '" alt="Foto de perfil de '. $_SESSION['user']. '" title="Foto de perfil de '. $_SESSION['user']. '">';

    } else {
        echo '<p class="textUsuaroNoAurizado">Usuario no autorizado</p>';
        header('refresh:3; ../index.php');
    }
?>