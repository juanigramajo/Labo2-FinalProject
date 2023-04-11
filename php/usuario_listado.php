<?php
    session_start();
    
    $ruta = '../css';
    require_once("../html/head.html");
    echo '<body>';
    
    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {
?>

    <section id="sectionUsuarioListado">
    
        <nav id="navMenu">

            <?php
                require_once('menu.php');
            ?>

        </nav>

        <?php
            require_once('conection.php');

            $sql = 'SELECT * FROM usuario';
            $conection = connect();
            $result = mysqli_query ($conection, $sql);
        
            if ($result){
                if (mysqli_num_rows($result)) {
                    ?>
                        <main id="mainUsuarioListado">
                            <table>
                                <caption>
                                    Listado de usuarios
                                </caption>


                                <thead>
                                    <th>
                                        Usuario
                                    </th>
                                    <th>
                                        Mail
                                    </th>
                                    <th>
                                        Fecha alta
                                    </th>
                                    <th>
                                        Tipo
                                    </th>
                                    <?php
                                    if ($_SESSION['tipo'] == 'Administrador' || $_SESSION['tipo'] == 'Editor') {
                                        echo '<th>
                                                Modificar
                                            </th>';
                                    }

                                    if ($_SESSION['tipo'] == 'Administrador') {
                                        echo '<th>
                                                Eliminar
                                            </th>';
                                    }
                                    ?>
                                </thead>

                                <tbody>
                                    <?php
                                        while ($fila = mysqli_fetch_array($result)) {
                                            echo '<tr>';
                                            echo '<td>'. $fila['usuario']. '</td>';
                                            echo '<td>'. $fila['mail']. '</td>';
                                            echo '<td>'. $fila['fecha_alta']. '</td>';
                                            echo '<td>'. $fila['tipo']. '</td>';

                                            if ($_SESSION['tipo'] == 'Administrador' || $_SESSION['tipo'] == 'Editor') {
                                                echo '<td><a href="usuario_update.php?id='. $fila['id']. '" alt="Editar datos del usuario" title="Editar datos del usuario"><img class="buttonsEditDeleteUser" src="../img/edit_pencil.png"></a></td>';
                                            }

                                            if ($_SESSION['tipo'] == 'Administrador') {
                                                echo '<td><a href="usuario_delete.php?id='. $fila['id']. '" alt="Eliminar datos del usuario" title="Eliminar datos del usuario"><img class="buttonsEditDeleteUser" src="../img/trash_empty.png"></a></td>';
                                            }

                                            echo '</tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>

                            <a id="buttomHide" href="center.php">Ocultar</a>
                        </main>
                    <?php

                } else {
                    echo '<hr>';
                    echo '<p>No se encontraron resultados</p>';
                }
                
            } else {
                echo '<p>Error en la consulta</p>';
            }

        
        disconnect($conection);
        ?>
    </section>



    
<?php
    require_once('../html/footer.html');

    echo '</body>';
    
    } else {
        echo '<p class="textUsuaroNoAurizado">Usuario no autorizado</p>';
        header('refresh:3; ../index.php');
    }
?>
