<?php session_start();
require_once '../BBDD/bdconfg.php';
require_once '../BBDD/functions.php';
//solo puede borrar usuarios el administrador del blog
if(isset($_SESSION['admin']) && isset($_POST['eliminar'])){

    $userId = $_POST['user'];
    $query = "DELETE FROM USUARIOS WHERE id=$userId";
    $rest = saveObject($query);
    if ($rest) echo 'Eliminado con exito';
    else echo 'No se ha podido eliminar';

}
header("Location:../index.php");