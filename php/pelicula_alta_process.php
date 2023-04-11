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

            if (!empty($_POST['titulo'])) {

                $sql = 'SELECT * FROM pelicula';

                $conection = connect();
                $result = mysqli_query($conection, $sql);

                if ($result){
                    if (mysqli_num_rows($result)) {
                        echo '<main id="mainPeliculaListado">';

                        while ($fila = mysqli_fetch_array($result)) {
                            if ($_POST['titulo'] == $fila['titulo']) {
                                echo '<p class="pPeliculaAltaProcess">Ya existe una película con este título</p>';
                                header('refresh:3; url=pelicula_alta.php');
                                die();
            
                            } else {
                            $titulo = $_POST['titulo'];
                            }
                        }

                        echo '</main>';
                    } else if (mysqli_num_rows($result) == 0) {
                        $titulo = $_POST['titulo'];
                    } else {
                        echo '<hr>';
                        echo '<p>No se encontraron resultados</p>';
                        header('refresh:3; url=pelicula_alta.php');
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

            if (!empty($_FILES['portada']['size'])) {
                
                $nombre = $_FILES['portada']['name'];
                $arreglo_nombre = explode('.', $nombre);
                $ext = $arreglo_nombre[count($arreglo_nombre) - 1];
                
                $rutaOrigen = $_FILES['portada']['tmp_name'];
                
                $destino = '../img/portadas/';
                
                if (!file_exists($destino)) {
                    mkdir($destino);
                }

                require_once ('newName.php');
                $newName = nuevoNombre($titulo, $ext);

                $destino = '../img/portadas/'. $newName;
                
                $envio = move_uploaded_file($rutaOrigen, $destino);

            }


            $sql = 'INSERT INTO pelicula (titulo, duracion, genero, fecha_estreno, foto_portada) VALUES (\''. $titulo. '\', \''. $duracion. '\', \''. $genero. '\', \''. $estreno. '\', \''. $newName. '\')';

            $conection = connect();
            $result = mysqli_query($conection, $sql);
        
            if ($result){
                require_once ('showAlta.php');
                header('refresh:5; url=pelicula_alta.php');
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



