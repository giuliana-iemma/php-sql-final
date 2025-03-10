<?php
session_start();

//Destruimos las variables creadas por la sesión
session_unset();

//Destruimos la sesión
session_destroy();
header ('Location: index.php');
?>