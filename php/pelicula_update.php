<?php
    session_start();
    
    $ruta = '../css';
    require_once("../html/head.html");
    echo '<body>';
    
    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {
        if ( ($_SESSION['tipo'] == 'Administrador') || ($_SESSION['tipo'] == 'Editor') ) {
?>
    
    <section id="sectionPeliculaAlta">
               
        <nav id="navMenu">

            <?php
                require_once('menu.php');
            ?>
            
        </nav>

        <?php
            require_once('conection.php');
            $conection = connect();

            if ($conection && isset($_GET['id'])){

                $id = $_GET['id'];
                $sql = 'SELECT * FROM pelicula WHERE id = \''. $id. '\'';
                $result = mysqli_query ($conection, $sql);
        
                if (mysqli_num_rows($result) > 0) {

                    $fila = mysqli_fetch_assoc($result);

                    ?>
                    <main id="mainPeliculaUpdate">
                        <form id="formUpdate" action="pelicula_update_done.php" method="POST" enctype="multipart/form-data">
                            
                            <legend id="legendAlta">
                                <strong>
                                    Modificar película
                                </strong>
                            </legend>
                            <fieldset id="fieldsetAlta">

                                <label id="labelTextTitulo" for="titulo">Título</label>
                                <input class="inputsUpdate" type="text" value="<?php echo $fila['titulo']?>" id="titulo" name="titulo" placeholder="Título de la película" required>

                                <label class="labelText" for="duracion">Duración (en minutos)</label>
                                <input class="inputsUpdate" type="number" value="<?php echo $fila['duracion']?>" id="duracion" name="duracion" placeholder="Duración de la película (en minutos)" required>

                                <label class="labelText" for="genero">Género de la película:</label>
                                <select class="inputsUpdate" id="select" name="genero" id="genero" required>

                                    <?php
                                    switch ($fila['genero']) {
                                        case 'ninguna':
                                            ?>
                                            <option value="ninguna" selected>-- Seleccione el género --</option>
                                            <option value="Acción">Acción</option>
                                            <option value="Comedia">Comedia</option>
                                            <option value="Terror">Terror</option>
                                            <option value="Suspenso">Suspenso</option>
                                            <option value="Infantil">Infantil</option>
                                            <?php
                                            break;
                                        case 'Acción':
                                            ?>
                                            <option value="ninguna">-- Seleccione el género --</option>
                                            <option value="Acción" selected>Acción</option>
                                            <option value="Comedia">Comedia</option>
                                            <option value="Terror">Terror</option>
                                            <option value="Suspenso">Suspenso</option>
                                            <option value="Infantil">Infantil</option>
                                            <?php
                                            break;
                                        case 'Comedia':
                                            ?>
                                            <option value="ninguna">-- Seleccione el género --</option>
                                            <option value="Acción">Acción</option>
                                            <option value="Comedia" selected>Comedia</option>
                                            <option value="Terror">Terror</option>
                                            <option value="Suspenso">Suspenso</option>
                                            <option value="Infantil">Infantil</option>
                                            <?php
                                            break;
                                        case 'Terror':
                                            ?>
                                            <option value="ninguna">-- Seleccione el género --</option>
                                            <option value="Acción">Acción</option>
                                            <option value="Comedia">Comedia</option>
                                            <option value="Terror" selected>Terror</option>
                                            <option value="Suspenso">Suspenso</option>
                                            <option value="Infantil">Infantil</option>
                                            <?php
                                            break;
                                        case 'Suspenso':
                                            ?>
                                            <option value="ninguna">-- Seleccione el género --</option>
                                            <option value="Acción">Acción</option>
                                            <option value="Comedia">Comedia</option>
                                            <option value="Terror">Terror</option>
                                            <option value="Suspenso" selected>Suspenso</option>
                                            <option value="Infantil">Infantil</option>
                                            <?php
                                            break;
                                        case 'Infantil':
                                            ?>
                                            <option value="ninguna">-- Seleccione el género --</option>
                                            <option value="Acción">Acción</option>
                                            <option value="Comedia">Comedia</option>
                                            <option value="Terror">Terror</option>
                                            <option value="Suspenso">Suspenso</option>
                                            <option value="Infantil" selected>Infantil</option>
                                            <?php
                                            break;
                                    }
                                    ?>
                                </select>

                                <label class="labelText" for="estreno">Fecha de estreno: </label>
                                <input class="inputsUpdate" type="date" value="<?php echo $fila['fecha_estreno']?>" id="estreno" name="estreno" required>
                                
                                <fieldset id="fieldsetDeleteChoose">
                                    <p>¿Desea eliminar la foto de portada?</p>
                                    <fieldset id="fieldsetRadios">
                                        <label for="si">
                                            <input type="radio" id="si" name="elimina" value="si"> Si
                                        </label>
    
                                        <label for="no">
                                            <input type="radio" id="no" name="elimina" value="no" checked> No
                                        </label>
                                    </fieldset>
                                </fieldset>

                                <fieldset id="fieldsetImgChoose">
                                    <figure id="figureImgChoose">
                                        <p>Portada:</p>
                                        <?php
                                        if ($fila['foto_portada'] != NULL ) {
                                            echo '<img class="imgPortadaUpdate" src="../img/portadas/'. $fila['foto_portada']. '" alt="Portada de la película '. $fila['titulo']. '" title="Portada de la película '. $fila['titulo']. '">';
                                        } else {
                                            echo '<img class="imgPortadaUpdate" src="../img/sin_imagen.png" alt="Película sin portada" title="Película sin portada">';
                                        }?>
                                        <p>Si desea continuar sin actualizar la portada, presione el boton inferior "actualizar".</p>
                                    </figure>
                                </fieldset>
                                
                                <label class="labelText" for="portada">O bien, actualizar portada: </label>
                                <input class="inputsUpdate" type="file" accept="image/*" id="portada" name="portada">

                                <input type="hidden" value="<?php echo $id ?>" name="id">

                            </fieldset>

                            <fieldset id="fieldsetButtonsUpdate">
                                <input type="submit" class="buttonsPeliculaUpdate" name="btnActualizar" value="Actualizar">
                                <a class="buttonsPeliculaUpdate buttonCancelarUpdate" href="pelicula_listado.php">Cancelar</a>
                            </fieldset>

                        </form>
                    </main>
                    <?php
                }
                
                
            } else {
                echo '<p>No se pudo modificar el registro</p>';
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