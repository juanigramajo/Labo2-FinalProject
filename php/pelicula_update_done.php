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
            if (!empty($_POST['btnActualizar'])) {

                include('conection.php');
                $conection = connect();
                $id = $_POST['id'];

                if ($conection && !empty($_POST['id'])){

                    if (!empty($_POST['titulo'])) {
                        $sql = 'SELECT * FROM pelicula';

                        $conection = connect();
                        $result = mysqli_query($conection, $sql);

                        if ($result){
                            if (mysqli_num_rows($result)) {

                                $fila = mysqli_fetch_array($result);
                    
                                if ($_POST['titulo'] == $fila['titulo'] && $_POST['id'] != $fila['id']) {
                                    echo '<p class="pPeliculaAltaProcess">Ya existe una película con este título</p>';
                                    header('refresh:3; url=pelicula_update.php?id='. $_POST['id']. '');
                                    die();
                
                                } else {

                                    $titulo = $_POST['titulo'];

                                    $sqlTitle = 'SELECT * FROM pelicula WHERE id = \''. $id. '\'';
                                    $resultTitle = mysqli_query ($conection, $sqlTitle);

                                    if (mysqli_num_rows($resultTitle)) {

                                        $filaTitle = mysqli_fetch_assoc($resultTitle);

                                        $tituloViejo = $filaTitle['foto_portada'];

                                        $arreglo_tituloViejo = explode('.', $tituloViejo);
                                        $extTituloViejo = $arreglo_tituloViejo[count($arreglo_tituloViejo) - 1];
                                        
                                        $tituloNuevo = $titulo. '.'. $extTituloViejo;

                                        if (!empty($_FILES['portada']['size'])) {
                                            if (unlink('../img/portadas/'. $tituloViejo)) {
                                                /* echo 'fine'; */
                                            } else {
                                                /* echo 'wrong'; */
                                            }
                                        }

                                        if (rename("../img/portadas/$tituloViejo", "../img/portadas/$tituloNuevo")) {
                                            /* echo 'fine'; */
                                        } else {
                                            /* echo 'wrong'; */
                                        }


                                        $sqlFoto = 'UPDATE pelicula SET foto_portada = \''. $tituloNuevo. '\' WHERE id = '. $id;

                                        $resultFoto = mysqli_query($conection, $sqlFoto);
                                        
                                        if ($resultFoto) {
                                            /* echo '<p class="pPeliculaAltaProcess">Se modificó correctamente la imagen</p>';
                                            header("refresh:3; url=pelicula_listado.php"); */
                                            
                                        } else {
                                            /* echo '<p class="pPeliculaAltaProcess">No se pudo modificar la imagen</p>';
                                            header("refresh:3; url=pelicula_listado.php"); */
                                        }
                                    }
                                }

                            } else {
                                echo '<hr>';
                                echo '<p>No se encontraron resultados</p>';
                                header('refresh:3; url=../index.php');
                            }
                        } else {
                            echo '<p>Error en la consulta</p>';
                        }
                            
                    } else {
                        echo '<p class="pPeliculaAltaProcess">Falta el título de la película</p>';
                        header('refresh:3; url=pelicula_alta.php');
                    }

                    if (!empty($_POST['duracion'])) {
                        $duracion = $_POST['duracion'];
                    } else {
                        echo '<p class="pPeliculaAltaProcess">Falta la duración de la película</p>';
                        header('refresh:3; url=pelicula_alta.php');
                    }

                    if (!empty($_POST['genero'])) {
                        $genero = $_POST['genero'];
                    } else {
                        echo '<p class="pPeliculaAltaProcess">Falta el género de la película</p>';
                        header('refresh:3; url=pelicula_alta.php');
                    }

                    if (!empty($_POST['estreno'])) {
                        $estreno = $_POST['estreno'];
                    } else {
                        echo '<p class="pPeliculaAltaProcess">Falta la fecha del estreno</p>';
                        header('refresh:3; url=pelicula_alta.php');
                    }

                    $elige = $_POST['elimina'];

                    if ($elige == 'si') {
                        unlink('../img/portadas/'. $filaTitle['foto_portada']);

                        $null = '';

                        $sqlDeleteFoto = 'UPDATE pelicula SET foto_portada = \''. $null. '\' WHERE id = '. $id;

                        $resultDeleteFoto = mysqli_query($conection, $sqlDeleteFoto);
                        
                        if ($resultDeleteFoto) {
                            /* echo '<p class="pPeliculaAltaProcess">Se modificó correctamente la imagen</p>';
                            header("refresh:3; url=pelicula_listado.php"); */
                            
                        } else {
                            /* echo '<p class="pPeliculaAltaProcess">No se pudo modificar la imagen</p>';
                            header("refresh:3; url=pelicula_listado.php"); */
                        }
                    }

                    if (!empty($_FILES['portada']['size'])) {
                        
                        $nombre = $_FILES['portada']['name'];
                        $arreglo_nombre = explode('.', $nombre);
                        $ext = $arreglo_nombre[count($arreglo_nombre) - 1];
                        
                        $rutaOrigen = $_FILES['portada']['tmp_name'];
                        
                        $destino = '../img/portadas/';
                        
                        if (!file_exists($destino)) {
                            mkdir($destino);
                        }

                        unlink('../img/portadas/'. $filaTitle['foto_portada']);

                        require_once ('newName.php');
                        $newName = nuevoNombre($titulo, $ext);
                        
                        $destino = '../img/portadas/'. $newName;
                        
                        $envio = move_uploaded_file($rutaOrigen, $destino);

                        
                        $sqlFoto = 'UPDATE pelicula SET foto_portada = \''. $newName. '\' WHERE id = '. $id;

                        $resultFoto = mysqli_query($conection, $sqlFoto);

                        if ($resultFoto) {
                            echo '<p class="pPeliculaAltaProcess">Se modificó correctamente la imagen</p>';
                            header("refresh:3; url=pelicula_listado.php");
                            
                        } else {
                            echo '<p class="pPeliculaAltaProcess">No se pudo modificar la imagen</p>';
                            header("refresh:3; url=pelicula_listado.php");
                        }
                    }

                    $sql = 'UPDATE pelicula
                            SET titulo = \''. $titulo. '\',
                            duracion = \''. $duracion. '\',
                            genero = \''. $genero. '\',
                            fecha_estreno = \''. $estreno. '\'
                            WHERE id = '. $id ;

                    $result = mysqli_query($conection, $sql);

                    echo '<main id="mainPeliculaUpdate">';
                    
                    if ($result) {
                        echo '<p class="pPeliculaAltaProcess">Se modificó correctamente el registro</p>';
                        header("refresh:3; url=pelicula_listado.php");
                        
                    } else {
                        echo '<p class="pPeliculaAltaProcess">No se pudo modificar el registro</p>';
                        header("refresh:3; url=pelicula_listado.php");
                    }
                    
                    echo '</main>';
                    
                } else {
                    echo '<p class="pPeliculaAltaProcess">Datos faltantes o error en la conexión</p>';
                    header("refresh:3; url=pelicula_listado.php");
                }
                
                disconnect($conection);

            } elseif (!empty($_POST['btnCancelar'])) {
                header('refresh:3; url=pelicula_listado.php');
            }

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
