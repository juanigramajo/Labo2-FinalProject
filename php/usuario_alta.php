<?php
    session_start();
    
    $ruta = '../css';
    require_once("../html/head.html");
    echo '<body>';
    
    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {
        if (($_SESSION['tipo'] == 'Administrador')) {

?>
    
    <section id="sectionPeliculaAlta">
               
        <nav id="navMenu">

            <?php
                require_once('menu.php');
            ?>
            
        </nav>

        <main id="mainPeliculaAlta">
            <form id="formAltaUsuario" action="usuario_alta_process.php" method="POST" enctype="multipart/form-data">
                
                <fieldset id="fieldsetAlta">
                    <legend id="legendAlta">
                        <strong>
                            Agregar usuario
                        </strong>
                    </legend>

                    <label for="user"></label>
                    <input class="inputsAlta" type="text" id="user" name="user" placeholder="Nombre del usuario" required>

                    <label for="email"></label>
                    <input class="inputsAlta" type="email" id="email" name="email" placeholder="Email del usuario" required>

                    <label for="password"></label>
                    <input class="inputsAlta" type="password" id="password" name="password" placeholder="Ingrese una contraseña" required>

                    <label class="labelText" for="fechaAlta">Fecha de alta: </label>
                    <input class="othersInputsAlta" type="date" id="fechaAlta" name="fechaAlta" required>

                    <label class="labelText" for="tipo">Tipo de usuario</label>
                    <select class="othersInputsAlta" id="select" name="tipo" id="tipo">
                        <option value="Restringido" selected>Restringido</option>
                        <option value="Editor">Editor</option>
                        <option value="Administrador">Administrador</option>
                    </select>

                    <label class="labelText" for="fotoPerfil">Foto de perfil: </label>
                    <input class="othersInputsAlta" type="file" accept="image/*" id="fotoPerfil" name="fotoPerfil">
                </fieldset>

                <input type="submit" id="buttonsubAlta" value="Agregar usuario"> 

            </form>


            <a id="buttomBack" href="center.php">Volver</a>
        </main>
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
