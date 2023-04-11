<?php
    session_start();
    
    $ruta = '../css';
    require_once("../html/head.html");
    echo '<body>';
    
    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {

?>


    <section id="sectionPeliculaListado">

        <section id="sectionNavBoton">
            <nav id="navPeliculaListado">

                <?php
                    require_once('menu.php');
                ?>

            </nav>
            
            <section id="sectionButtonsPeliculaListado">
                <a class="buttonsPeliculaListado" href="#">Volver a arriba</a>
                <a class="buttonsPeliculaListado" href="center.php">Volver al menú principal</a>
            </section>
        </section>

        <?php

            echo '<main id="mainPeliculaListado">
                
                    <article id="articlePeliculasDelete">
                                
                        <h2 id="textPeliculasFavDone">¡ATENCIÓN!</h2>
                        <p id="textPeliculasFavDone">Esta a punto de eliminar todas las películas seleccionadas como favoritas</p>
                        <p id="textPeliculasFavDone">¿Desea continuar?</p>
                            
                        <a class="aMenu" href="peliculas_favoritas_delete_done.php">Continuar</a>
                        <a class="aMenu" href="peliculas_favoritas.php">Volver a favoritas</a>
                    </article>
                
                </main>';

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