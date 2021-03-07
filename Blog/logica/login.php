<?php session_start();
require_once '../BBDD/bdconfg.php';
//si el usuario introduce datos en apartado de login
if (isset($_POST)) {

    //Se recogen los valores que el usuario ha introducido (identificate),
    $user = isset($_POST['user']) ? addslashes(trim(htmlspecialchars($_POST['user']))):'';
    $password = isset($_POST['password'])? addslashes(trim(htmlspecialchars($_POST['password']))):'';

    //Si el campo de username y pass no son vacios...
    if (!empty($user) && !empty($password)) {

        $cnn = mysqli_connect(HOST,USER,PASS,BBDD);
        $rest = mysqli_query($cnn, "SELECT * FROM USUARIOS WHERE name='$user';");

        if (mysqli_num_rows($rest) === 1) {
            //saca la info del usuario
            $user = mysqli_fetch_assoc($rest);

            //Verifica si la contraseña introducida es igual a la encriptada
            if(password_verify($password,$user['password'])) {
                //Variable de sesion que guarda toda la info del usuario
                $_SESSION['user']= $user;
                //Autenticacion de administrador
                if ($user['type'] === 'e') {
                    $_SESSION['admin']= $user;
                }
            } else {
                $_SESSION['userIncorrect'] = "Password incorrecta";
            }
        } else {
            //En caso de que el username no es correcto
            $_SESSION['userIncorrect'] = "El usuario no es correcto";
        }
    }   
}
header('Location:../index.php'); //Redireccionamiento
