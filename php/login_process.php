<?php
    session_start();
    $ruta = '../css';
    require_once("../html/head.html");
    echo '<body>';
    echo '<main>';
?>


<?php

    if (!empty($_POST['user'])) {
        $user = $_POST['user'];
    } else {
        echo '<p class="pError">Ingrese un nombre de usuario</p>';
        header('refresh:3; url=../index.php');
    }

    if (!empty($_POST['password'])) {
        $password = sha1($_POST['password']);
    } else {
        echo '<p class="pError">Ingrese una contraseña</p>';
        header('refresh:3; url=../index.php');
    }

    require_once('conection.php');

    $sql = 'SELECT * FROM usuario WHERE usuario = \''. $user. '\' AND password = \''. $password. '\'';
    $conection = connect();
    $result = mysqli_query ($conection, $sql);

    if ($result){
        if (mysqli_num_rows($result)) {

            $fila = mysqli_fetch_array($result);

            $_SESSION['user'] = $fila['usuario'];

            $_SESSION['foto'] = $fila['foto'];

            $_SESSION['mail'] = $fila['mail'];

            $_SESSION['tipo'] = $fila['tipo'];

            $_SESSION['id'] = $fila['id'];

            header('refresh:0; url=pelicula_listado.php');

        } else {
            echo '<hr>';
            echo '<p class="pError">No encontramos el usuario</p>';
            header('refresh:3; url=../index.php');
        }
        
    } else {
        echo '<p class="pError">Error en la consulta</p>';
    }

    disconnect($conection);
?>

    
<?php
    echo '</main>';

    require_once('../html/footer.html');

    echo '</body>';
?>
