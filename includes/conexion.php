<?php

// conectar ala base de datos

$server = "localhost";
$username = "root";
$password ='root';
$database = 'blog_master';
$db = mysqli_connect($server, $username, $password, $database);

// Consulta para configurar la codificacion de caracteres

mysqli_query($conexion, "SET NAMES 'utf8'");

// Iniciat la session

if(!$_SESSION){
    session_start();
}
