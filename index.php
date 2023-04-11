<?php
    $ruta = 'css';
    require_once ('html/head.html');
    echo '<body>';
?>

<main id="mainIndex">
    <section>
        <form id="formIndex" action="php/login_process.php" method="POST">
    
            <fieldset id="fieldsetIndex">
                <legend id="legendIndex">
                    <strong>
                        Inicie Sesion
                    </strong>
                </legend>

                <label for="user"></label>
                <input class="inputsIndex" type="text" id="user" name="user" placeholder="Usuario">
                <label for="password"></label>
                <input class="inputsIndex" type="password" id="password" name="password" placeholder="Contraseña">
            </fieldset>

            <input type="submit" id="buttonsubIndex" value="Iniciar Sesión"> 

        </form>
    </section>
</main>





<?php 
    require_once ('html/footer.html');
?>