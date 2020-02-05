<?php

    require_once 'includes/conexion.php';

    if( isset($_SESSION['usuario']) && isset($_GET['id']) ) {
        $entrada_id = $_GET['id'];
        $usuario_id = $_SESSION['usuario']['id'];

        $sql = "DELETE FROM entradas WHERE usuario_id = $usuario_id AND id = $entrada_id ";

        $borrado = mysqli_query($db, $sql);

        if( $borrado ) {
            $_SESSION['completado'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        <strong>Bien hecho!</strong> La entrada se ha borrado con exito.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
        } else {
            $_SESSION['error']['general'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                <strong>Oh no!</strong> Fallo al borrar la entrada.
                                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                                </button>
                                            </div>";
        }

        // echo mysqli_error($db);
        // die();

    }
    header("Location:index.php");

?>