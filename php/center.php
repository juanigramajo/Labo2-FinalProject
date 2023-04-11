<?php
    session_start();
    
    $ruta = '../css';
    require_once("../html/head.html");
    echo '<body>';
    
    if ( !empty($_SESSION['user']) && isset($_SESSION['user']) ) {
?>

    <section id="sectionCenter">
        

        <?php
            require_once('conection.php');

            $sql = 'SELECT * FROM usuario';
            $conection = connect();
            $result = mysqli_query ($conection, $sql);
        
            if ($result){
                if (mysqli_num_rows($result)) {
                    
                    ?>

                        <nav id="navCenter">

                            <?php
                                require_once('menu.php');
                            ?>
                            
                        </nav>
                    
                    <?php
                        

                } else {
                    echo '<hr>';
                    echo '<p>No se encontraron resultados</p>';
                    header('refresh:3; url=../index.php');
                }
                
            } else {
                echo '<p>Error en la consulta</p>';
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
