<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<?php

    $entrada_seleccionada = entradaSeleccionada($db, $_GET['id']);
    
    if(!isset($entrada_seleccionada['id'])) {
        header("Location:index.php");
    }
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="estilo.css">

<!-- NAV -->
<?php require_once 'includes/nav.php'; ?>

<!-- CARDS -->
<div class="container mt-5">
     
     <div class="row">

         <!-- CARD DEFAULT -->
        <div class="col-8 mb-4">

             <div class="card ">
                <div class="card-body">
                    <h2 class="card-title text-primary"><?= $entrada_seleccionada['titulo']?></h2>
                    <a href="categorias.php?id=<?=$entrada_seleccionada['categoria_id']?>" class="text-decoration-none mb-2">
                        <h5 class="text-secondary"><span> <?= $entrada_seleccionada['categoria'].' | '.$entrada_seleccionada['fecha']?></span></h5>
                    </a>
                    <h5 class="mb-2"> Hecho por <span><?= $entrada_seleccionada['usuario'] ?></span> </h5>
                    <p class="card-text">
                        <?= $entrada_seleccionada['descripcion']?>
                    </p>

                    <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada_seleccionada['usuario_id']) : ?>

                        <a href="editar_entrada.php?id=<?=$entrada_seleccionada['id']?>" class="btn btn-primary mb-2 btn-block">Editar Entrada</a>
                        <a href="borrar_entrada.php?id=<?=$entrada_seleccionada['id']?>" class="btn btn-danger mb-2 btn-block">Borrar Entrada</a>

                    <?php endif; ?>

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