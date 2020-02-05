<?php 
    require_once 'includes/helpers.php';
    if(isset($_POST)) {

        // conexion a la bbdd
        require_once 'includes/conexion.php';

        // iniciar la sesion
        if( !isset($_SESSION) ) {

            session_start();

        }

        // agarro los valores del formulario de registro            escape de datos         trim guardar sin espacios
        $nombre = isset( $_POST['nombre'] ) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
        $apellido = isset( $_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
        $email = isset( $_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
        $password = isset( $_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

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

        // validar campo contraseña
        if( !empty($password) ) {
            $password_validado = true;
        } else {
            $password_validado = false;
            $error['password'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Oh no!</strong> El password esta vacia.
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
        }

        $guardar_usuario = false;

        if( count($error) == 0 ) {
            $guardar_usuario = true;

            // comprobar si el email ya existe
            $sql = "SELECT email FROM usuarios WHERE email = '$email';";

            $isset_email = mysqli_query($db, $sql);
            $isset_user = mysqli_fetch_assoc($isset_email);

            if(empty($isset_user)) {

                // cifrar la contraseña
                $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);

                // insertar usuario en la bbdd
                $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellido', '$email', '$password_segura', CURDATE() )";

                $consulta = mysqli_query($db, $sql);

                if( $consulta ) {
                    $_SESSION['completado'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                                <strong>Bien hecho!</strong> El usuario se ha guardado con exito.
                                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                                </button>
                                            </div>";
                } else {
                    $_SESSION['error']['general'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <strong>Oh no!</strong> Fallo al guardar el usuario.
                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                    </div>";
                }

            } else {
                $_SESSION['error']['general'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <strong>Oh no!</strong> Email ya existe.
                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                    </div>";
            }

            
            
            
            
        } else {
            $_SESSION['error'] = $error;
        }

    }
    
    header('Location:index.php');
?>