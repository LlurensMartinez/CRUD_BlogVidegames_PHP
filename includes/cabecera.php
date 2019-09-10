<?php require_once 'conexion.php';?>
<?php require_once 'includes/helpers.php'; ?>

<!doctype html>
<html lang="ES">

<head>
    <title>BLOG DE VIDEOJUEGOS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>

<body>

    <!-- CABECERA -->
    <header id="cabecera">
        
        <!-- LOGO -->
        
        <div id="logo">
            <a href="index.php">
                Blog de Videojuegos
            </a>
        </div>
        
        
        <!-- MENU -->
        
        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <!-- Pasamos $db para pasarle la base de datos de la conexiona la funcion -->
                <?php $categorias = conseguirCategorias($db) ?>
                <?php while($categoria = mysqli_fetch_assoc($categorias)) :?>
                    <li>
                        <a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a>
                    </li>
                <?php endwhile; ?>
                <li>
                    <a href="index.php">Sobre mi</a>
                </li>
                <li>
                    <a href="index.php">Contacto</a>
                </li>
            </ul>
        </nav>
        
        <div class="clearfix"></div>
        
    </header>
    
    <div id="contenedor">