<?php session_start();
require_once '../BBDD/bdconfg.php';
require_once '../BBDD/functions.php';
//Si el usuario que quiere borrar la entrada es el admin, lo hace directamente
if(isset($_SESSION['user']) && isset($_GET['id'])){
    $entryId = $_GET['id'];
    $userId = $_SESSION['user']['id'];

    if (isset($_SESSION['admin'])) {
        $query = "DELETE FROM ENTRADAS WHERE id='$entryId';";
        $rest = saveObject($query);
        if($rest) echo 'Se ha eliminado correctamente';
        else echo 'No se ha eliminado';
    }else{
        $query = "DELETE FROM ENTRADAS WHERE id='$entryId' AND id_user='$userId';";
        $rest = saveObject($query);
        if($rest) echo 'Se ha eliminado correctamente';
        else echo 'No se ha eliminado';
    }

}
header("Location:../index.php");