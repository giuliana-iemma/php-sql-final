
<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/styles.css">

        <title>Maldito - Administrar</title>
</head>
<body>

<header>
        <div class="navTags">
                <nav id="nav-admin">
                        <ul>
                                <li><a href="admin.php?sec=productosAll">Productos</a></li>
                                <li><a href="admin.php?sec=usuarios">Usuarios</a></li>
                                <li><a class="btn-vista" href="index.php">Vista Usuario</a></li>
                        </ul>
                </nav>
        </div>
        
</header>
        

<main>
<h1>Administrar</h1>

<?php
        $seccion_admin = isset($_GET ['sec']) ? $_GET ['sec'] : 'productosAll';

        $secciones_validas_admin = ['create', 'productosAll', 'update', 'delete', 'usuarios', 'updateUsuarios'];

        if (!in_array($seccion_admin, $secciones_validas_admin)){
                $vista_admin = '404';
        } else{
                $vista_admin = $seccion_admin;
        }

        require_once "views/admin/$vista_admin.php"
?>

</main>

</body>
</html>

