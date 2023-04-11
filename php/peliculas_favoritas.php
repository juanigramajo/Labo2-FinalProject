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


        <main id="mainPeliculasFavoritas">
            <form id="formBuscador" action="" method="get">
                <input id="inputSearch" type="search" name="buscador" placeholder="Buscar pelicula...">
                <input id="inputSubmitSearch" type="submit" value="Buscar">
                <a id="inputCleanSearch" href="peliculas_favoritas.php">Limpiar busqueda</a>
            </form>

            <?php

                if (!empty($_GET['buscador'])) {
                    $sql = 'SELECT * FROM pelicula WHERE titulo LIKE \'%'. $_GET['buscador']. '%\'';
                } else {
                    $sql = 'SELECT * FROM pelicula';
                }

                require_once('conection.php');

                if (!empty($_COOKIE[$_SESSION['user']]) && isset($_COOKIE[$_SESSION['user']])) {
                
                    $prefe = explode(',', $_COOKIE[$_SESSION['user']]);

                    
                    $sql = 'SELECT * FROM pelicula WHERE ';

                    $conection = connect();

                    foreach ($prefe as $key => $value) {
                        $sql .= 'id=\''. $value. '\' OR ';
                    }
                    
                    $sql = rtrim($sql, 'OR ');


                    $result = mysqli_query($conection, $sql);
                
                    if ($result){
                        if (mysqli_num_rows($result)) {
                            
                                while ($fila = mysqli_fetch_array($result)) {
                                    
                                    echo '<article id="articleListado">';
                                            
                                            if (empty($fila['foto_portada'])) {
                                                echo '<img class="imgPeliculaListado" src="../img/sin_imagen.png" alt="Película sin portada" title="Película sin portada">';
                                            } else {
                                                echo '<img class="imgPeliculaListado" src="../img/portadas/'. $fila['foto_portada']. '" alt="Portada de la película '. $fila['titulo']. '" title="Portada de la película '. $fila['titulo']. '">';
                                            }
                                            
                                    echo    '<section id="sectionDatosArticle">
                                                <h3>'. $fila['titulo']. '</h3>
                                                
                                                <p>Genero: '. $fila['genero']. '</p>
                                                <p>Fecha de estreno: '. $fila['fecha_estreno']. '</p>
                                                <p>Duración: '. $fila['duracion']. ' minutos</p>
                                            </section>
                                            
                                        </article>'; 
                                }

                                echo '<a class="aMenu" href="peliculas_favoritas_delete.php">Eliminar de favoritas TODAS las películas</a>';

                        } else {
                            echo '<hr>';
                            echo '<p>No se encontraron resultados</p>';
                        }
                        
                    } else {
                        echo '<p>Error en la consulta</p>';
                    }
                
                disconnect($conection);
            ?>
        </main>
    </section>



    
<?php
    } else {
        echo '<main id="mainPeliculasFavoritas">';
        echo '<p id="textNoFav">No tienes películas favoritas</p>';
        echo '<a class="aMenu" href="pelicula_listado.php">Ver películas disponibles</a>';
        echo '</main>';
    }

    require_once('../html/footer.html');

    echo '</body>';

    } else {
        echo '<p class="textUsuaroNoAurizado">Usuario no autorizado</p>';
        header('refresh:3; ../index.php');
    }
?>
