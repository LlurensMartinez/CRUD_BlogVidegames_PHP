<?php

// Recoger los valores del formulario de registro
if(isset($_POST)){
    
    // Conexion a la base de datos
    require_once 'includes/conexion.php';
    
    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
    $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
    
    $usuario = $_SESSION['usuario']['id'];
    // Array de errores
    
    $erores = [];
    
    // Validar los datos antes de guardarlos en la base de datos
    // Validar campo nombre
    if($titulo){
        $titulo_validado = true;
    }else{
        $titulo_validado = true;
        $errores['titulo'] = "El titulo no es valido";
    }
    
    // Validar descripcion
    if($descripcion){
        $descripcion_validado = true;
    }else{
        $descripcion_validado = true;
        $errores['descripcion'] = "La descripcion no es valida";
    }
    
     // Validar categoria
    if($categoria && is_numeric($categoria)){
        $categoria_validado = true;
    }else{
        $categoria_validado = true;
        $errores['categoria'] = "La categoria no es valida";
    }
    
    if(count($errores) == 0){
        if($_GET['editar']){
            // ACTUALIZAR ENTRADA EN LA TABLA ENTRADAS DE LA BDD
            $entrada_id = $_GET['editar'];
            $usuario_id = $_SESSION['usuario']['id'];
            $sql = "UPDATE entradas SET titulo='$titulo', descripcion='$descripcion', categoria_id=$categoria".
                    " WHERE id=$entrada_id AND usuario_id = $usuario_id ";
        }else{
        $guardar_usuario = true;
           
        // INSERTAR ENTRADA EN LA TABLA ENTRDAS DE LA BDD
        $sql = "INSERT INTO entradas VALUES(null, $usuario, $categoria, '$titulo', '$descripcion', CURDATE());";
        }
        $guardar = mysqli_query($db, $sql);
        header("Location: index.php");
        
    }else{
        $_SESSION['errores_entrada'] = $errores;
        if($_GET['editar']){
           header("Location: crear_entradas.php?id=".$_GET['editar']);
        }else{
           header("Location: crear_entradas.php"); 
        }
        
    }
}

