<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Proyecto de regitro & login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="estilo.css">
    </head>
    <body>
        
        <!-- NAVBAR -->
        <?php require_once 'includes/nav.php'; ?>

        <!-- CARDS -->
        <div class="container mt-5">
     
            <div class="row">

                <!-- CARD DEFAULT -->
               <div class="col-8 mb-4">

                    <div class="card ">
                    <h1 class="text-center mt-3">Ultimas entradas</h1>

                    <?php if(isset($_SESSION['completado'])): ?>
                        <div> <?= $_SESSION['completado']; ?> </div>
                    <?php elseif(isset($_SESSION['error']['general'])): ?>
                        <div> <?= $_SESSION['error']['general']; ?> </div>
                    <?php endif; ?>

                    <?php borrarErrores() ?>

                        <?php 
                            $entradas = conseguirEntradas($db, true);
                            if(!empty($entradas)):
                                while($entrada = mysqli_fetch_assoc($entradas)):
                        ?>

                        <!-- cuerpo -->
                        <div class="card-body">
                            <a href="entrada.php?id=<?=$entrada['id']?>" class="text-decoration-none">
                                <h2 class="card-title text-primary"><?= $entrada['titulo']?></h2>
                                <h5 class="text-secondary"><span> <?= $entrada['categoria'].' | '.$entrada['fecha'] ?> </span></h5>
                                <p class="card-text">
                                    <?= substr($entrada['descripcion'], 0,200)."..."?>
                                </p>
                            </a>
                        </div>

                        <?php
                                endwhile;
                            endif;
                        ?>

                        <div class="card-body">
                            <a href="todas_entradas.php" class="btn btn-primary btn-block">Ver todas las entradas</a>
                        </div>

                    </div>
                </div>
                <!-- login & registro -->
                <?php require_once 'includes/sidebar.php'; ?>
            </div>
        </div>

        <!-- FOOTER -->
        <?php require_once 'includes/footer.php'; ?>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </body>
</html>