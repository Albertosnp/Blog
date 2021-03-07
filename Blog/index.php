<?php
require_once 'includes/header.php';
require_once 'includes/aside.php'; ?>
<!-- CONTENIDO PRINCIPAL -->
<div id="main">
    <h1>Últimas entradas</h1>
    <?php $entradas = getEntries(true);
    //mensaje si trae un array vacio
    if (empty($entradas)){ ?>
        <p>No hay entradas.</p>
    <?php } else { ?>
        <!-- Para cada entrada se mete en un array asociativo para sacar su info -->
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
    <div id="allEntry">
        <a href="entries.php">Ver todas las entradas</a>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>
