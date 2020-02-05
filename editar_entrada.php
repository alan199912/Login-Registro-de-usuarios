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

            <h1 class="text-center mt-3">Editar entradas</h1>
            <p class="text-center mt-3">
                Edita tu entrada <?=$entrada_seleccionada['titulo']?>
            </p>
                
                <!-- cuerpo -->
                <div class="card-body">

                    <h2 class="card-title text-primary"></h2>
                    
                    <form action="guardar_entradas.php?editar=<?=$entrada_seleccionada['id']?>" method="post">
                        <div class="form-group">
                            <label for="titulo">Titulo :</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Ingrese el titulo de la entrada" value="<?=$entrada_seleccionada['titulo']?>">
                            <?php echo isset($_SESSION['error']) ? mostrarError($_SESSION['error'], 'titulo') : '';?>

                            <label for="descripcion mt-3">Descripción :</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="10"><?=$entrada_seleccionada['descripcion']?></textarea>
                            <?php echo isset($_SESSION['error']) ? mostrarError($_SESSION['error'], 'descripcion') : '';?>

                            <label for="categoria mt-3">Categoria :</label>
                            <select name="categoria" id="categoria" class="form-control">
                                <?php 
                                    $categorias = conseguirCategorias($db);
                                    if( !empty($categorias) ):
                                    while( $categoria = mysqli_fetch_assoc($categorias) ) :
                                ?>
                                    <option value="<?=$categoria['id']?>" <?= ($categoria['id'] == $entrada_seleccionada['categoria_id']) ? "selected = 'selected' " : '' ?> >
                                        <?=$categoria['nombre']?>
                                    </option>
                                <?php 
                                    endwhile;
                                    endif; 
                                ?>
                            </select>
                            <?php echo isset($_SESSION['error_entrada']) ? mostrarError($_SESSION['error_entrada'], 'categoria') : '';?>

                            
                            
                            <input type="submit" class="btn btn-primary mt-2" value="Guardar">
                        </div>
                    </form>
                    <?php borrarErrores()?>
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