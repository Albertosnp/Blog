<?php session_start();
require_once '../BBDD/bdconfg.php';
require_once '../BBDD/functions.php';
if (isset($_POST['Guardar'])) {

    //validacion de lo que viene por post  contra inyeccion sql
    $nameEntry = isset($_POST['title']) ? addslashes(trim(htmlspecialchars($_POST['title']))) : false;
    $category = isset($_POST['category'])? $_POST['category']: false;
    $text = isset($_POST['text'])? addslashes(trim(htmlspecialchars($_POST['text']))) : false;
    $user = $_SESSION['user']['id'];

    //Array para guardar los posibles errores
    $errors = [];
    //Validacion del nombre: No numerico, no vacio / no false
    if (($nameEntry === false) || empty($nameEntry) || is_numeric($nameEntry)) {
        $errors['title'] = 'El título de la entrada no es válido.';
    }
    if ($category === false) { //Validcion de categoria: no false
        $errors['category'] = 'La categoría no es válida.';
    }
    if (($text === false) || empty($text))  {//Validacion de texto: no false / no vacio
        $errors['text'] = 'El texto no es válido.';
    }
    //Si no hay errores
    if(empty($errors)){
        //Si se le llama desde la pagina de editar entrada hara un UPDATE
        if(isset($_GET['edit'])){
            $id_entry = $_GET['edit'];
            if(isset($_SESSION['admin'])){
                //Query especial para el administrador
                $query = "UPDATE ENTRADAS SET id_category='$category', title='$nameEntry', description='$text' 
                        WHERE id='$id_entry'";
            }else $query = "UPDATE ENTRADAS SET id_category='$category', title='$nameEntry', description='$text' 
                        WHERE id='$id_entry' AND id_user='$user';";

        }else $query = "INSERT INTO ENTRADAS VALUES (NULL,'$nameEntry','$text',CURDATE(),'$user','$category');";

        $_SESSION['errors'] = $errors;

        $rest = saveObject($query);

        if ($rest) $entryCorrect = 'La entrada se ha guardado con éxito.';
        if ($rest === 1062) {
            $errors['duplicated'] = 'La entrada ya existe en la BD.';
            //Mostrará el tipo de error en el formulario
            $_SESSION['errors'] = $errors;
            header('Location: ../new-entry.php'); //Vuelve a redireccionar a nueva entrada
        }else{
            $errors['noInsert'] = 'No se ha podido insertar';
            $_SESSION['errors'] = $errors;
            header('Location: ../new-entry.php'); //Vuelve a redireccionar a nueva entrada
        }

       header('Location: ../index.php'); //Redireccion a index

    }else {
        //mostrara el mensaje correspondiente
        $_SESSION['errors'] = $errors;
        //redireccionara a la pagina correspondiente
        if(isset($_GET['edit']))
            header('Location: ../edit-entry.php?id='.$_GET['edit']);
        else
            header('Location: ../new-entry.php');

    }
}