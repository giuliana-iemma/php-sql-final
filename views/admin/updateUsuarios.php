<?php
include_once 'clases/Usuario.php';

$usuario = new Usuario();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Obtengo los datos del form
    $username = $_POST ['username'];
    $email = $_POST ['email'];
    $password = $_POST ['password'];
    $rol = $_POST ['rol'];
    $id = $_POST['id'];
   
    //Actualizo el producto en la ddbb
    if($usuario->update($id, $username, $email, $password, $rol)){
        header ("Location: admin.php?sec=usuarios");
    } else{
        echo "Error al actualizar";
    }
} else {
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: REGISTRO NO ENCONTRADO');

    //Leer datos
    $stmt = $usuario->getUserById($id);

    $row =$stmt->fetch(PDO::FETCH_ASSOC);

    $id = $row['id'];
    $email = $row['email'];
    $username = $row['username'];
    $password = $row['password'];
    $fk_rol = $row['fk_rol'];
    
    $rol = $usuario->obtenerRol($id, $fk_rol);
}
?>

<h1>Editar usuario</h1>

<form action="admin.php?sec=updateUsuarios" method="post">
    <input readonly type="hidden" name="id" value="<?php echo $id ?>">

    <label>Nombre</label>
    <input required type="text" name="username" value ="<?php echo $username ?>">

    <label>Email</label>
    <input required type="email" name="email" value=" <?php echo $email ?>"> 
    
    <input readonly type="hidden" name="password" value="<?php echo $password ?>"> 

    <label>Rol</label>
    <select required name="rol">
        <option <?php echo ($fk_rol == 1) ?  "selected" :  "" ; ?> value="1">Administrador</option>
        <option <?php echo ($fk_rol == 2) ?  "selected" :  "" ; ?> value="2">Cliente</option>

    </select>
    <button type="submit" value="Actualizar">Actualizar</button>
</form>

