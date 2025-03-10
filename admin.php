

<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="stylesheet" href="styles/styles.css">

        <title>Maldito - Administrar</title>
</head>
<body>

<?php session_start(); ?>

<header >
        <nav id="nav-admin">
                <ul class="navTags">
                        <li><a href="admin.php?sec=productosAll">Productos</a></li>
                        <li><a href="admin.php?sec=usuarios">Usuarios</a></li>
                        <li><a href="admin.php?sec=ordenes">Ordenes</a></li>
                        <li><a class="btn-vista" href="index.php">Vista Usuario</a></li>
                        <?php 
                        if(isset($_SESSION['email'])) {
                                echo '<li><a href="index.php?sec=logout">Cerrar sesión</a></li>';
                        }
                        ?>
                </ul>
        </nav>
</header>
        

<main>

<div class="mt-4 ms-4">
        <h1>Administrar</h1>

        <?php
        //  var_dump($_SESSION);

         if (isset($_SESSION['rol'])) {  
                if ($_SESSION['rol'] != '1') {
                     // No es admin, acceso denegado
                     echo 'Acceso denegado. No tienes permiso para acceder a esta área.';
                     // Redirigir al usuario si es necesario
                     header("Location: index.php?sec=forbidden");
                }
            } else {
                echo 'No has iniciado sesión. Por favor, inicia sesión para continuar.';
                header("Location: index.php?sec=forbidden");
            }


                $seccion_admin = isset($_GET ['sec']) ? $_GET ['sec'] : 'productosAll';

                $secciones_validas_admin = ['create', 'productosAll', 'update', 'delete', 'usuarios', 'updateUsuarios', 'ordenes', 'editarOrden'];

                if (!in_array($seccion_admin, $secciones_validas_admin)){
                        $vista_admin = '404';
                } else{
                        $vista_admin = $seccion_admin;
                }

                require_once "views/admin/$vista_admin.php"
        ?>
</div>

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

