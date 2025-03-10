
<?php
    require_once ('clases/Orden.php');
    $orden = new Orden ();
    $ordenID = $_GET['ordenID'];
    $userID = $_SESSION['user_id'];

    $items = $orden->getItems($ordenID);
    $ordenData = $orden->readOrden($ordenID);

    if(isset($_GET['cancelada'])){
        $orden->cancelarOrden($ordenID);

        header("Location: index.php?sec=ordenes&userID=" . $userID);
        exit();        
    }
    ?>

<section>
    <h1>Mis órdenes</h1>

    <h2>Estás realizando una cancelación</h2>
    <p>¿Estás seguro que deseas cancelar?</p>

    <div class="order">
        <ul>
            <li class="order__number"><span>Orden: <?php echo  $ordenID; ?></span></li>
            <!-- Items -->
                <h3 class="order__headline">Productos</h3>
            <ul class="order__products">
                <?php
                foreach($items as $item){
                    echo '<li class="order__product">'. $item['nombre_producto'] .'</li>';
                }       
                ?>
            </ul>

            <li class="order__price"><span>Precio Total: $<?php echo  round($ordenData['precio_total']) ?></span></li>
        </ul>

        <div class="order__actions">
            <a class="btn btn-slim warn" href="index.php?sec=orden&ordenID=<?php echo $ordenID ?>&cancelada">Sí, cancelar orden</a>
            <a class="btn" href="index.php?sec=ordenes&userID=<?php echo $userID ?>">No, volver atrás</a>
        </div>
    </div>
</section>

