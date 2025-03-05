<?php

require 'clases/Productos.php';

$producto = new Producto();

//Obtengo el ID del producto para eliminarlo
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Registro no encontrado');

//Elimino el artículo
if ($producto->delete($id)) {
    header ("Location: admin.php");

    //Detengo la ejecución
    exit();
} else{
    echo "Error al eliminar producto";
}
?>