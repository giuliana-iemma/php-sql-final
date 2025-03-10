<?php
require_once './clases/Usuario.php';

//Me fijo si hay efectivamente una sesión iniciada
if(!isset($_SESSION['email'])){
    //Si no hay una sesión iniciada, se lo indico al usuario para que entienda por qué lo redirigí a esta página.

    if (isset($_GET['from']) && $_GET['from'] == 'carrito') {
        echo '<p>Recordá que debes iniciar sesión para poder comprar</p>';
    }
}

if(!isset($_SESSION['email'])) { 
?>

<section class="formulario-usuario">
    <h1>Bienvenido/a</h1>

        <form action="index.php?sec=login" method="post">
        <label>Email</label>
        <input type="email" name="email"> 

        <label>Contraseña</label>
        <input type="password" name="password"> 

        <button class="btn formulario-usuario__btn" type="submit">Ingresar</button>

        <?php 
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
                    echo '<p class="formulario-usuario__mensaje--error">Email o contraseña incorrectos</p>';
                }
            }
        ?>
    </form>
</section>

<section class="alternativa-usuario">
    <h2>Todavía no tenés una cuenta?</h2>
    <a class=" btn alternativa-usuario__btn" href="index.php?sec=register">Registrate</a>
</section>


<?php } else {
    echo '<section>';
        echo '<h1>Hola '. $_SESSION['username'].'!</h1>';
        echo '<div class="navTags navTags--left">';
            echo '<a class="navTags__btn navTags__btn--primary" href="index.php">Visitar la web</a>';
            
            echo '<a class="navTags__btn" href="index.php?sec=logout">Cerrar sesión</a>';
        echo '</div>';
     
    echo '</section>';
   
}
   
?> 