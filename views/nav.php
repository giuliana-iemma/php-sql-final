<?php
    session_start();

    $usuarioLogueado = isset($_SESSION['email']);
    $rol = $usuarioLogueado ? (int) $_SESSION['rol'] : null;
    $username = $usuarioLogueado ? htmlspecialchars($_SESSION['username']) : null;
?>

    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?sec=home"><span>Maldito</span> </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php if ($usuarioLogueado): ?>
                <li class="nav-item"><a class="nav-link" href="index.php?sec=login">Hola <?php echo $username; ?></a></li>

                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?sec=home">Inicio</a></li>
                <li><a class="nav-item" href="index.php?sec=productos">Productos</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?sec=contacto">Contacto</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?sec=carrito"><span>Carrito</span></a></li>
           
                
                    <?php if ($rol === 1): ?>
                        <li class="nav-item"><a class="nav-link" href="admin.php">Administrar</a></li>
                    <?php endif; ?>

                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?sec=login">Iniciar sesión</a></li>
                <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
    
    
