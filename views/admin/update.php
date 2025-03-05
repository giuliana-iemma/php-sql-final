<?php
include_once 'clases/Productos.php';

$producto = new Producto();
$categoriasDisponibles = $producto->getCategorias();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){ //Si recibe por POST
   //Obtengo los datos del form
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categorias_checked = $_POST['categoria'];
    $imagen = $_POST['imagen'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

   //Actualizo el producto en la ddbb
    $producto->update($id, $nombre, $descripcion, $precio, $stock ,$imagen, $categorias_checked);

} else { //Recibe por GET
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: REGISTRO NO ENCONTRADO'); //Busco el artículo en la ddbb acorde al id obtenido en el URL

    //Leer datos en la ddbb
    $stmt = $producto->read($id);
    $row =$stmt->fetch(PDO::FETCH_ASSOC); //Los conviertoe en array asociativo

    //Asignar datos del array del producto a variables más sencillas
    $nombre =$row['nombre'];
    $descripcion = $row['descripcion'];
    $imagen = $row['imagen'];
    $precio = $row['precio'];
    $stock = $row['stock'];
    $id = $row['id'];

    //Obtener las categorías del producto desde la ddbb
    $categorias_checked = $producto->getCategoriasChecked($id);
}
?>

<h2>Editar artículo</h2>

<form action="admin.php?sec=update" method="post">
    
    <label>ID: </label>
    <input class="readonlyInput" readonly name="id" value="<?php echo $id ?>">

    <label>Nombre</label>
    <input type="text" name="nombre" value="<?php echo $nombre ?>">

    <label>Descripción</label>
    <textarea name="descripcion" placeholder="Escribe la descripción del producto"><?php echo $descripcion ?></textarea>
    
    <fieldset>
        <legend>Categorías: </legend>
        <?php
            foreach ($categoriasDisponibles as $categoria) {
                echo '<label for="' . strtolower($categoria['categoria']) . '"> ' . $categoria['categoria'] . ' </label>';
                echo '<input type="checkbox" id="' . strtolower($categoria['categoria']) . '" value="' . $categoria['id'] . '" name="categoria[]" ' . 
                (in_array($categoria['id'], $categorias_checked) ? 'checked' : '') . '>';
            }
        ?>
    </fieldset>
    
    <label>Ubicación de la imagen</label>
    <input type="text" name="imagen" value="<?php echo $imagen ?>">

    <label>Precio</label>
    <input type="number" name="precio" value=<?php echo $precio ?>>

    <label>Stock</label>
    <input type="number" name="stock" value=<?php echo $stock ?>>
    
    <input type="submit" value="Actualizar">
</form>