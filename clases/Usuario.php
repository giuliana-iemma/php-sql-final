<?php
require_once 'conexion.php';

class Usuario 
{
    private $conn;
    private $tabla = 'usuarios';

    public function __construct (){
        $bd = new Conexion();
        $this->conn =$bd->getConn();
    }

    public function Register ($nombre, $email, $password, $rol)
    {
        // Verificar si el email ya está registrado
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row){
            echo ' <p class="error-message" >Ya existe un usuario registrado con ese email</p>';
        } else {
            $query = "INSERT INTO usuarios (username, email, password, fk_rol) VALUES (:username, :email, :password, :rol)";

        $stmt = $this->conn->prepare($query);

        //Encriptación
        $password_hashed = password_hash ($password, PASSWORD_DEFAULT, ['cost'=> 10]);
      
        //Asigno los valores a las referencias
        $stmt->bindParam (":username", $nombre);
        $stmt->bindParam (":email", $email);
        $stmt->bindParam (":password", $password_hashed);
        $stmt->bindParam (":rol", $rol);

        if ($stmt->execute()){
            return true;
            echo "Registrado";
        } else{
            return false;
        }
        }
        
    }

    public function login ($email, $password)
    {
        //Ver si existe el mail en la bbdd
        $query = "SELECT * FROM usuarios WHERE email = :email";

        $stmt = $this->conn->prepare($query);

        $stmt -> bindParam (':email', $email);

        if ($stmt->execute()){
            //Existe el mail
            //Obtengo la info como array asociativo
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && password_verify($password, $row['password'])) {

                $_SESSION['email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['rol'] = $row['fk_rol'];

                var_dump($_SESSION);
                return true;
            } else {
                return false;
            }
            
        } else {
            return false;
        }
    }

    public function readAll ()
    {
        $query = "SELECT * FROM $this->tabla";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function getUserById ($id)
    {
        $query = "SELECT * FROM $this->tabla WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt ->bindParam (":id", $id);

        $stmt-> execute();
        
        //Devuelvo el restulado
        return $stmt;
    }

    public function update($id, $username, $email, $password, $rol)
    {
        $query = "UPDATE $this->tabla SET username = :username, email = :email, fk_rol = :rol, password = :password WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":rol", $rol);
        $stmt->bindParam(":id", $id);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function obtenerRol ($id_usuario, $fk_rol)
    {
        $query = "SELECT usuarios.fk_rol, roles.categoria_user FROM usuarios
        INNER JOIN roles ON usuarios.fk_rol = roles.id
        WHERE usuarios.id = :id_usuario";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_usuario", $id_usuario);

        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
}
}

?>