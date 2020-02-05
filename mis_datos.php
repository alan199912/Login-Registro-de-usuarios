<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
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

            <h1 class="text-center mt-3">Mis Datos</h1>
            <?php if(isset($_SESSION['completado'])): ?>
                        <div> <?= $_SESSION['completado']; ?> </div>
                    <?php elseif(isset($_SESSION['error']['general'])): ?>
                        <div> <?= $_SESSION['error']['general']; ?> </div>
                    <?php endif; ?>
                
                <!-- cuerpo -->
                <div class="card-body">

                    <h2 class="card-title text-primary"></h2>
                    
                    <form action="actualizar_usuario.php" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control mb-4" id="nombre" value="<?=$_SESSION['usuario']['nombre']?>">
                            <?php echo isset($_SESSION['error']) ? mostrarError($_SESSION['error'], 'nombre') : '';?>

                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" class="form-control mb-4" id="apellido" value="<?=$_SESSION['usuario']['apellido']?>">
                            <?php echo isset($_SESSION['error']) ? mostrarError($_SESSION['error'], 'apellido') : '';?>

                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control mb-4" id="email" value="<?=$_SESSION['usuario']['email']?>">
                            <?php echo isset($_SESSION['error']) ? mostrarError($_SESSION['error'], 'email') : '';?>
                            
                            <input type="submit" name="actualizar" class="btn btn-primary btn-block" value="Actualizar"> 
                        </div>
                    </form>
                    <?php borrarErrores()?>
                </div>
            </div>
        </div>

        <?php require_once 'includes/sidebar.php'; ?>

     </div>
</div>

<!-- FOOTER -->
<?php require_once 'includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>