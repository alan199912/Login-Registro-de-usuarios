<?php 

    if(isset($_POST)) {

        // conexion a la bbdd
        require_once 'includes/conexion.php';

        // agarro los valores del formulario de actualizacion            escape de datos         trim guardar sin espacios
        $nombre = isset( $_POST['nombre'] ) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
        $apellido = isset( $_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
        $email = isset( $_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;

        // array de errores
        $error = array();

        // validar los datos antes de guardarlos en la bbdd
        
        // validar campo nombre
        if( !empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre) ) {
            $nombre_validado = true;
        } else {
            $nombre_validado = false;
            $error['nombre'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Oh no!</strong> El nombre es invalido.
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
        }

        // validar campo apellidos
        if( !empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido) ) {
            $apellido_validado = true;
        } else {
            $apellido_validado = false;
            $error['apellido'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Oh no!</strong> El Apellido es invalido.
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
        }

        // validar campo email
        if( !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            $email_validado = true;
        } else {
            $email_validado = false;
            $error['email'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Oh no!</strong> El email es invalido.
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>";
        }

        $guardar_usuario = false;

        if( count($error) == 0 ) {
            $guardar_usuario = true;
            $usuario = $_SESSION['usuario'];

            // comprobar si el email ya existe
            $sql = "SELECT email FROM usuarios WHERE email = '$email';";

            $isset_email = mysqli_query($db, $sql);
            $isset_user = mysqli_fetch_assoc($isset_email);

            if( $isset_user['id'] == $usuario['id'] || empty($isset_user) ) {
                // Actualizar un usuario en la bbdd
                $sql = "UPDATE usuarios SET ".
                        "nombre = '$nombre', ".
                        "apellido = '$apellido', ".
                        "email = '$email' ".
                        "WHERE id = ".$usuario['id'];

                $consulta = mysqli_query($db, $sql);

                if( $consulta ) {

                    $_SESSION['usuario']['nombre'] = $nombre;
                    $_SESSION['usuario']['apellido'] = $apellido;
                    $_SESSION['usuario']['email'] = $email;

                    $_SESSION['completado'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                                <strong>Bien hecho!</strong> Tus datos se han actualizado con exito.
                                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                                </button>
                                            </div>";

                } else {
                    $_SESSION['error']['general'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <strong>Oh no!</strong> Fallo al actualizar tus datos.
                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                    </div>";
                }
            } else {
                $_SESSION['error']['general'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <strong>Oh no!</strong> El email ya existe.
                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                    </div>";
            }

            
            
        } else {
            $_SESSION['error'] = $error;
        }
        header('Location:mis_datos.php');

    }
?>