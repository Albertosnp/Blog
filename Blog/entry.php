<?php require_once 'includes/header.php';
require_once 'logica/redirect.php';
$entry = getSingleEntry($_GET['id']);
//Redireccion a index si se intenta acceder a un id que no existe por (GET)
if (!isset($entry['id']))
    header("Location: index.php");
require_once 'includes/aside.php' ; ?>
    
<!-- CONTENIDO PRINCIPAL -->
<div id="main">
    <h1><?=$entry['title']?></h1>
    <a href="category.php?id=<?=$entry['id_category']?>">
        <h3><?=$entry['categoria']?></h3>
    </a>
    <p><?=$entry['description']?></p>
    <p><?=$entry['date'].' | '.$entry['nombre']?></p>
    <br/>
    <?php if((isset($_SESSION['user']) && $_SESSION['user']['id'] === $entry['id_user']) || isset($_SESSION['admin'])){ ?>
        <div class="button"><b><a href="edit-entry.php?id=<?=$entry['id']?>">Editar entrada</a></b></div>
        <div class="button"><b><a href="logica/delete-entry.php?id=<?=$entry['id']?>">Borrar entrada</a></b></div>
    <?php } ?>
</div>
<?php require_once 'includes/footer.php'; ?>