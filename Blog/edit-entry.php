<?php require_once 'includes/header.php'; ?>
<?php require_once 'logica/redirect.php'; ?>
<?php 
    //Redireccion a index si se intenta acceder a un id que no existe por (GET)
    $entry = getSingleEntry($_GET['id']);
    if (!isset($entry['id'])) header("Location: index.php");

require_once 'includes/aside.php' ;?>
<!-- CONTENIDO PRINCIPAL -->
<div id="main">
    <h1>Editar entrada</h1>
    <p>Desde aquí puedes editar: <?=$entry['title']?></p> <br/>
    <?php echo isset($_SESSION['errors']['duplicated'])? mostrarError($_SESSION['errors'],'duplicated'):'';?>
    <form action="logica/save-entry.php?edit=<?=$entry['id']?>" method="POST">
        <label for="title">Nuevo título de la entrada:</label>
        <input type="text" name="title" id="title" value="<?=$entry['title']?>"/>
        <?php echo isset($_SESSION['errors']['title'])? mostrarError($_SESSION['errors'],'title'):'';?>
        <label for="category">Selecciona la categoría a la que corresponde la nueva entrada.</label>
        <select name="category" id="category" required="required"> 
            <?php $categorias = getCategorias();
                    foreach ($categorias as $categoria) { ?>
                        <option value="<?=$categoria['id']?>"<?=($categoria['id'] == $entry['id_category'])? 'selected="selected"':'' ?>>
                            <?=$categoria['name']?>
                        </option>
                    <?php  } ?>
        </select>
        <?php echo isset($_SESSION['errors']['category'])? mostrarError($_SESSION['errors'],'category'):'';?>
        <label for="text">Texto de la nueva entrada:</label>
        <textarea name="text" id="text" cols="70" rows="22" required="required"><?=$entry['description']?></textarea>
        <?php echo isset($_SESSION['errors']['text'])? mostrarError($_SESSION['errors'],'text'):'';?>
        <input type="submit" value="Actualizar" name="Guardar"/>
    </form>
</div>
<?php require_once 'includes/footer.php'; ?>







