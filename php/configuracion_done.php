<?php

    session_start();

    $ruta = '../css';
    require_once("../html/head.html");
    echo '<body>';

    $time = time() + 60 * 24 * 60 * 60;

    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {

?>

    <section id="sectionPeliculaListado">

        <section id="sectionNavBoton">
            <nav id="navPeliculaListado">

                <?php
                    require_once('menu.php');
                ?>

            </nav>
        </section>

        <?php

            $valor = $_POST['selecciono'];

            if (!empty($_COOKIE['estilo_'. $_SESSION['id']]) && isset($_COOKIE['estilo_'. $_SESSION['id']])) {
                
                setcookie('estilo_'. $_SESSION['id'], $valor, $time, '/');

                echo '<main id="mainPeliculaListado">
                    
                        <p id="pConfig">Cambiando estilo...</p>';
                    
                        header('refresh:1; configuracion.php');

                echo '</main>';
                
            } else {
            
                setcookie('estilo_'. $_SESSION['id'], $valor, $time, '/');

            }

        ?>

</section>

<?php
    require_once('../html/footer.html');

    echo '</body>';

    } else {
        echo '<p class="textUsuaroNoAurizado">Usuario no autorizado</p>';
        header('refresh:3; ../index.php');
    }
?>