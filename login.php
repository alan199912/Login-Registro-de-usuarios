<?php

    // iniciar la sesion y la conexion a la bbdd
    require_once 'includes/conexion.php';

    // recoger datos del formulario
    if(isset($_POST)) {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        // validar los datos
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = mysqli_query($db, $sql);

        if( $login && mysqli_num_rows($login) == 1 ) {

            $usuario = mysqli_fetch_assoc($login);

            // comprobar la contraseña
            $verify = password_verify($password, $usuario['password']);

            if( $verify ) {
                // utilizar una session para guardar los datos del usuario logueado
                $_SESSION['usuario'] = $usuario;

                if( isset($_SESSION['error_login']) ) {
                    // borrar la sesion
                    $_SESSION['error_login'] = null;
                    $borrado = session_unset($_SESSION['error_login']);
                }

            } else {
                // si algo falla enviar una session con el fallo
                $_SESSION['error_login'] = "Login incorrecto";
            }

        } else {
            // mensaje error
            $_SESSION['error_login'] = "Login incorrecto";
        }

    }

    // redirigir al index
    header("Location:index.php");

?>