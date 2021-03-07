<?php require_once 'includes/header.php' ;?>
<?php
//Redireccion a index si se intenta acceder a un id que no existe por (GET)
$category = getSingleCategoria($_GET['id']);
if (!isset($category['id'])) {
    header("Location: index.php");
}?>
<?php require_once 'includes/aside.php';?>

    <!-- CONTENIDO PRINCIPAL -->
    <div id="main">
        <h1><?=$category['name']?></h1>
        <?php
        //Trae todas las entradas
        $entradas = getEntries(null,$category['id']);
        //Si trae un array vacio
        if (empty($entradas)) { ?>
            <p>No hay entradas.</p>
        <?php } else { ?>
            <!-- Se sacan todas las entradas de la categoria -->
            <?php foreach ($entradas as $entrada) { ?>
                <a href="entry.php?id=<?=$entrada['id']?>">
                    <article class="entry">
                        <h3><?= $entrada['title']?></h3>
                        <p align="justify">
                            <!-- substr para mostrar una pequña descripcion 180 caracteres -->
                            <?= substr($entrada['description'], 0,180).'...'?>
                        </p>
                    </article>
                    <p class="date"><?=$entrada['categoria'].' | '.$entrada['date']?></p>
                </a>
            <?php } ?>
        <?php } ?>
    </div>
<?php
//incluye el footer
require_once 'includes/footer.php';