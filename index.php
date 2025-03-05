<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mocca Time</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>

  <div class="container">

   <?php require_once ('views/nav.php') ?>
        
    
    <!-- <header>
        <nav>
        <ul>
            <li><a href="index.php?sec=home">Inicio</a></li>
            <li><a href="index.php?sec=productos">Productos</a></li>
            <li><a href="index.php?sec=contacto">Contacto</a></li>
            <li><a href="admin.php">Admin</a></li>
            <li><a href="views/login.php">Cuenta</a></li>
        </ul></nav>
    </header> -->

    <main>
        <?PHP 
            // Guardo en la variable vista el valor de sec tomado desde la  URL  
            // $vista = $_GET['sec']; 
            $seccion = isset($_GET ['sec']) ? $_GET['sec'] : 'home';

            // Proporciono una lista de variables válidas para evitar que el usuario pueda cargar otras vistas 
            $secciones_validas = ['home', 'formulario','locales', 'contacto', 'productos', 'productosAll', 'detalle', 'filtrados', 'login', 'register','carrito', 'logout','eliminarProdCarrito', 'pago'];

            // in_array() comprueba si existe un valor en el array 
            if (!in_array($seccion, $secciones_validas)){
                $vista = '404';
            } else {
                $vista = $seccion;
            }

        /* Le proporciono el link para que según el sec de la url, se abra la sección correpondiente */
            require_once "views/$vista.php"
        ?>
        
        
    </main>

   <?php require_once ('views/footer.php'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>