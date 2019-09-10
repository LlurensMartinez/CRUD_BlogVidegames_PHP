<?php require_once 'includes/cabecera.php'; ?>  
    
<?php require_once 'includes/lateral.php'; ?> 
       
<!-- CAJA PRINCIPAL -->
       <div id="principal">
           <h1>Todas entradas</h1>
           
            <!-- Pasamos $db para pasarle la base de datos de la conexiona la funcion -->
                <?php $entradas = conseguirEntradas($db) ?>
                <?php while($entrada = mysqli_fetch_assoc($entradas)) :?>
                     <article class="entrada">
                            <a href="entrada.php?id=<?=$entrada['id']?>">
                            <h2><?= $entrada['titulo']?></h2>
                            <span class="fecha"><?= $entrada['categoria'].' | '.$entrada['fecha'].' | '.$entrada['nombre_usuario']?></span>
                            <p>
                                <?= substr($entrada['descripcion'], 0, 200) ?>
                            </p>
                            </a>
                     </article>
                <?php endwhile; ?>
           
    <?php require_once 'includes/pie.php'; ?>