<?php
    session_start();
    
    $ruta = '../css';
    require_once("../html/head.html");
    echo '<body>';
    
    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {
?>

    <section id="sectionPeliculaListado">
    
        <section id="sectionNavBoton">
            <nav id="navPeliculaListado">
    
                <?php
                    require_once('menu.php');
                ?>
    
            </nav>
        </section>



        <main id="mainContact">
            <h2 id="h2contact">
                Contáctenos                
            </h2>

            <form id="formContact" action="contactenos_process.php" method="POST">
    
                <fieldset id="fieldsetContact">

                    <label class="labelText" for="motivo">Motivo:</label>
                    <select class="othersInputsAlta" id="select" name="motivo" id="motivo">
                        <option value="Sugerencia">Sugerencia</option>
                        <option value="Reclamo">Reclamo</option>
                    </select>

                    <label for="mensaje" id="labelMensaje">Mensaje:</label>
                    <textarea rows="13" cols="6" name="mensaje"></textarea>

                </fieldset>

                <input type="submit" id="buttonsubContact" value="Enviar"> 

            </form>
        </main>

                
    </section>



    
<?php
    require_once('../html/footer.html');

    echo '</body>';

    } else {
        echo '<p class="textUsuaroNoAurizado">Usuario no autorizado</p>';
        header('refresh:3; ../index.php');
    }
?>
