<?php require_once 'includes/helpers.php'; ?>

    <!-- LOGIN -->
    
    <div class="col-4 mb-4">

    <!-- BUSCADOR -->

    <?php if(isset($_SESSION['usuario'])): ?>
        <div class="card mb-3">
            <div class="card-body">

                <!-- MOSTRAR ERRORES -->
                <?php if(isset($_SESSION['completado'])): ?>
                <div> <?= $_SESSION['completado']; ?> </div>
                <?php elseif(isset($_SESSION['error']['general'])): ?>
                    <div> <?= $_SESSION['error']['general']; ?> </div>
                <?php endif; ?>

                <form action="buscar.php" method="post">
                    <div class="form-group">
                        <label for="busqueda">Buscar</label>
                        <input type="text" class="form-control mb-4 mb-4" name="busqueda" id="busqueda">
                        
                        <input type="submit" class="btn btn-primary btn-block" value="Buscar"> 
                    </div>
                </form>
                <?php borrarErrores(); ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- SESION -->

        <?php if(isset($_SESSION['usuario'])): ?>
        <div class="card">
            <div class="card-body">
            
                    <div class="text-center">
                        <h4>Bienvenido, <?= $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellido']; ?></h4>
                        <hr>
                        <!-- botones -->
                        <a href="crear_entradas.php" class="btn btn-success mb-2 btn-block">Crear Entradas</a>
                        <a href="crear_categoria.php" class="btn btn-light border-dark mb-2 btn-block">Crear Categoria</a>
                        <a href="mis_datos.php" class="btn btn-warning mb-2 btn-block">Mis Datos</a>
                        <a href="cerrar_sesion.php" class="btn btn-danger mb-2 btn-block">Cerrar sesion</a>
                    </div>
            </div>
        </div>
        <?php endif; ?>

        <hr class="border-0">

        <!-- LOGIN -->
        
        <?php if(!isset($_SESSION['usuario'])): ?>
        <div class="card">
            <div class="card-body">

                <h5 class="card-title text-center">Identificate</h5>

                <!-- errores -->
                <?php if(isset($_SESSION['error_login'])): ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['error_login']; ?>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control mb-4 mb-4" name="email" id="email">

                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control mb-4" name="password" id="password">
                        
                        <input type="submit" class="btn btn-primary btn-block" value="Entrar"> 
                    </div>
                </form>
                <?php borrarErrores(); ?>
            </div>
        </div>
        <?php endif; ?>

        <hr class="border-0">

        <!-- REGISTER -->
        
        <?php if(!isset($_SESSION['usuario'])): ?>
        <div class="card">
            <div class="card-body">

                <h5 class="card-title text-center">Registrate</h5>

                <!-- MOSTRAR ERRORES -->
                <?php if(isset($_SESSION['completado'])): ?>
                <div> <?= $_SESSION['completado']; ?> </div>
                <?php elseif(isset($_SESSION['error']['general'])): ?>
                    <div> <?= $_SESSION['error']['general']; ?> </div>
                <?php endif; ?>

                <form action="register.php" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control mb-4" id="nombre">
                        <?php echo isset($_SESSION['error']) ? mostrarError($_SESSION['error'], 'nombre') : '';?>

                        <label for="apellido">Apellido</label>
                        <input type="text" name="apellido" class="form-control mb-4" id="apellido">
                        <?php echo isset($_SESSION['error']) ? mostrarError($_SESSION['error'], 'apellido') : '';?>

                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control mb-4" id="email">
                        <?php echo isset($_SESSION['error']) ? mostrarError($_SESSION['error'], 'email') : '';?>

                        <label for="password">Contraseña</label>
                        <input type="password" name="password" class="form-control mb-4" id="password">
                        <?php echo isset($_SESSION['error']) ? mostrarError($_SESSION['error'], 'password') : '';?>
                        
                        <input type="submit" name="register_submit" class="btn btn-primary btn-block" value="Registrar"> 
                    </div>
                </form>
                <?php borrarErrores(); ?>
            </div>
        </div>
        <?php endif; ?>

    </div>





