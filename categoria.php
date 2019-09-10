<?php require_once 'includes/conexion.php'; ?> 
<?php require_once 'includes/helpers.php'; ?> 
<?php 
    $categoria_actual = conseguirCategoria($db, $_GET['id']);
    if(!$categoria_actual){
        header("Location: index.php");
    }
?>

<?php require_once 'includes/cabecera.php'; ?>  
    
<?php require_once 'includes/lateral.php'; ?> 
       
<!-- CAJA PRINCIPAL -->
       <div id="principal">
           
           <h1>Entradas de <?= $categoria_actual['nombre']?></h1>
           
            <!-- Pasamos $db para pasarle la base de datos de la conexiona la funcion -->
                <?php $entradas = conseguirEntradas($db, null, $_GET['id']); 
                  
                   if($entradas && mysqli_num_rows($entradas) >= 1):
                       while($entrada = mysqli_fetch_assoc($entradas)):   
                ?>
                
                     <article class="entrada">
                            <a href="entrada.php?id=<?=$entrada['id']?>">
                            <h2><?= $entrada['titulo']?></h2>
                            <span class="fecha"><?= $entrada['categoria'].' | '.$entrada['fecha']?></span>
                            <p>
                                <?= substr($entrada['descripcion'], 0, 200) ?>
                            </p>
                            </a>
                     </article>
                <?php 
                    endwhile; 
                    else :
                ?>
            
            <div class="alerta">No hay entradas en esta categoría</div>
            <?php
                endif;
            ?>
           
    <?php require_once 'includes/pie.php'; ?>