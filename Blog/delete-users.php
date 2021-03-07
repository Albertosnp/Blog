<?php require_once 'includes/header.php'; ?>
<?php require_once 'logica/redirect.php'; ?>
<?php
if (isset($_SESSION['admin'])){

require_once 'includes/aside.php' ;?>
    <!-- CONTENIDO PRINCIPAL -->
    <div id="main">
        <h1>Selecciona el usuario a eliminar</h1>
        <form action="logica/delete-user.php" method="POST">
            <label for="users">Usuarios:</label>
            <select name="user" id="users" required="required">
                <?php $usuarios = getUsuarios();
                foreach ($usuarios as $usuario) { ?>
                    <option value="<?=$usuario['id']?>"><?=$usuario['name']?></option>
                <?php  } ?>
            </select>
            <input type="submit" value="eliminar" name="eliminar"/>
        </form>
    </div>
<?php require_once 'includes/footer.php';}
else header("Location: index.php"); ?>