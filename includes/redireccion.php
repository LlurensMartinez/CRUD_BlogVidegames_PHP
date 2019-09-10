<?php

if(!$_SESSION){
    session_start();
}

if(!$_SESSION['usuario']){
    header("Location: index.php");
}