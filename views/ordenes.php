
    <section>
        <h1>Ordenes de compra</h1>
        <div id="ordenes">
        <?php
    require_once ('clases/Orden.php');

    $orden = new Orden ();
    $userID = $_GET['userID'];

    $ordenes = $orden->readOrdenes($userID)->fetchAll(PDO::FETCH_ASSOC);

  
    foreach ($ordenes as $ordenData){
        // print_r($ordenData);
        // echo $orden['orden_id'];
       $items = $orden->getItems($ordenData['orden_id']);
       $estado_fk = $ordenData['estado_fk'];

        echo '<article class="order">';
            echo '<h2 class="order__title   ">Orden n° '.$ordenData['orden_id'] .' </h2>';
        echo '<ul>';
        foreach($items as $item){
            echo '<li>'. $item['nombre_producto'] .'</li>';
        }           
        echo  '</ul>';
        echo '<p><span>Precio total: </span>$'. round($ordenData['precio_total'] ). ' </p>';
        echo '<p><span>Estado: '. $orden->convertirEstado($estado_fk).'</span></p>';

        echo'<div class="order__actions">';
                if($estado_fk !== 3 && $estado_fk !== 2){
                    echo '<a class="btn order__btn" href="index.php?sec=pago&ordenID=' . $ordenData['orden_id']. '&userID='. $userID .'">Pagar</a>';
                    echo '<a class="btn order__btn order__btn--secondary" href="index.php?sec=orden&ordenID='.$ordenData['orden_id'].'&cancelarOrden">Cancelar orden</a>';
                }
                
        echo '</div>';
           
        echo '</article>';
        
    }
    ?>

        </div>
    </section>
   

