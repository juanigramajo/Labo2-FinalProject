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
            <form id="formAltaPelicula" action="pelicula_alta_process.php" method="POST" enctype="multipart/form-data">
                
                <fieldset id="fieldsetAlta">
                    <legend id="legendAlta">
                        <strong>
                            Agregar película
                        </strong>
                    </legend>

                    <label for="titulo"></label>
                    <input class="inputsAlta" type="text" id="titulo" name="titulo" placeholder="Título de la película">

                    <label for="duracion"></label>
                    <input class="inputsAlta" type="number" id="duracion" name="duracion" placeholder="Duración de la película (en minutos)">

                    <label class="labelText" for="genero">Género de la película:</label>
                    <select class="othersInputsAlta" id="select" name="genero" id="genero">
                        <option value="ninguna" selected>-- Seleccione el género --</option>
                        <option value="Acción">Acción</option>
                        <option value="Comedia">Comedia</option>
                        <option value="Terror">Terror</option>
                        <option value="Suspenso">Suspenso</option>
                        <option value="Infantil">Infantil</option>
                    </select>

                    <label class="labelText" for="estreno">Fecha de estreno: </label>
                    <input class="othersInputsAlta" type="date" id="estreno" name="estreno">

                    <label class="labelText" for="portada">Portada: </label>
                    <input class="othersInputsAlta" type="file" accept="image/*" id="portada" name="portada">
                </fieldset>

                <input type="submit" id="buttonsubAlta" value="Agregar película"> 

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
