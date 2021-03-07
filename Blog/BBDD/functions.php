<?php
require_once 'bdconfg.php';

//funcion que devolverá el error correspondiente si lo hay o cadena vacia si no hay error
function mostrarError($errores, $campo){
    $alerta = ""; //Variable inicializada vacia
    if (isset($errores[$campo]) && !empty($campo)) {
        return "<p class='alert alert-err'>$errores[$campo]</p>";
    }
    return $alerta;
}
//Funcion que retorna los campos actualizados
function mostrarModificado($modified, $campo){
    $alerta = "";
    if (isset($modified[$campo]) && !empty($campo)) {
        return "<p class='alert'>$modified[$campo]</p>";
    }
    return $alerta;
}

//Funcion que borra los errores
function borrarErrores(){

    if (isset($_SESSION['errores'])) {
        unset($_SESSION['errores']);//  Libera la variable pasada por parametro
    }
    if (isset($_SESSION['completado'])) {
        unset($_SESSION['completado']);//  Libera la variable pasada por parametro
    }
    if (isset($_SESSION['userIncorrect'])) {
        unset($_SESSION['userIncorrect']);//  Libera la variable pasada por parametro
    }
    if (isset($_SESSION['errors'])) {
        unset($_SESSION['errors']);
    }
}

//Funcion que extrae las categorias que hay en la Bd: Devuelve un array en bruto
function getCategorias(){
    $cnn = mysqli_connect(HOST,USER,PASS,BBDD);
    if ($cnn){
        $query = "SELECT * FROM CATEGORIAS ORDER BY id;";
        $rest = mysqli_query($cnn,$query);
        $categorias = [];
        while ($categoria = mysqli_fetch_assoc($rest)) {
            $categorias[] = $categoria;
        }
        mysqli_close($cnn);
    }
    return $categorias;
}
//Funcion que extrae la categoria correspondiente al id pasado por parametro
function getSingleCategoria($id){
    $cnn = mysqli_connect(HOST,USER,PASS,BBDD);
    if ($cnn){
        $query = "SELECT * FROM CATEGORIAS WHERE id='$id';";
        $rest = mysqli_query($cnn,$query);
        $categoria = [];
        if ($rest && mysqli_num_rows($rest) >= 1 ) {
            $categoria = mysqli_fetch_assoc($rest);
        }
    }
    return $categoria;
}

//Funcion que retorna las entradas segun parametros: (todas - limit4) o segun categoria
function getEntries($limit = null,$categoria = null, $search = null){

    $cnn = mysqli_connect(HOST,USER,PASS,BBDD);
    if ($cnn){
        $query = "SELECT e.*, c.name 'categoria' FROM ENTRADAS e INNER JOIN  CATEGORIAS c ON e.id_category = c.id ";
        if (!empty($categoria)) {
            $query .= "WHERE e.id_category='$categoria' ";
        }
        //condicion para el motor de busqueda: solo para titulo de entradas
        if (!empty($search)) {
            $query .= "WHERE e.title LIKE '%$search%' ";
        }
        $query .= "ORDER BY e.date DESC ";
        if ($limit) {
            // establece limite de busqueda
            $query .= "LIMIT 4";
        }
        //Ejecucion de la query
        $rest = mysqli_query($cnn,$query);
        $entradas = [];
        if ($rest && mysqli_num_rows($rest) >= 1) {
            while ($entrada = mysqli_fetch_assoc($rest)){
                $entradas[] = $entrada;
            }
        }
        mysqli_close($cnn);
    }
    return $entradas;
}

//Funcion que ejecuta la query "DELETE" pasada por parametro -> elimina una entrada
function deleteEntry($query){
    $cnn = mysqli_connect(HOST,USER,PASS,BBDD);
    $respuesta = false;
    if ($cnn){
        $rest = mysqli_query($cnn, $query);
        if ($rest) $respuesta = true;
        else $respuesta = false;
    }
    mysqli_close($cnn);
    return $respuesta;
}

//Funcion que extrae la categoria correspondiente al id pasado por parametro
function getSingleEntry($id){
    $cnn = mysqli_connect(HOST,USER,PASS,BBDD);
    if ($cnn){
        $query = "SELECT e.*, c.name 'categoria', u.name 'nombre' FROM ENTRADAS e 
                    INNER JOIN  CATEGORIAS c ON e.id_category = c.id
                    INNER JOIN  USUARIOS u ON u.id = e.id_user
                    WHERE e.id = '$id';";
        $rest = mysqli_query($cnn,$query);
        $entrada = array();
        if ($rest && mysqli_num_rows($rest) >= 1 ) {
            $entrada = mysqli_fetch_assoc($rest);
        }
    }
    return $entrada;
}

//Funcion que ejecuta la query pasada por parametro --> entradas , categorias , usuarios
function saveObject($query){
    //La bd esta configurada para que el nombre de la entrada sea unico, es decir hay doble comprobacion
    $cnn = mysqli_connect(HOST,USER,PASS,BBDD);
    $respuesta = false;
    if ($cnn){
        $rest = mysqli_query($cnn, $query);
        if ($rest) return true;
    }
    if (mysqli_errno($cnn) === 1062) $respuesta = 1062;
    mysqli_close($cnn);
    return $respuesta;
}
//funcion que devuelve todos los usuarios de la bbdd
function getUsuarios(){
    $cnn = mysqli_connect(HOST,USER,PASS,BBDD);
    if ($cnn){
        $users=[];
        $query = "SELECT * FROM USUARIOS";
        $rest = mysqli_query($cnn, $query);
        if ($rest){
            while ($user = mysqli_fetch_assoc($rest)){
                $users[] = $user;
            }
        }
    }
    return $users;
}