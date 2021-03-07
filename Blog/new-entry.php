<?php
require_once 'includes/header.php';
require_once 'logica/redirect.php';
require_once 'includes/aside.php';
?>
<!-- CONTENIDO PRINCIPAL -->
<div id="main">
    <h1>Crear nueva Entrada</h1>
    <p>Desde aquí puedes crear una nueva entrada en el blog.</p> <br/>
    <?php echo isset($_SESSION['errors']['duplicated'])? mostrarError($_SESSION['errors'],'duplicated'):'';?>
    <form action="logica/save-entry.php" method="POST">
        <label for="title">Título de la nueva entrada:</label>
        <input type="text" name="title" id="title" placeholder="Titulo de la nueva entrada." required="required" />
        <?php echo isset($_SESSION['errors']['title'])? mostrarError($_SESSION['errors'],'title'):'';?>
        <label for="category">Selecciona la categoría a la que corresponde la nueva entrada.</label>
        <select name="category" id="category" required="required">
            <?php $categorias = getCategorias();
            foreach ($categorias as $categoria) { ?>
                <option value="<?=$categoria['id']?>"><?=$categoria['name']?></option>
            <?php } ?>
        </select>
        <?php echo isset($_SESSION['errors']['category'])? mostrarError($_SESSION['errors'],'category'):'';?>
        <label for="text">Texto de la nueva entrada:</label>
        <textarea name="text" id="text" cols="70" rows="22" required="required"></textarea>
        <?php echo isset($_SESSION['errors']['text'])? mostrarError($_SESSION['errors'],'text'):'';?>
        <input type="submit" value="Guardar" name="Guardar"/>
    </form>

</div>
<?php require_once 'includes/footer.php'; ?>

