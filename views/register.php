<?php
require_once './clases/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    /* Si lo que viene por server, puntualmente lo que es el request method, es estrictamente igual a 'POST', almacenamos en diferentes variables lo que viene del form  */

    //Almaceno la info en variables
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $categoria = $_POST['categoria'];

    //Creo un nuevo objeto de la clase Usuario
    $usuario = new Usuario();

    //Llamamos al método register y le paso los datos obtenidos del form
    //$usuario->Register($nombre, $email, $password);

    if($usuario->Register($username, $email, $password, $rol = 2)){
        echo "Usuario registrado";
    }

}
?>

<h1>Registrate</h1>

<form action="index.php?sec=register" method="post">
    <label>Nombre</label>
    <input required type="text" name="username">

    <label>Email</label>
    <input required type="email" name="email"> <br>
    
    <label>Contraseña</label>
    <input required type="password" name="password"> <br>

    <label>Categoría</label>
    <!-- <select required name="categoria">
        <option value="1">Administrador</option>
        <option value="2">Usuario</option>
    </select> -->
    <button type="submit">Registrar</button>
</form>

<h2>Ya tenés una cuenta?</h2>
<a href="index.php?sec=login">Ingresá</a>