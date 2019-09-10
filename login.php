<?php

// Conexion a la base de datos
require_once 'includes/conexion.php';

// Iniciar sesion
if(!$_SESSION){
   session_start(); 
}

// Recoger datos del formulario
if(isset($_POST)){
    
    //Borrar error atinguo
    
    if($_SESSION['error_login']){
                session_unset($_SESSION['error_login']);
            }
            
    // Recoger datos del usuario       
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    
    // Consulta para comproar las credenciales
    $sql = "SELECT * from usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);
    
    if($login && mysqli_num_rows($login) == 1){
        $usuario = mysqli_fetch_assoc($login);
        
        // Comprobar la contraseña / cifrar
        $verify = password_verify($password, $usuario['password']);
        
        if($verify){
            // Utlilizar una sesión para guardar los datos del usuario legueado
            $_SESSION['usuario'] = $usuario;
            
            
        }else{
            // Si algo falla enviar una sesión con el fallo
            $_SESSION['error_login'] = "Login incorrecto";
        }
        
    }else{
        //mensage error
         $_SESSION['error_login'] = "Login incorrecto";
    }
    
    
}

// Redirigir al index.php

header('Location: index.php');