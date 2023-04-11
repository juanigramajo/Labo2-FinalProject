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

        <main id="mainPeliculaListado">

            <form id="formBuscador" action="" method="get">
                <input id="inputSearch" type="search" name="buscador" placeholder="Buscar pelicula...">
                <input id="inputSubmitSearch" type="submit" value="Buscar">
                <a id="inputCleanSearch" href="pelicula_listado.php">Limpiar busqueda</a>
            </form>

            <?php

                if (!empty($_GET['buscador'])) {
                    $sql = 'SELECT * FROM pelicula WHERE titulo LIKE \'%'. $_GET['buscador']. '%\'';
                } else {
                    $sql = 'SELECT * FROM pelicula';
                }

                require_once('conection.php');
                $conection = connect();
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

                                                <figure>';

                                                    if ($_SESSION['tipo'] == 'Administrador' || $_SESSION['tipo'] == 'Editor') {
                                                        echo '<a href="pelicula_update.php?id='. $fila['id']. '" alt="Editar datos de la película" title="Editar datos de la película"> <img class="buttonsEditDelete" src="../img/edit_pencil.png"></a>';
                                                    }

                                                    if ($_SESSION['tipo'] == 'Administrador') {
                                                        echo '<a href="pelicula_delete.php?id='. $fila['id']. '" alt="Eliminar película" title="Eliminar película"><img class="buttonsEditDelete" src="../img/trash_empty.png"></a>';
                                                    }
                                                    
                                                    echo '<a href="peliculas_favoritas_done.php?id='. $fila['id']. '" alt="Marcar como películas favoritas" title="Marcar como películas favoritas"><img class="buttonsEditDelete" src="../img/estrella.png"></a>
                                                    
                                                </figure>

                                            </section>
                                            
                                        </article>'; 
                                }

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
    require_once('../html/footer.html');

    echo '</body>';

    } else {
        echo '<p class="textUsuaroNoAurizado">Usuario no autorizado</p>';
        header('refresh:3; ../index.php');
    }
?>
