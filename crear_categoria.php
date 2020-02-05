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

            <h1 class="text-center mt-3">Crear categorias</h1>
            <p class="text-center mt-3">
                Añade nuevas categorias al blog para que los usuarios puedan usarlas al crear sus entradas
            </p>
            
                <!-- cuerpo -->
                <div class="card-body">

                    <h2 class="card-title text-primary"></h2>
                    
                    <form action="guardar_categoria.php" method="post">
                        <div class="form-group">
                            <label for="nombre_categoria">Nombre de la Categoria</label>
                            <input type="text" name="nombre_categoria" id="nombre_categoria" class="form-control" placeholder="Ingresa la categoria que desea crear">
                            <?php echo isset($_SESSION['error']) ? mostrarError($_SESSION['error'], 'nombre_categoria') : '';?>

                            <input type="submit" class="btn btn-primary mt-2" value="Guardar">
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