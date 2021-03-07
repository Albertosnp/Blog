<?php
//require_once 'logica/redirect.php';
require_once 'includes/header.php';
require_once 'includes/aside.php';
?>
<!-- CONTENIDO PRINCIPAL -->
<div id="main">
    <h1>Crear Categorías</h1>
    <p>Introduce nuevas categorías para clasificar las entradas.</p> <br/>
    <form action="logica/save-category.php" method="POST">
        <label for="name">Nombre de la nueva categoría:</label>
        <input type="text" name="name" id="name" placeholder="Introduce el nombre de la nueva categoria" />
        <input type="submit" value="Guardar"/>
    </form>

</div>
<?php require_once 'includes/footer.php'; ?>
