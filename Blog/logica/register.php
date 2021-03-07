<?php session_start();
// Incluye constantes de bbdd
require_once '../BBDD/bdconfg.php';
require_once '../BBDD/functions.php';
    //Si el usuario ha dado al boton de registrarme entrará
if (isset($_POST)) {

    //Se recogen los valores que el usuario ha introducido, se incluye validacion contra inyeccion sql
    $userName = isset($_POST['username'])? addslashes(trim(htmlspecialchars($_POST['username']))) : false;
    $password = isset($_POST['password'])? addslashes(trim(htmlspecialchars($_POST['password']))) : false;
    $email = isset($_POST['email'])? addslashes(trim(htmlspecialchars($_POST['email']))) : false;

    //Array de errores:  asociativo
    $errores = [];

    //Validacion de datos recogidos
    //Valida el nombre de usuario: que no sea vacio y que no sea solo numerico
    if (!empty($userName) && !is_numeric($userName)) {
        $userName_validate = true;
    }else{
        $errores['username'] = "El nombre de usuario no es válido.";
        $userName_validate = false;
    }
    //Valida la contraseña: que no sea vacia y que no sea solo numerico
    if (!empty($password) && !is_numeric($password)) {
        $password_validate = true;
    }else{
        $errores['password'] = "La contraseña no es válida.";
        $password_validate = false;
    }
    //Valida el email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validate = true;
    }else{
        $errores['email'] = "El email no es válido.";
        $email_validate = false;
    }
    // si no hay errores de validacion...
    if (empty($errores)) {
        //Cifra la contraseña del usuario => PARAMETROS (CONTRASEÑA,ENCRIPTADO,PASADAS DE ENCRIPTADO(POR DEFECTO SI SE OMITE=10))
        $passwordSegura = password_hash($password, PASSWORD_BCRYPT);
        //Se monta la query
        $sql = "INSERT INTO USUARIOS VALUES (null,'$userName','$email','$passwordSegura',CURDATE(),'c');";
        //Llamada funcion que ejecuta el registro del usuario, devuelve boolean
        $rest = saveObject($sql);

        //insertado -> registrado
        if ($rest === true) {
            $_SESSION['completado'] = 'El registro se ha completado con exito.';
        }
        //Usuario duplicado
        if ($rest === 1062)  //Error correspondiente a entradas duplicadas (1062)
            $_SESSION['errores']['general'] = 'El email o nombre de usuario ya está registrado.';
//        else
//            $_SESSION['errores']['general'] = 'No se ha podido dar de alta';

    }else
        $_SESSION['errores'] = $errores; //Variable global
}

header('Location: ../index.php'); //Redireccionamiento
