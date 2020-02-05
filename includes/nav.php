<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><span class="text-primary" >Blog de Video Juegos</span></a>

        <ul class="navbar-nav ml-auto"> 
            <li class="nav-item active"><a class="nav-link" href="index.php">Inicio</a></li>

            <?php 
                    $categorias = conseguirCategorias($db);
                    if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)): 
            ?>
                <li class="nav-item active"><a class="nav-link" href="categorias.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a></li>
            <?php   
                endwhile;
                endif;
            ?>

            <li class="nav-item active"><a class="nav-link" href="index.php">Sobre mi</a></li>
            <li class="nav-item active"><a class="nav-link" href="index.php">Contacto</a></li>
        </ul>
    </div>
</nav>