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
                Configuración de estilos            
            </h2>

            <form id="formConfig" action="configuracion_done.php" method="POST">

                <fieldset class="fieldsetsRadios">
                    <label class="radios" for="Clásico">        
                        <fieldset class="fieldsetTitleStyle">
                            <input type="radio" id="Clásico" name="selecciono" value="Clásico" checked> Clásico
                        </fieldset>

                        <figure>
                            <img class="imgFondos" src="../img/fondos/classic.png" alt="Estilo Clásico" title="Estilo Clásico">
                        </figure>
                    </label>

                    <label class="radios rightRadios" for="Captain">        
                        <fieldset class="fieldsetTitleStyle">
                            <input type="radio" id="Captain" name="selecciono" value="Captain"> Captain América
                        </fieldset>

                        <figure>
                            <img class="imgFondos" src="../img/fondos/cap.png" alt="Estilo Captain América" title="Estilo Captain América">
                        </figure>
                    </label>
                </fieldset>

                <fieldset class="fieldsetsRadios">
                    <label class="radios" for="Hulk">        
                        <fieldset class="fieldsetTitleStyle">
                            <input type="radio" id="Hulk" name="selecciono" value="Hulk"> Hulk
                        </fieldset>

                        <figure>
                            <img class="imgFondos" src="../img/fondos/hulk.png" alt="Estilo Hulk" title="Estilo Hulk">
                        </figure>
                    </label>
    
                    <label class="radios rightRadios" for="IronMan">        
                        <fieldset class="fieldsetTitleStyle">
                            <input type="radio" id="IronMan" name="selecciono" value="IronMan"> IronMan
                        </fieldset>

                        <figure>
                            <img class="imgFondos" src="../img/fondos/ironman.png" alt="Estilo IronMan" title="Estilo IronMan">
                        </figure>
                    </label>
                </fieldset>

                <fieldset id="fieldsetButtonsUpdate">
                    <input type="submit" class="buttonsPeliculaUpdate" value="Actualizar"> 
                    <a class="buttonsPeliculaUpdate" id="buttonCancelarUpdate" href="pelicula_listado.php">Cancelar</a>
                </fieldset>

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
