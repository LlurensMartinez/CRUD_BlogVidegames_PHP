<?php

// Recoger los valores del formulario de registro
if(isset($_POST)){
    
    // Conexion a la base de datos
    require_once 'includes/conexion.php';
    
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    
    
    // Array de errores
    
    $erores = [];
    
    // Validar los datos antes de guardarlos en la base de datos
    // Validar campo nombre
    if($nombre && !is_numeric($nombre) && !preg_match("/[0-9]", $nombre)){
        $nombre_validado = true;
    }else{
        $nombre_validado = true;
        $errores['nombre'] = "El nombre no es valido";
    }
    
    
    if(count($errores) == 0){
        $guardar_usuario = true;
           
        // INSERTAR CATEGORIA EN LA TABLA CATEGORIAS DE LA BDD
        $sql = "INSERT INTO categorias VALUES(null, '$nombre');";
        $guardar = mysqli_query($db, $sql);
    }
}

header("Location: index.php");