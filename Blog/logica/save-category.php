<?php
require_once '../BBDD/bdconfg.php';
require_once '../BBDD/functions.php';

if (isset($_POST)) {
    //Validacion contra inyeccion sql
    $nameCategory = isset($_POST['name']) ? addslashes(trim(htmlspecialchars($_POST['name']))) : false;
    $errors = [];

    //Validacion del nombre: No numerico, no vacio, no false
    if (($nameCategory != false) && !empty($nameCategory) && !is_numeric($nameCategory)) {

        $query = "INSERT INTO CATEGORIAS VALUES (NULL,'$nameCategory');";
        $rest = saveObject($query);
        //Comprobacion de la ejecucion
        if ($rest) echo 'se ha guardado con exito';
        if ($rest === 1062) $errors['duplicated'] = 'la categoria ya existe en la BD.';
        else
            $errors['duplicated'] = 'la categoria ya existe en la BD.';

    }else {
        $errors['name'] = 'El nombre de categoria no es valido';
    }
    //Imprime los posibles errores y borra la variable errors al salir
    if (!empty($errors)) {
        if (isset($errors['duplicated'])) {
            echo $errors['duplicated'];
        }
        if (isset($errors['name'])) {
            echo $errors['name'];
        }
        unset($errors);
    }

}
header('Location: ../index.php');
