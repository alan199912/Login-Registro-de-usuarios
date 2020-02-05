<?php

    function mostrarError($error, $campo) {

        $alerta = '';

        if( isset($error[$campo]) && !empty($campo) ) {
            $alerta = "<div>".$error[$campo]."</div>";
        }

        return $alerta;
    }

    function borrarErrores() {

        $borrado = false;

        if(isset($_SESSION['error'])) {

            $_SESSION['error'] = null;

        }

        if(isset($_SESSION['completado'])) {

            $_SESSION['completado'] = null;
            
        }
        
        return $borrado;
    }

    function conseguirCategorias($conexion) {
        $sql = "SELECT * FROM categorias ORDER BY id ASC;";
        $categorias = mysqli_query($conexion, $sql);

        $result = array();

        if($categorias && mysqli_num_rows($categorias) >= 1) {
            $result = $categorias;
        }

        return $result;
    }

    function categoriaSeleccionada($conexion, $id) {
        $sql = "SELECT * FROM categorias WHERE id = $id ;";
        $categorias = mysqli_query($conexion, $sql);

        $result = array();

        if($categorias && mysqli_num_rows($categorias) >= 1) {
            $result = mysqli_fetch_assoc($categorias);
        }

        return $result;
    }

    function entradaSeleccionada($conexion, $id) {
        $sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellido) AS usuario FROM entradas e ".
                "INNER JOIN categorias c ON e.categoria_id = c.id  ".
                "INNER JOIN usuarios u ON e.usuario_id = u.id ".
                "WHERE e.id = $id ;";

        $entrada = mysqli_query($conexion, $sql);

        $result = array();

        if($entrada && mysqli_num_rows($entrada) >= 1) {
            $result = mysqli_fetch_assoc($entrada);
        }

        return $result;
    }

    function conseguirEntradas($conexion ,$limit = null, $categoria = null, $busqueda = null) {
        $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
               "INNER JOIN categorias c ON e.categoria_id = c.id ";

        if(!empty($categoria) ) {
            $sql .= "WHERE e.categoria_id = $categoria ";
        }

        if(!empty($busqueda) ) {
            $sql .= "WHERE e.titulo LIKE '%$busqueda%' ";
        }

        $sql .= "ORDER BY e.id DESC "; 

        if($limit) {
            $sql .= "LIMIT 4";
        }

        $entradas = mysqli_query($conexion, $sql);

        $result = array();

        if( $entradas &&  mysqli_num_rows($entradas) >= 1 ) {
            $result = $entradas;
        }

        return $entradas;
    }





?>