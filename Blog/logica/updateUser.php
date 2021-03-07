<?php session_start();
require_once '../bbdd/bdconfg.php';
require_once '../bbdd/functions.php';

if (isset($_POST)) {

    //VAlidacion
    $email = isset($_POST['email'])? addslashes(trim(htmlspecialchars($_POST['email']))) : false;
    $userName = isset($_POST['username'])? addslashes(trim(htmlspecialchars($_POST['username']))) : false; //Se usa trim para limpiar posibles espacios
    $password = isset($_POST['password'])? addslashes(trim(htmlspecialchars($_POST['password']))) : false;
    $user = $_SESSION['user']; //Me traigo el usuario que tiene sesion abierta
    
    //Arrays de informacion: errores y modificados
    $errors = [];
    $modified = [];
    //Comprobacion - actualizacion del email del usuario
    if (!empty($email)) {
        //Validacion de email
        if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $query = "UPDATE USUARIOS SET email='$email' WHERE id=".$user['id'].";";
            $rest = saveObject($query);
            if ($rest) {
                $modified['email'] = 'Email actualizado';
                $_SESSION['user']['email'] = $email;
            }
            if ($rest === 1062)$errors['email'] = 'El email ya existe';
        }else $errors['email'] = 'El email introducido no es válido';
    }
    //Comprobacion - actualizacion del nombre de usuario
    if (!empty($userName)) {
        if (!is_numeric($userName)) {
            $query = "UPDATE USUARIOS SET userName='$userName' WHERE id=".$user['id'].";";
            $rest = saveObject($query);
            if ($rest) {
                $modified['userName'] = 'Nombre de usuario actualizado';
                $_SESSION['user']['userName'] = $userName;
            }
            if ($rest === 1062)$errors['userName'] = 'El nombre de usuario ya existe';
        }else $errors['userName'] = 'Nombre de usuario no válido';   
    }
    //Comprobacion - actualizacion del password del usuario
    if (!empty($password)) {
        if (!is_numeric($password)) {
            //Se encripta la contraseña
            $passEncrypt = password_hash($password, PASSWORD_BCRYPT);
            $query = "UPDATE USUARIOS SET password='$passEncrypt' WHERE id=".$user['id'].";";
            $rest = saveObject($query);

            if ($rest) $modified['password'] = 'Contraseña actualizada';
            else $errors['password'] = 'Error al guardar la contraseña';
        }else $errors['password'] = 'La contraseña no es válida';
    } 
    $_SESSION['errors'] = $errors;
    $_SESSION['modified'] = $modified;  
}
header('Location: account.php');
