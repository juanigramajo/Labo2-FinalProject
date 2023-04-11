<?php
    
    $ruta = '../css';
    
    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {

?>


    <section id="sectionUserMenu">
        <?php

            if ( (empty($_SESSION['foto'])) || $_SESSION['foto'] == 'NULL') {
                echo '<img id="imgUserMenu" src="../img/usuarios/usuario_default.png" alt="'. $_SESSION['user']. ' no tiene foto de perfil" title="'. $_SESSION['user']. ' no tiene foto de perfil">';
            } else {
                echo '<img id="imgUserMenu" src="../img/usuarios/'. $_SESSION['foto']. '" alt="Foto de perfil de '. $_SESSION['user']. '" title="Foto de perfil de '. $_SESSION['user']. '">';
            }

            echo $_SESSION['user'];
            echo '<p id="barrita"> | </p>';
            echo '<a id="cerrarSesionButton" href="login_close.php">Cerrar Sesión</a>';      
        ?>
    </section>

    <hr id="hrMenu">

    <p class="pMenu">
        Usuarios
    </p>

    <?php
        if ($_SESSION['tipo'] == 'Administrador') {
            echo '<a class="aMenu" href="usuario_alta.php" alt="Nuevo usuario" title="Nuevo usuario">Nuevo usuario</a>';
        }
    ?>

    <a class="aMenu LastMiddleAMenu" href="../php/usuario_listado.php" alt="Listado usuarios" title="Listado usuarios">Listado usuarios</a>



    <p class="pMenu">
        Películas
    </p>

    <?php
        if ($_SESSION['tipo'] == 'Administrador') {
            echo '<a class="aMenu" href="../php/pelicula_alta.php" alt="Agregar película" title="Agregar película">Agregar película</a>';
        }
    ?>

    <a class="aMenu" href="../php/pelicula_listado.php" alt="Listar películas" title="Listar películas">Listar películas</a>
    <a class="aMenu LastMiddleAMenu" href="../php/peliculas_favoritas.php" alt="Listar películas" title="Listar películas">Listar favoritas</a>



    <p class="pMenu">
        Contáctenos
    </p>

    <a class="aMenu LastMiddleAMenu" href="../php/contactenos.php" alt="Contáctenos" title="Contáctenos">Contáctenos</a>



    <p class="pMenu">
        Opciones
    </p>

    <a class="aMenu" id="lastAMenu" href="../php/configuracion.php" alt="Configuración" title="Configuración">Configuración</a>


    
<?php
    } else {
        echo '<p class="textUsuaroNoAurizado">Usuario no autorizado</p>';
        header('refresh:3; ../index.php');
    }
?>
