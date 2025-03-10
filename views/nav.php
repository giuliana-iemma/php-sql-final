<?php
    session_start();

    $rol = isset($_SESSION['email']) ? (int) $_SESSION['rol'] : null;
    $username = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['username']) : null;
    $userID = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['user_id']) : null;

?>

    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?sec=home"><span>Maldito Café</span> </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

         
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        

            <?php if (isset($_SESSION['email'])){
                    echo '<li class="nav-item dropdown">';

                    echo ' <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">'.$username .'</a>';

                    echo '<ul class="dropdown-menu">';

                   /*  echo '<li class="nav-item "><a class="nav-link  nav-link--user" href="index.php?sec=login"><img class="nav-user-icon" src="./img/iconos/taza.png"/><span> ' . $username . '</span> </a>  </li>'; */

                    echo '<li class="dropdown-item"><a class="nav-link active" aria-current="page" href="index.php?sec=ordenes&userID=' . $userID . '"><span>Mis ordenes</span></a></li>';        
                    
                    echo '<li class="dropdown-item"><a class="nav-link active" aria-current="page" href="index.php?sec=logout"><span>Cerrar sesión</span></a></li>';
                      
                
                if ($rol === 1){
                    echo '<li class="dropdown-item"><a class="nav-link" href="admin.php">Administrar</a></li>';
                } 
                echo '</ul>';
            }
            echo '</li>';
                ?>
              
              <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?sec=home">Inicio</a></li>
                <li><a class="nav-item" href="index.php?sec=productos">Productos</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?sec=contacto">Contacto</a></li>

                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?sec=carrito"><span>Carrito</span></a></li>
          
                </ul>
            </div>
        </div>
    </nav>
</header>
    
    
