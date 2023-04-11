<?php
    session_start();
    
    $ruta = '../css';
    require_once("../html/head.html");
    echo '<body>';
    
    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {

?>

    <section id="sectionAltaProcess">
        

        <?php

            $c = 0; //contador para corroborar que no se envíe el mail sin un mensaje

            if (!empty($_POST['motivo'])) {
                $motivo = $_POST['motivo'];
                $c++;
            } else {
                echo '<p class="pPeliculaAltaProcess">Falta el motivo del mensaje</p>';
                header('refresh:3; url=contactenos.php');
            }

            if (!empty($_POST['mensaje'])) {
                $mensaje = $_POST['mensaje'];
                $c++;
            } else {
                echo '<p class="pPeliculaAltaProcess">Falta el mensaje</p>';
                header('refresh:3; url=contactenos.php');
            }

            if ($c == 2) {
                $usuario = $_SESSION['user'];
                $correoOrigen = $_SESSION['mail'];
                $correoDestino = 'ignaciogramajo24@gmail.com';
                $asunto = $motivo. ' - '. $usuario;
                $cabecera = 'From: '. $correoOrigen. "\r\n". 'Reply-To: '. $correoOrigen;
                $result = mail($correoDestino, $asunto, $mensaje, $cabecera);
            
                if ($result){
                    echo '<p class="pPeliculaAltaProcess">Envío exitoso</p>';
                } else {
                    echo '<p class="pPeliculaAltaProcess">No se pudo realizar el envío</p>';
                }
            } else {
                echo '<p class="pPeliculaAltaProcess">No se pudo realizar el envío</p>';
            }
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



