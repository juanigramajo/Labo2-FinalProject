<?php

    session_start();

    $ruta = '../css';

    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {

        $id = $_GET['id'];

        $time = time() + 60 * 24 * 60 * 60;


        unset($_COOKIE[$_SESSION['user']]);

        setcookie($_SESSION['user'], $id, $time, '/');

        header('refresh:0; pelicula_listado.php');

    } else {
        echo '<p class="textUsuaroNoAurizado">Usuario no autorizado</p>';
        header('refresh:3; ../index.php');
    }
?>