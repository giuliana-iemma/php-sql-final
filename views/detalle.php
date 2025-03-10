<?php
require_once "clases/Productos.php";

$producto = new Producto();

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: REGISTRO NO ENCONTRADO');

$stmt = $producto->read($id);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row){
  echo '<section id="detalle-producto">';

    echo '<div class="detalle__img">'; 
    echo '<img alt="' . $row['nombre'] . '" src="img/' . $row['imagen'] . '">';
    echo '</div>';      

    echo '<div>'; 
      echo '<h2>' . $row['nombre']  . '</h2>';
      echo '<p>' .  $row['descripcion']. '</p>';
      echo '<p>Precio: $' .  $row['precio'] . '</p>';
      echo '<a class="btn" href="index.php?sec=carrito&accion=agregar&id={$id}">Agregar al carrito</a>';
    echo '</div>';

echo'</section>';
} else {
  echo '
  <h2>Te pedimos disculpas!</h2>
  <p>En este momento nos encontramos preparando más cosas ricas para sorprenderte. Intenta nuevamente en unos minutos</p>';
}
?>