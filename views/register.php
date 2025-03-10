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
}
?>

<section class="formulario-usuario">
<h1 class="formulario-usuario__titulo">Registrate</h1>

<form action="index.php?sec=register" method="post">
    <label>Nombre</label>
    <input required type="text" name="username">

    <label>Email</label>
    <input required type="email" name="email"> 
    
    <label>Contraseña</label>
    <input required type="password" name="password"> 

    <button class="btn formulario-usuario__btn" type="submit">Registrar</button>

    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        if($usuario->Register($username, $email, $password, $rol = 2)){
            echo '<p class="formulario-usuario__mensaje--exitoso">Usuario registrado con éxito</p>';
            echo '<a class="btn alternativa-usuario__btn" href="index.php?sec=login">Ingresá a tu cuenta</a>';
        }
    }
    ?>
</form>
</section>

<section class="alternativa-usuario">
    <h2>Ya tenés una cuenta?</h2>
    <a class="btn alternativa-usuario__btn" href="index.php?sec=login">Ingresá</a>
</section>


