<h1>Editando orden</h1>

<?php

require 'clases/Orden.php';

$orden = new Orden ();
$estadosDisponibles = $orden->readAllEstados();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_GET['ordenID'])){
        $ordenID = $_GET['ordenID'];
        $estado_fk = $_POST['estado_fk'];

        $orden->modificarEstado($estado_fk, $ordenID);
        header("Location: admin.php?sec=ordenes");
    }
}

if(isset($_GET['ordenID'])){
    $ordenID = $_GET['ordenID'];
}

$estadoActual = $orden->obtenerEstado($ordenID);

echo '<form action="admin.php?sec=editarOrden&ordenID='. $ordenID.' " method="post">';

echo '<label>¿Cuál es el nuevo estado de la orden?</label> ';

echo '<select name="estado_fk" >';

foreach ($estadosDisponibles as $estado){
    echo '<option value="' . $estado['id'] . '" ' . ( $estadoActual['estado_fk'] == $estado['id'] ? 'selected' : '') . '>' . $estado['estado'] . '</option>';
}

?>

</select>
<button class="btn formulario-usuario__btn" type="submit">Actualizar estado</button>
<a class="btn alternativa-usuario__btn" href="admin.php?sec=usuarios">Volver a órdenes</a>

</form>