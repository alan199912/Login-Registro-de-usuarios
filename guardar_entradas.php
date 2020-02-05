<?php

    if(isset($_POST)) {

        // conexion a la bbdd
        require_once 'includes/conexion.php';

        $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
        $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
        $categoria = isset($_POST['categoria']) ?  (int)$_POST['categoria'] : false;
        $usuario = $_SESSION['usuario']['id'];

        // validacion
        $error = array();

        if(empty($titulo)) {
            $error['titulo'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Oh no!</strong> El titulo es invalido.
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
        }

        if(empty($descripcion)) {
            $error['descripcion'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Oh no!</strong> El descripcion es invalida.
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
        }

        if(empty($categoria) && !is_numeric($categoria)) {
            $error['categoria'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Oh no!</strong> El categoria es invalida.
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
        }

        if(count($error) == 0) {

            if( isset($_GET['editar']) ) {
                $entrada_id = $_GET['editar'];
                $usuario_id = $_SESSION['usuario']['id'];
                $sql = "UPDATE entradas SET titulo = '$titulo', descripcion = '$descripcion', categoria_id = $categoria ".
                        "WHERE id = $entrada_id AND usuario_id = $usuario_id ;";
            } else {
                $sql = "INSERT INTO entradas (usuario_id, categoria_id, titulo, descripcion, fecha) VALUES($usuario, $categoria, '$titulo', '$descripcion' , CURDATE() );";
            }

            $consulta = mysqli_query($db, $sql);

            if( $consulta ) {
                $_SESSION['completado'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                            <strong>Bien hecho!</strong> La entrada se ha guardado con exito.
                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                            </button>
                                        </div>";
            } else {
                $_SESSION['error']['general'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                    <strong>Oh no!</strong> Fallo al guardar la entrada.
                                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                    <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                </div>";
            }
            header("Location: index.php");
        } else {
            $_SESSION['error'] = $error;

            if(isset($_GET['editar'])) {
                header("Location: editar_entrada.php?id=".$_GET['editar']);
            } else {
                header("Location: crear_entrada.php");
            }
        }

    }
    

?>