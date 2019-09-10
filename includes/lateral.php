<!-- BARRA LATERAL -->
       <aside id="sidebar">
           
           <?php if($_SESSION['usuario']):?>
           
                <div id="usuario-logueado" class="bloque">
                    <h3><?=$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'] ?></h3>
                    <!-- Botones -->
                    <a class="boton boton-verde" href="crear_entradas.php">Crear entradas</a>
                    <a class="boton" href="crear_categoria.php">Crear categoría</a>
                    <a class="boton boton-naranja" href="mis_datos.php">Mis datos</a>
                    <a class="boton boton-rojo" href="cerrar.php">Cerrar Sesión</a>
                </div>
           
           <?php endif; ?>
           
           <?php if(!$_SESSION['usuario']):?>
           <div id="login" class="bloque">
               <h3>Identificate</h3>
               
               <?php if($_SESSION['error_login']):?>
           
                    <div class="alerta alerta-error" class="bloque">
                        <?=$_SESSION['error_login'] ?>
                    </div>
           
               <?php endif; ?>
               
               <form action="login.php" method="POST">
                   <label for="email">Email</label>
                   <input type="email" name="email" />
                   
                   <label for="password">Contraseña</label>
                   <input type="password" name="password" />
                   
                   <input type="submit" value="Entrar" />
               </form>
           </div>
           
           <div id="register" class="bloque">
               <h3>Registrate</h3>
               
               <!-- Mostrar errores-->
               <?php if($_SESSION['completado']): ?>
               <div class="alerta alerta-exito">
                   <?= $_SESSION['completado']?>
               </div>
               <?php elseif($_SESSION['errores']['general']) : ?>
                   <div class="alerta alerta-error">
                   <?= $_SESSION['errores']['general']?>
               </div>
               <?php endif; ?>
               
               <form action="registro.php" method="POST">
                   <label for="nombre">Nombre</label>
                   <input type="text" name="nombre" />
                   <?php echo ($_SESSION['errores']) ?  mostrarError($_SESSION['errores'], 'nombre') : ''; ?>
                   
                   <label for="apellidos">Apellidos</label>
                   <input type="text" name="apellidos" />
                   <?php echo ($_SESSION['errores']) ?  mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>
                   
                   <label for="email">Email</label>
                   <input type="email" name="email" />
                   <?php echo ($_SESSION['errores']) ?  mostrarError($_SESSION['errores'], 'email') : ''; ?>
                   
                   <label for="password">Contraseña</label>
                   <input type="password" name="password" />
                   <?php echo ($_SESSION['errores']) ?  mostrarError($_SESSION['errores'], 'password') : ''; ?>
                   
                   <input type="submit" name="submit" value="Registrar" />
               </form>
               
               <?php borrarErrores(); ?>
           </div>
           <?php endif; ?>
       </aside>
