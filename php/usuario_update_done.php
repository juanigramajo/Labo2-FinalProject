<?php
    session_start();
    
    $ruta = '../css';
    require_once("../html/head.html");
    echo '<body>';
    
    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {
        if ( $_SESSION['tipo'] == 'Administrador' ) {
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

                    if (!empty($_POST['user'])) {
                        $sql = 'SELECT * FROM usuario';

                        $conection = connect();
                        $result = mysqli_query($conection, $sql);

                        if ($result){
                            if (mysqli_num_rows($result)) {

                                $fila = mysqli_fetch_array($result);

                                if ($_POST['user'] == $fila['usuario'] && $_POST['id'] != $fila['id']) {
                                    echo '<p class="pPeliculaAltaProcess">Ya existe un usuario con ese nombre</p>';
                                    header('refresh:3; url=usuario_update.php?id='. $_POST['id']. '');
                                    die();
                
                                } else {

                                    $usuario = $_POST['user'];

                                    $sqlUser = 'SELECT * FROM usuario WHERE id = \''. $id. '\'';
                                    $resultUser = mysqli_query ($conection, $sqlUser);

                                    if (mysqli_num_rows($resultUser)) {

                                        $filaUser = mysqli_fetch_assoc($resultUser);

                                        if ($_SESSION['user'] == $filaUser['usuario']) {
                                            $_SESSION['user'] = $_POST['user'];
                                        }

                                        $userViejo = $filaUser['foto'];

                                        $arreglo_userViejo = explode('.', $userViejo);
                                        $extUserViejo = $arreglo_userViejo[count($arreglo_userViejo) - 1];
                                        
                                        $userNuevo = $usuario. '.'. $extUserViejo;

                                        if (!empty($_FILES['fotoPerfil']['size'])) {
                                            if (unlink('../img/usuarios/'. $userViejo)) {
                                                /* echo 'fine'; */
                                            } else {
                                                /* echo 'wrong'; */
                                            }
                                        }

                                        if (rename("../img/usuarios/$userViejo", "../img/usuarios/$userNuevo")) {
                                            /* echo 'fine'; */
                                        } else {
                                            /* echo 'wrong'; */
                                        }


                                        $sqlFoto = 'UPDATE usuario SET foto = \''. $userNuevo. '\' WHERE id = '. $id;

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
                        echo '<p class="pPeliculaAltaProcess">Falta el nombre de usuario</p>';
                        header('refresh:3; url=pelicula_alta.php');
                    }

                    if (!empty($_POST['password'])) {
                        $password = sha1($_POST['password']);
                    } else {
                        $password = $_POST['oldPassword'];
                    }

                    if (!empty($_POST['email'])) {
                        $sql = 'SELECT * FROM usuario';

                        $conection = connect();
                        $result = mysqli_query($conection, $sql);

                        if ($result){
                            if (mysqli_num_rows($result)) {

                                while ($fila = mysqli_fetch_array($result)) {
                                    if ($_POST['email'] == $fila['mail'] && $_POST['id'] != $fila['id']) {
                                        echo '<p class="pPeliculaAltaProcess">Ya existe un usuario con ese mail</p>';
                                        header('refresh:3; url=usuario_update.php?id='. $_POST['id']. '');
                                        die();
                    
                                    } else {
                                        $email = $_POST['email'];
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
                        echo '<p class="pPeliculaAltaProcess">Falta el email del usuario</p>';
                        header('refresh:3; url=usuario_alta.php');
                    }
        
                    if (!empty($_POST['fechaAlta'])) {
                        $fechaAlta = $_POST['fechaAlta'];
                    } else {
                        echo '<p class="pPeliculaAltaProcess">Falta la fecha del alta del usuario/p>';
                        header('refresh:3; url=usuario_alta.php');
                    }
        
                    if (!empty($_POST['tipo'])) {
                        $tipo = $_POST['tipo'];
                    } else {
                        echo '<p class="pPeliculaAltaProcess">Falta el tipo de usuario</p>';
                        header('refresh:3; url=usuario_alta.php');
                    }

                    $elige = $_POST['elimina'];

                    if ($elige == 'si') {
                        unlink('../img/usuarios/'. $filaUser['foto']);

                        $null = '';

                        $sqlDeleteFoto = 'UPDATE usuario SET foto = \''. $null. '\' WHERE id = '. $id;

                        $resultDeleteFoto = mysqli_query($conection, $sqlDeleteFoto);
                        
                        if ($resultDeleteFoto) {
                            /* echo '<p class="pPeliculaAltaProcess">Se modificó correctamente la imagen</p>'; */

                            if ($_SESSION['foto'] == $filaUser['foto']) {
                                $_SESSION['foto'] = $null;
                            }
                            header("refresh:3; url=pelicula_listado.php");
                        } else {
                            /* echo '<p class="pPeliculaAltaProcess">No se pudo modificar la imagen</p>'; */
                            header("refresh:3; url=pelicula_listado.php");
                        }
                        
                    }

                    if (!empty($_FILES['fotoPerfil']['size'])) {
                        
                        $nombre = $_FILES['fotoPerfil']['name'];
                        $arreglo_nombre = explode('.', $nombre);
                        $ext = $arreglo_nombre[count($arreglo_nombre) - 1];
                        
                        $rutaOrigen = $_FILES['fotoPerfil']['tmp_name'];
                        
                        $destino = '../img/usuarios/';
                        
                        if (!file_exists($destino)) {
                            mkdir($destino);
                        }

                        unlink('../img/usuarios/'. $filaUser['foto']);

                        require_once ('newName.php');
                        $newName = nuevoNombre($usuario, $ext);
                        
                        $destino = '../img/usuarios/'. $newName;
                        
                        $envio = move_uploaded_file($rutaOrigen, $destino);

                        
                        $sqlFoto = 'UPDATE usuario SET foto = \''. $newName. '\' WHERE id = '. $id;

                        $resultFoto = mysqli_query($conection, $sqlFoto);

                        if ($resultFoto) {
                            /* echo '<p class="pPeliculaAltaProcess">Se modificó correctamente la imagen</p>'; */
                            if ($_SESSION['foto'] == $filaUser['foto']) {
                                $_SESSION['foto'] = $newName;
                            }
                            header("refresh:3; url=pelicula_listado.php");
                            
                        } else {
                            /* echo '<p class="pPeliculaAltaProcess">No se pudo modificar la imagen</p>'; */
                            header("refresh:3; url=pelicula_listado.php");
                        }

                    }


                    $sql = 'UPDATE usuario
                            SET usuario = \''. $usuario. '\',
                            password = \''. $password. '\',
                            mail = \''. $email. '\',
                            fecha_alta = \''. $fechaAlta. '\',
                            tipo = \''. $tipo. '\'
                            WHERE id = '. $id ;

                    $result = mysqli_query($conection, $sql);

                    echo '<main id="mainPeliculaUpdate">';
                    
                    if ($result) {
                        echo '<p class="pPeliculaAltaProcess">Se modificó correctamente el registro</p>';
                        header("refresh:3; url=usuario_listado.php");
                        
                    } else {
                        echo '<p class="pPeliculaAltaProcess">No se pudo modificar el registro</p>';
                        header("refresh:3; url=usuario_listado.php");
                    }
                    
                    echo '</main>';
                    
                } else {
                    echo '<p class="pPeliculaAltaProcess">Datos faltantes o error en la conexión</p>';
                    header("refresh:3; url=usuario_listado.php");
                }
                
                disconnect($conection);

            } elseif (!empty($_POST['btnCancelar'])) {
                header('refresh:3; url=usuario_listado.php');
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
