<?php

    session_start();

    $ruta = '../css';
    require_once("../html/head.html");
    echo '<body>';

    $id = $_GET['id'];

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

            if (!empty($_COOKIE[$_SESSION['user']]) && isset($_COOKIE[$_SESSION['user']])) {
                
                setcookie($_SESSION['user'], $_COOKIE[$_SESSION['user']]. ', '. $id, $time, '/');

                echo '<main id="mainPeliculaListado">';
                
                    echo '<article id="articlePeliculasFavDone">
                            
                            <p id="textPeliculasFavDone">Agregando película como favorita...</p>
                        
                        </article>';

                    header('refresh:1; pelicula_listado.php');

                echo '</main>';
                
            } else {
            
                setcookie($_SESSION['user'], $id, $time, '/');

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