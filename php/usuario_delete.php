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

                $sql = 'SELECT * FROM usuario WHERE id = '. $id;
                $result = mysqli_query ($conection, $sql);
        
                if (mysqli_num_rows($result) > 0) {

                    $fila = mysqli_fetch_array($result);

                    echo '<main id="mainPeliculaDelete">

                            <h2>Eliminar usuario</h2>
                            <p id="pSureDelete">¿Está seguro de querer eliminar el usuario <strong>'. $fila['usuario']. '</strong>?</p>
                                
                            <article id="articleUsuarioDelete">';
                                
                            if ( (empty($fila['foto'])) || $fila['foto'] == 'NULL') {
                                echo '<img id="imgUserDelete" src="../img/usuarios/usuario_default.png" alt="'. $fila['usuario']. ' no tiene foto de perfil" title="'. $fila['usuario']. ' no tiene foto de perfil">';
                            } else {
                                echo '<img id="imgUserDelete" src="../img/usuarios/'. $fila['foto']. '" alt="Foto de perfil de '. $fila['usuario']. '" title="Foto de perfil de '. $fila['usuario']. '">';
                            }
                                
                        echo    '<section id="sectionDatosArticle">
                                    <h3>'. $fila['usuario']. '</h3>
                                    <p>Email: '. $fila['mail']. '</p>
                                </section>
                                
                            </article> 
                            
                            <section id="sectionButtonsDelete">
                                <a class="buttonsPeliculaDelete" href="usuario_delete_done.php?id='. $id. '" alt="Aceptar eliminar usuario" title="Aceptar eliminar película">Aceptar</a>
                                <a class="buttonsPeliculaDelete" href="usuario_listado.php" alt="Cancelar" title="Cancelar">Cancelar</a>
                            </section>

                        </main>';
                }
                
                
            } else {
                echo '<p>No se puede eliminar el registro</p>';
                header('refresh:3; usuario_listado.php');
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
