<h1>Muchas gracias por tu compra</h1>
<?php

include_once ('clases/Orden.php');
include_once ('clases/Carrito.php');

$orden = new Orden();
$carrito = new Carrito();

$carritoID =  $_GET['carritoID'];
// echo $carritoID;

$userID = $_GET['userID'];
// echo $userID;

$orden->nuevaOrden($userID, $carritoID);
?>

<section>
    <div>
        <h2>Detalles de pago</h2>
    </div>

    <div>
        <p>Te dejamos los datos de nuestra cuenta en Mercado Pago para que puedas transferir el dinero.</p>

        <h2>Nuestros datos bancarios: </h2>
    </div>

    <div>
        <p>Si ya hiciste tu pago, podés enviarnos el comprobante para que completemos el pedido</p>
        <a href="">Enviar por Whatsapp</a>
        <a href="">Enviar por mail</a>
    </div>
</section>
