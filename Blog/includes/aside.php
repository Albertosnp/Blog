<!-- SIDEBAR --> 
<aside id="sidebar">
<!-- Buscador -->
        <div id="searcher" class="block-aside">
            <form action="search.php" method="POST">
                <label for="search"><h3>Buscar:</h3></label>
                <input type="text" name="search" id="search" />
                <input type="submit" value="Buscar" />
            </form>  
        </div>    
<!-- Control de variables de sesion/login-user -->
    <?php if (isset($_SESSION['user'])) { ?>
        <div id="userGood" class="block-aside">
            <h4><?='Bienvenido '.$_SESSION['user']['name'].'!!'?></h4>
            <div class="button"><b><a href="new-entry.php">Crear entrada</a></b></div>
<!--            La categorias y eliminacion de ususarios solo las puede realizar el admin -->
            <?php if (isset($_SESSION['admin'])){?>
                <div class="button"><b><a href="new-category.php">Crear categoría</a></b></div>
                <div class="button"><b><a href="delete-users.php">Eliminar usuarios</a></b></div>
                <?php } ?>
            <div class="button"><b><a href="account.php">Mi cuenta</a></b></div>
            <div class="button"><b><a href="logica/exit-session.php">Cerrar sesión</a></b></div>
        </div>
    <?php  } if(!isset($_SESSION['user'])) { ?>
        <?php if (isset($_SESSION['userIncorrect'])) { ?>
            <div id="userWrong" class="alert alert-err"><b><?=$_SESSION['userIncorrect']?></b></div>
        <?php } ?>
            <div id="login" class="block-aside">
                <form action="logica/login.php" method="POST">
                    <h4>Identifícate:</h4>
                    <label for="user">Usuario:</label>
                    <input type="text" name="user" id="user" />
                    <label for="password2">Contraseña:</label>
                    <input type="password" name="password" id="password2" />
                    <input type="submit" value="Entrar" />
                </form>  
            </div>
            <div id="register" class="block-aside">
                <form action="logica/register.php" method="POST">
                    <h4>Regístrate:</h4>
                    <!-- Mostrar errores -->
                    <?php if(isset($_SESSION['completado'])){ ?>
                        <div class="alert"><?= $_SESSION['completado']; ?></div>
                    <?php } if(isset($_SESSION['errores']['general'])){ ?>
                        <div class="alert alert-err" ><?= $_SESSION['errores']['general']; ?></div>
                    <?php } ?>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" />
                    <?php  echo isset($_SESSION['errores'])?mostrarError($_SESSION['errores'],'email'):'' ?>
                    <label for="username">Nombre de usuario:</label>
                    <input type="text" name="username" id="username" />
                    <?php  echo isset($_SESSION['errores'])?mostrarError($_SESSION['errores'],'username'):'' ?>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" />
                    <?php  echo isset($_SESSION['errores'])?mostrarError($_SESSION['errores'],'password'):'' ?>
                    <input type="submit" value="Registrarme" />
                </form>
            </div>   
    <?php } ?>
</aside>