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
            require_once('conection.php');
            $conection = connect();

            if ($conection && isset($_GET['id'])){

                $id = $_GET['id'];
                $sql = 'SELECT * FROM usuario WHERE id = \''. $id. '\'';
                $result = mysqli_query ($conection, $sql);
        
                if (mysqli_num_rows($result) > 0) {

                    $fila = mysqli_fetch_assoc($result);

                    ?>
                    <main id="mainPeliculaAlta">
                        <form id="formUpdateUsuario" action="usuario_update_done.php" method="POST" enctype="multipart/form-data">
                            
                            <fieldset id="fieldsetAlta">
                                <legend id="legendAlta">
                                    <strong>
                                        Modificar usuario
                                    </strong>
                                </legend>

                                <label for="user"></label>
                                <input class="inputsAlta" type="text" value="<?php echo $fila['usuario']?>" id="user" name="user" placeholder="Nombre del usuario" required>

                                <label for="email"></label>
                                <input class="inputsAlta" type="email" value="<?php echo $fila['mail']?>" id="email" name="email" placeholder="Email del usuario" required>

                                <label class="labelText" for="password">Si no desea cambiar la contraseña, deje el siguiente campo vacío: </label>
                                <input class="othersInputsAlta" type="password" id="password" name="password" placeholder="O bien, ingrese una nueva contraseña">
                                <input type="hidden" value="<?php echo $fila['password']?>" name="oldPassword">

                                <label class="labelText" for="fechaAlta">Fecha de alta: </label>
                                <input class="othersInputsAlta" type="date" value="<?php echo $fila['fecha_alta']?>" id="fechaAlta" name="fechaAlta" required>

                                <label class="labelText" for="tipo">Tipo de usuario</label>
                                <select class="othersInputsAlta" id="select" name="tipo" id="tipo" required>
                                    <?php
                                        switch ($fila['tipo']) {
                                            case 'Restringido':
                                                ?>
                                                <option value="Restringido" selected>Restringido</option>
                                                <option value="Editor">Editor</option>
                                                <option value="Administrador">Administrador</option>
                                                <?php
                                                break;
                                            
                                            case 'Editor':
                                                ?>
                                                <option value="Restringido">Restringido</option>
                                                <option value="Editor" selected>Editor</option>
                                                <option value="Administrador">Administrador</option>
                                                <?php
                                                break;
                                                
                                            case 'Administrador':
                                                ?>
                                                <option value="Restringido">Restringido</option>
                                                <option value="Editor">Editor</option>
                                                <option value="Administrador" selected>Administrador</option>
                                                <?php
                                                break;
                                        }
                                    ?>
                                </select>

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
                                        if ( (empty($fila['foto'])) || $fila['foto'] == 'NULL') {
                                            echo '<img id="imgUserUpdate" src="../img/usuarios/usuario_default.png" alt="'. $fila['usuario']. ' no tiene foto de perfil" title="'. $fila['usuario']. ' no tiene foto de perfil">';
                                        } else {
                                            echo '<img id="imgUserUpdate" src="../img/usuarios/'. $fila['foto']. '" alt="Foto de perfil de '. $fila['usuario']. '" title="Foto de perfil de '. $fila['usuario']. '">';
                                        }?>
                                        <p>Si desea continuar sin actualizar la portada, presione el boton inferior "actualizar".</p>
                                    </figure>
                                </fieldset>
                                
                                <label class="labelText" for="fotoPerfil">O bien, actualizar portada: </label>
                                <input class="inputsUpdate" type="file" accept="image/*" id="fotoPerfil" name="fotoPerfil">

                                <input type="hidden" value="<?php echo $id ?>" name="id">

                            </fieldset>

                            <fieldset id="fieldsetButtonsUpdate">
                                <input type="submit" class="buttonsPeliculaUpdate" name="btnActualizar" value="Actualizar">
                                <a class="buttonsPeliculaUpdate buttonCancelarUpdate" href="usuario_listado.php">Cancelar</a>
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
