<?php
    require_once 'includes/header.php';
    require_once 'logica/redirect.php';
    require_once 'includes/aside.php';
    require_once 'BBDD/functions.php';
?>
<!-- CONTENIDO PRINCIPAL -->
<div id="main">
    <h1>Mi Cuenta</h1>
    <p>Desde aquí puedes modificar tus datos.</p> <br/>
    
    <form action="logica/updateUser.php" method="POST">
        <label for="email">Nuevo email:</label>
        <input type="email" name="email" id="email" value="<?=$_SESSION['user']['email']?>"/>
        <?php  if (isset($_SESSION['errors']['email'])): ?>
               <?=mostrarError($_SESSION['errors'],'email') ?>
            <?php elseif(isset($_SESSION['modified']['email'])):?>
                <?=mostrarModificado($_SESSION['modified'],'email') ?>
        <?php endif ?>  
        <label for="username">Nuevo nombre de usuario:</label>
        <input type="text" name="username" id="username" value="<?=$_SESSION['user']['name']?>" />
        <?php  if (isset($_SESSION['errors']['userName'])){ ?>
               <?=mostrarError($_SESSION['errors'],'userName') ?>
            <?php } if(isset($_SESSION['modified']['userName'])){ ?>
                <?=mostrarModificado($_SESSION['modified'],'userName') ?>
        <?php } ?>
        <label for="password">Nueva contraseña:</label>
        <input type="password" name="password" id="password" />
        <?php  if (isset($_SESSION['errors']['password'])){ ?>
               <?=mostrarError($_SESSION['errors'],'password') ?>
            <?php }if(isset($_SESSION['modified']['password'])){ ?>
                <?=mostrarModificado($_SESSION['modified'],'password') ?>
        <?php } ?>
        <input type="submit" value="Actualizar" />
    </form>

</div>
<?php require_once 'includes/footer.php'; ?>
