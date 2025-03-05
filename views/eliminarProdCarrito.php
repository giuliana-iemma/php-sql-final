<?php

require 'clases/Carrito.php';

$producto = new Carrito();

//Obtengo el ID del producto para eliminarlo
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Registro no encontrado');

//Elimino el artículo
if ($producto->eliminarProducto($id)) {
   header ("Location: index.php?sec=carrito");
    //Detengo la ejecución
    //exit();
    echo 'eliminado';
} else{
    echo "Error al eliminar producto";
}
?>