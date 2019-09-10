<?php

// Conexion a la base de datos
require_once 'includes/conexion.php';

// Recoger los valores del formulario de actualizacion
if(isset($_POST)){
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    
    $usuario = $_SESSION['usuario'];

    
    
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
    
    $guardar_usuario = fale;
    
    if(count($errores) == 0){
        $guardar_usuario = true;
        // COMPROBAR SI EL EMAIL YA EXISTE
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);
        
        if($isset_user['id'] ==  $usuario['id'] || empty($isset_user)){
            // ACTUALIZAR USUARIO EN LA TABLA USUARIOS DE LA BDD
            $sql = "UPDATE usuarios SET ".
                    "nombre = '$nombre', ".
                    "apellidos = '$apellidos', ".
                    "email = '$email' ".
                    "WHERE id = ".$usuario['id'];

            $guardar = mysqli_query($db, $sql);

            if($guardar){
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;
                $_SESSION['completado'] = 'Tus datos se han actualizado con éxito';
            }else{
                $_SESSION['errores']['general'] = "Fallo al actualizar tus datos";
            }
        }else{
           $_SESSION['errores']['general'] = "El usuario ya existe";    
        }
    }else{
        $_SESSION['errores'] = $errores;
        
    }
    
}

header('Location: mis_datos.php');