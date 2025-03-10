<?php

include_once ('clases/Orden.php');
include_once ('clases/Carrito.php');

$orden = new Orden();
$carrito = new Carrito();

if(isset($_GET['carritoID'])){
    if(isset($_GET['userID'])){
        $carritoID =  $_GET['carritoID'];

        $orden->nuevaOrden($userID, $carritoID);

        $carrito->vaciarCarrito($carritoID);

        $ordenID = $carrito->obtenerOrden($carritoID);
    }
} else if (isset($_GET['ordenID'])){
    $ordenID =  $_GET['ordenID'];
    if(isset($_GET['userID'])){
        $userID = $_GET['userID'];
    }
}

if(isset($_GET['realizado'])){
    $ordenID =  $_GET['ordenID'];

    $orden->modificarEstado(2, $ordenID);

    header("Location: index.php?sec=ordenes&userID=" . $userID);
}
?>

<section id="ty-page">
    <h1>¡Muchas gracias por tu compra!</h1>

    <div class="ty-page__details-container">
        <h2>Detalles de pago: </h2>

        <p>Te dejamos los datos de nuestra cuenta en Mercado Pago para que puedas transferir el dinero.</p>
        
        <h3>Nuestros datos bancarios: </h3>
        <div class="ty-page__details">
            <p>Alias: maldito.cafe.mp</p>
            <p>CBU: 45467878974565468</p>
        </div>
    </div>

    <div class="ty-page__payment-fulfilled">
            <h3>¿Ya hiciste tu pago?</h3>
            <p>Si ya hiciste tu pago, podés enviarnos el comprobante para que completemos el pedido</p>

            <!-- <a href="index.php?sec=pago&ordenID=<?php echo $ordenID; ?>&realizado">Enviar por Whatsapp</a> -->

            <a class="btn" href="index.php?sec=pago&ordenID=<?php echo $ordenID; ?>&realizado">Subir comprobante</a>
        </div>
   
</section>
