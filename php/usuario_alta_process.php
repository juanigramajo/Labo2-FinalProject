<?php
    session_start();
    
    $ruta = '../css';
    require_once("../html/head.html");
    echo '<body>';
    
    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {
        if (($_SESSION['tipo'] == 'Administrador')) {

?>

    <section id="sectionAltaProcess">
        

        <?php
            include('conection.php');

            if (!empty($_POST['user'])) {

                $sql = 'SELECT * FROM usuario';

                $conection = connect();
                $result = mysqli_query($conection, $sql);

                if ($result){
                    if (mysqli_num_rows($result)) {
                        echo '<main id="mainPeliculaListado">';

                        while ($fila = mysqli_fetch_array($result)) {
                            if ($_POST['user'] == $fila['usuario']) {
                                echo '<p class="pPeliculaAltaProcess">Ya existe una usuario con este nombre</p>';
                                header('refresh:3; url=usuario_alta.php');
                                die();
            
                            } else {
                            $user = $_POST['user'];
                            }
                        }

                        echo '</main>';
                    } else if (mysqli_num_rows($result) == 0) {
                        $user = $_POST['user'];

                    } else {
                        echo '<hr>';
                        echo '<p>No se encontraron resultados</p>';
                        header('refresh:3; url=usuario_alta.php');
                    }
                } else {
                    echo '<p>Error en la consulta</p>';
                }
                    
            } else {
                echo '<p class="pPeliculaAltaProcess">Falta el nombre del usuario</p>';
                header('refresh:3; url=usuario_alta.php');
            }

            if (!empty($_POST['password'])) {
                $password = $_POST['password'];
                $encriptada = sha1($password);
            } else {
                echo '<p class="pPeliculaAltaProcess">Falta la contraseña del usuario</p>';
                header('refresh:3; url=usuario_alta.php');
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
                                header('refresh:3; url=usuario_alta.php');
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
                echo '<p class="pPeliculaAltaProcess">Falta la fecha del alta del usuario</p>';
                header('refresh:3; url=usuario_alta.php');
            }

            if (!empty($_POST['tipo'])) {
                $tipo = $_POST['tipo'];
            } else {
                echo '<p class="pPeliculaAltaProcess">Falta el tipo de usuario</p>';
                header('refresh:3; url=usuario_alta.php');
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

                require_once ('newName.php');
                $newName = nuevoNombre($user, $ext);

                $destino = '../img/usuarios/'. $newName;
                
                $envio = move_uploaded_file($rutaOrigen, $destino);

            }


            $sql = 'INSERT INTO usuario (usuario, password, mail, fecha_alta, tipo, foto) VALUES (\''. $user. '\', \''. $encriptada. '\', \''. $email. '\', \''. $fechaAlta. '\', \''. $tipo. '\', \''. $newName. '\')';

            $conection = connect();
            $result = mysqli_query($conection, $sql);
        
            if ($result){
                require_once ('showAltaUser.php');
                header('refresh:5; url=usuario_alta.php');
            } else {
                echo '<p class="pPeliculaAltaProcess">No se pudo realizar el alta</p>';
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



