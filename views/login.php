

<?php
require_once './clases/Usuario.php';


//Me fijo si hay efectivamente una sesión iniciada
if(!isset($_SESSION['email'])){
    //Si no hay una sesión iniciada, se lo indico al usuario para que entienda por qué lo redirigí a esta página.
    echo '<p>Recordá que debes iniciar sesión para poder comprar</p>';
}


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $usuario = new Usuario();

    if ($usuario->login($email, $password)){
        //Los datos coinciden con los datos guardados en la ddbb
        //Logramos ingresar al sistema
      header('Location: ./index.php?sec=login');
      echo $_SESSION['email'];      

    } else{
        echo 'Usuario o contraseña Incorrectos';
    }
}

if(!isset($_SESSION['email'])) { 
?>

<h1>Bienvenido/a</h1>

    <form action="index.php?sec=login" method="post">
    <label>Email</label>
    <input type="email" name="email"> <br>
    
    <label>Contraseña</label>
    <input type="password" name="password"> <br>

    <button type="submit">Ingresar</button>
</form>

<h2>Todavía no tenés una cuenta?</h2>
<a href="index.php?sec=register">Registrate</a>

<?php } else {
    echo '<h1>Hola '. $_SESSION['username'].'!</h1>';

}

if (isset($_SESSION['email'])){
    echo '<a href="index.php?sec=logout">Cerrar sesión</a>';

}?> 