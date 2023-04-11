<?php
    session_start();
    
    $ruta = '../css';
    require_once("../html/head.html");
    echo '<body>';
    
    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {
        if (($_SESSION['tipo'] == 'Administrador')) {
?>
    
    <section id="sectionPeliculaListado">

        <nav id="navPeliculaListado">

            <?php
                require_once('menu.php');
            ?>

        </nav>

        <?php
            require_once('conection.php');
            $conection = connect();

            if ($conection && !empty($_GET['id'])){

                $id = $_GET['id'];

                $sql = 'SELECT * FROM pelicula WHERE id = '. $id;
                $result = mysqli_query ($conection, $sql);
        
                if (mysqli_num_rows($result) > 0) {

                    $fila = mysqli_fetch_array($result);

                    echo '<main id="mainPeliculaDelete">

                            <h2>Eliminar película</h2>
                            <p id="pSureDelete">¿Está seguro de querer eliminar la pelicula <strong>'. $fila['titulo']. '</strong>?</p>
                                
                            <article id="articleListado">';
                                
                                if ($fila['foto_portada'] != NULL ) {
                                    echo '<img class="imgPeliculaListado" src="../img/portadas/'. $fila['foto_portada']. '" alt="Portada de la película '. $fila['titulo']. '" title="Portada de la película '. $fila['titulo']. '">';
                                } else {
                                    echo '<img class="imgPeliculaListado" src="../img/sin_imagen.png" alt="Película sin portada" title="Película sin portada">';
                                }
                                
                        echo    '<section id="sectionDatosArticle">
                                    <h3>'. $fila['titulo']. '</h3>
                                    
                                    <p>Genero: '. $fila['genero']. '</p>
                                    <p>Fecha de estreno: '. $fila['fecha_estreno']. '</p>
                                    <p>Duración: '. $fila['duracion']. ' minutos</p>
                                </section>
                                
                            </article> 
                            
                            <section id="sectionButtonsDelete">
                                <a class="buttonsPeliculaDelete" href="pelicula_delete_done.php?id='. $id. '" alt="Aceptar eliminar película" title="Aceptar eliminar película">Aceptar</a>
                                <a class="buttonsPeliculaDelete" href="pelicula_listado.php" alt="Cancelar" title="Cancelar">Cancelar</a>
                            </section>

                        </main>';
                }
                
                
            } else {
                echo '<p>No se puede eliminar el registro</p>';
                header('refresh:3; pelicula_listado.php');
            }

            disconnect($conection);
        ?>
    </section>



    
<?php
    require_once('../html/footer.html');

    echo '</body>';

        } else {
            echo '<p class="textUsuaroNoAurizado">Usuario no autorizado</p>';
            header('refresh:3; pelicula_listado.php');
        }

    } else {
        echo '<p class="textUsuaroNoAurizado">Usuario no autorizado</p>';
        header('refresh:3; ../index.php');
    }
?>
