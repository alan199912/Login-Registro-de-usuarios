<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<?php

    if(!isset($_POST['busqueda'])) {
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
             <h1 class="text-center mt-3">Busqueda : <?=$_POST['busqueda']?></h1>

                 <?php 
                     $entradas = conseguirEntradas($db, null, null, $_POST['busqueda']);
                     if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
                         while($entrada = mysqli_fetch_assoc($entradas)):
                 ?>

                  <!-- cuerpo -->
                  <div class="card-body">
                    <a href="entrada.php?id=<?=$entrada['id']?>" class="text-decoration-none">
                        <h2 class="card-title text-primary"><?= $entrada['titulo']?></h2>
                        <h5 class="text-secondary"><span> <?= $entrada['categoria'].' | '.$entrada['fecha'] ?> </span></h5>
                        <p class="card-text">
                            <?= $entrada['descripcion']?>
                        </p>
                    </a>
                 </div>

                 <?php
                         endwhile;
                        else:
                 ?>
                 <!-- si no hay entradas -->
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Oh no!</strong> No hay entradas.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>

                <?php endif; ?>

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