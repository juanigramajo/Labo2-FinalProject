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


            echo '<main id="mainPeliculaDelete">';

            if ($conection && !empty($_GET['id'])){

                $id = $_GET['id'];
                $sql = 'DELETE FROM usuario WHERE id = \''. $id. '\'';
                $result = mysqli_query ($conection, $sql);

                if ($result) {
                    echo '<p class="pDeleteDone">Se elimino correctamente el registro</p>';
                } else {
                    echo '<p class="pDeleteDone">No se pudo eliminar el registro</p>';
                }
                    
                    
            } else {
                echo '<p class="pDeleteDone">Error al realizar la eliminación</p>';
            }
                
            echo '</main>';

            disconnect($conection);
            header("refresh:3; url=usuario_listado.php");
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
