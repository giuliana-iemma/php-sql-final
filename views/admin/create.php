<h2>Create</h2>

<?php
include_once 'clases/Productos.php';

$producto = new Producto();

$categorias = $producto->getCategorias();

// var_dump ($categorias);

// Obtener las categorías disponibles desde la base de datos

if ($_SERVER['REQUEST_METHOD']=='POST') {
    //Obtengo datos del form y los asigno a las variables
    $nombre = $_POST ['nombre'];
    $categoria = $_POST ['categoria'];
    $descripcion = $_POST ['descripcion'];
    $imagen = $_POST ['imagen'];
    $precio = $_POST ['precio'];
    $stock = $_POST ['stock'];
    
    //Creo un nuevo artículo
    if ($producto->create($categoria, $nombre, $descripcion, $imagen, $precio, $stock, /* $opcion */)) {
        // Mostrar mensaje de éxito si se crea el artículo correctamente
        echo "Artículo creado exitosamente.";
        header ("Location: admin.php");
    } else {
        // Mostrar mensaje de error si no se puede crear el artículo
        echo "Error al crear el artículo.";
    }
}
?>

<form action="admin.php?sec=create" method="post">
    <label>Nombre</label>
    <input type="text" name="nombre" value=Prueba>

    <fieldset>
        <legend>Categorías: </legend>
        <?php
            foreach ($categorias as $categoria){
                echo '<label for="'. strtolower($categoria['categoria'] ).'"> '. $categoria['categoria'] .' </label>';
                echo '<input type="checkbox" id="'. strtolower($categoria['categoria'] ).'" value="'. $categoria['id'] .'" name="categoria[]">';
            }
        ?>
    </fieldset>
  
    <label>Descripción</label>
    <textarea name="descripcion" placeholder="Escribe la descripción del producto">Desc</textarea>
    
    <label>Nombre del archivo de imagen</label>
    <input type="text" name="imagen" value="Prueba">

    <label>Precio</label>
    <input type="number" name="precio" value=2>

    <label>Stock</label>
    <input type="number" name="stock" value=3>
    
    <input type="submit" value="Agregar">
</form>

<a href="admin.php">Volver</a>