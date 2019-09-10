<?php

// Conexion a la base de datos
require_once 'includes/conexion.php';

// Iniciar sesion
if(!$_SESSION){
   session_start(); 
}

// Recoger los valores del formulario de registro
if(isset($_POST)){
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;
    
    
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
    
    // Validar campo nombre
    if($apellidos && !is_numeric($apellidos) && !preg_match("/[0-9]", $apellidos)){
        $apellidos_validado = true;
    }else{
        $apellidos_validado = true;
        $errores['apellidos'] = "Los apellidos no son validos";
    }
    
    // Validar campo email
    if($email && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    }else{
        $email_validado = true;
        $errores['email'] = "El email no es valido";
    }
    
    // Validar campo password
    if($password){
        $password_validado = true;
    }else{
        $password_validado = true;
        $errores['password'] = "La contraseña esta vacía";
    }
    
    
    $guardar_usuario = fale;
    
    if(count($errores) == 0){
        $guardar_usuario = true;
        
        // CIFRAR LA CONTRASEÑA
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
        
        // INSERTAR USUARIO EN LA TABLA USUARIOS DE LA BDD
        $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
        $guardar = mysqli_query($db, $sql);
        
        if($guardar){
            $_SESSION['completado'] = 'El registro se ha completado con éxito';
        }else{
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario!";
        }
        
    }else{
        $_SESSION['errores'] = $errores;
        
    }
    
}

header('Location: index.php');