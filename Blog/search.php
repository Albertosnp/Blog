<?php require_once 'includes/header.php';
if (!isset($_POST['search']))
    header("Location: index.php");
require_once 'includes/aside.php';?>
    
<!-- CONTENIDO PRINCIPAL -->
<div id="main">
    <h1>Busqueda: <?=$_POST['search']?></h1>
    <?php $entradas = getEntries(null,null,$_POST['search']);
        //mensaje si trae un array vacio
        if (empty($entradas)){ ?>
            <p>No hay entradas.</p>
        <?php } else {
            foreach ($entradas as $entrada) { ?>
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
<?php require_once 'includes/footer.php'; ?>