<?php

    if(isset($_POST)) {

        // conexion a la bbdd
        require_once 'includes/conexion.php';

        $nombre_categoria = isset($_POST['nombre_categoria']) ? mysqli_real_escape_string($db, $_POST['nombre_categoria']) : false;

        // array de errores
        $error = array();

        // validar los datos antes de guardarlos en la bbdd
        
        // validar campo nombre
        if( !empty($nombre_categoria) && !is_numeric($nombre_categoria) && !preg_match("/[0-9]/", $nombre_categoria) ) {
            $nombre_validado = true;
        } else {
            $nombre_validado = false;
            $error['nombre_categoria'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Oh no!</strong> La caegoria es invalida.
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
        }

        if( count($error) == 0 ) {
            $sql = "INSERT INTO categorias (nombre) VALUES('$nombre_categoria');";
            $consulta = mysqli_query($db, $sql);
            if( $consulta ) {
                $_SESSION['completado'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                            <strong>Bien hecho!</strong> La categoria se ha guardado con exito.
                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                            </button>
                                        </div>";
            } else {
                $_SESSION['error']['general'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                    <strong>Oh no!</strong> Fallo al guardar la categoria.
                                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                    <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                </div>";
            }
            header("Location: index.php");
        } else {
            $_SESSION['error'] = $error;
            header('Location:crear_categoria.php');
        }

    }
    

?>