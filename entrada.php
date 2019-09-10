<?php require_once 'includes/conexion.php'; ?> 
<?php require_once 'includes/helpers.php'; ?> 
<?php 
    $entrada_actual = conseguirEntrada($db, $_GET['id']);
    if(!$entrada_actual){
        header("Location: index.php");
    }
?>

<?php require_once 'includes/cabecera.php'; ?>  
    
<?php require_once 'includes/lateral.php'; ?> 
       
<!-- CAJA PRINCIPAL -->
       <div id="principal">
           
           <h1><?=$entrada_actual['titulo']?></h1>
           <h2><?=$entrada_actual['categoria']?></h2>
           <h4><?=$entrada_actual['fecha']?> | <?=$entrada_actual['usuario'] ?></h4>
           <p><?=$entrada_actual['descripcion']?></p>
           
           <?php if($_SESSION['usuario'] && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']): ?>
               <br>
               <a class="boton boton-verde" href="editar_entrada.php?id=<?=$entrada_actual['id']?>">Editar entrada</a>
               <a class="boton" href="borrar_entrada.php?id=<?=$entrada_actual['id']?>">Eliminar entrada</a>   
           <?php endif; ?>
       </div>
           
    <?php require_once 'includes/pie.php'; ?>