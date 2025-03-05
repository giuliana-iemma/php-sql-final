<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva completada!</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>

<?php

//Le agrego los datos obtenidos del form a una variable
$datos_formulario = $_POST;

//DUDA: POrque hacemos este if?
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
//Almaceno cada dato en una variable
$nombre = $_POST ['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$fecha = $_POST['fecha'];
$sucursal = $_POST['sucursal'];

echo '<section id="formEnviado">';
echo '<h1>Reserva realizada!</h1>';
echo '<p>A nombre de: ' . $nombre . ' '. $apellido .'</p>';
echo '<p>Correo electrónico: ' . $email . '</p>';
echo '<p>Fecha de la reserva: ' . $fecha . '</p>';
echo '<p>Sucursal: ' . $sucursal . '</p>';

echo '<a href=index.php?sec=home>Volver al inicio</a>';

echo '</section>';
}

?>

<footer>
        <div class=redes>
            <h2>Contacto</h2>
            <ul>
                <li><a href="#"><span>Instagram</span></a></li>
                <li><a href="#"><span>Facebook</span></a></li>
                <li><a href="#"><span>Whatsapp</span></a></li>
            </ul>
        </div>

        <div>
        <h2>Locales</h2>
            <ul>
                <li>Av. Callao 1256, CABA</li>
                <li> Florida 500, CABA</li>
                <li>Figueroa Alcorta 2300, CABAs</li>  
            </ul>
        </div>
    </footer>
    </div>
</body>
</html>

