<?php session_start()?>
<?php require_once 'BBDD/functions.php';
//require_once 'logica/redirect.php';?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Alberto Sanchez de la nieta" />
    <meta name="generator" content="PHPStorm" />
    <meta name="description" content="Blog con PHP" />
    <meta name="keywords" content="PHP,php,blog,backend,progrmacion,web,html,css" />
    <link rel="stylesheet" href="assets/css/style.css" type="text/css" />
    <title>Blog</title>
</head>

<body>
    <!-- CABECERA -->
    <header id="header">
        <!-- MENU -->
        <div id="nav">
            <ul>
                <!-- LOGO -->
                <li id="logo"><a href="index.php">BLOG</a></li>
                <li ><a href="index.php">INICIO</a></li>
                <?php
                $categorias = getCategorias(); //funcion que ya devuelve un array asociativo
                if (empty($categorias)){ ?>
                    <p>No hay Categorías</p>
                <?php } else { ?>
                    <?php foreach ($categorias as $categoria) { ?>
                        <li>
                            <a href="category.php?id=<?=$categoria['id']?>">
                                <?=$categoria['name']?>
                            </a>
                        </li>
                    <?php }?>
                <?php } ?>
            </ul>
        </div>
        <div class="clearfix"></div>
    </header>
    <div id="container">
