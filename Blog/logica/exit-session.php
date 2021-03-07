<?php session_start();

//se destruye la session
if (isset($_SESSION['user'])) session_destroy();
header("Location: ../index.php");

