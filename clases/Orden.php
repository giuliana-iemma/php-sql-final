<?php

require_once ('Conexion.php');

class Orden{
    //DUDA: Es mejor hacer la conexión acá o dentro de cada método?
    private $conn;
    private $total;


    //Constructor
    public function __construct()
    {
        //Instanciamos la conexión y se la asignamos a la variable conn

        $bd = new Conexion();
        $this->conn = $bd->getConn();
    }
    
    public function nuevaOrden($userID, $carritoID)
    {
         // Verificar si ya existe una orden con el mismo carritoID
        $query = "SELECT orden_id FROM ordenes WHERE carrito_fk = :carritoID";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':carritoID', $carritoID);
        $stmt->execute();
        $ordenExistente = $stmt->fetch(PDO::FETCH_ASSOC); // Si hay una orden existente, devolverá un ID
        
        if ($ordenExistente) {
            // Si existe una orden, no crear una nueva
            echo "Ya existe una orden asociada a este carrito.";
            return; // Salir de la función sin crear una nueva orden
        }

        $totalPedido = 0;

        // Obtetenemos el precio total del carrito 
        $query = "SELECT total FROM carritos WHERE id = :carritoID";       
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':carritoID', $carritoID);
        $stmt->execute();
        $carrito = $stmt->fetch(PDO::FETCH_ASSOC); //Obtenemos un array asociativo con el resultado de la consulta

     /*    if (!$carrito) {
            die("Error: Carrito no enconrtado");
        } */

        $totalPedido = $carrito['total']; //Guardamos el total obtenido del carrito en una nueva variable.

        $estado = 1; //De base, la ordene está pendiente.
        
        //Insertamos los valores en la tabla ordenes
        $query = "INSERT INTO ordenes (fk_user_id, precio_total, estado_fk, carrito_fk) VALUES (:usuario, :total, :estado, :carritoID)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario', $userID);
        $stmt->bindParam(':total', $totalPedido);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':carritoID', $carritoID);

        $stmt->execute();

        $pedidoID = $this->conn->lastInsertId(); //Obtenemos el ID de la última fila insertada en la base de datos.

        //Obtengo los items del carrito y los precios de cada producto desde la tabla productos_bar
        $query = "SELECT carrito_items.fk_producto_id, carrito_items.cantidad, productos_bar.precio
        FROM carrito_items 
        INNER JOIN productos_bar ON carrito_items.fk_producto_id = productos_bar.id 
        WHERE carrito_items.fk_carrito_id = :carritoID";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':carritoID', $carritoID);
        $stmt->execute();

        $carritoItems = $stmt->fetchAll(PDO::FETCH_ASSOC); 


        // Inserto los detalles del pedido y calcular el total
        foreach ($carritoItems as $item) {
            // $precioProducto = $item['precio'];
            
            $query = "INSERT INTO ordenes_items (fk_orden_id, fk_producto_id, cantidad, precio) VALUES (:pedidoID, :productoID, :cantidad, :precio)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':pedidoID', $pedidoID);
            $stmt->bindParam(':productoID', $item['fk_producto_id']);
            $stmt->bindParam(':cantidad', $item['cantidad']);
            $stmt->bindParam(':precio', $item['precio']);
            $stmt->execute();
        }

        //Cambio el estado del carrito a orden emitida
        $fk_estado = 2; 
        $queryOrdenEmitida = "UPDATE carritos SET fk_estado = :fk_estado";
        $stmt = $this->conn->prepare($queryOrdenEmitida);
        $stmt->bindParam(':fk_estado', $fk_estado);

        $stmt->execute();
    }

    public function readAll(){
        //Obtengo los datos de la orden del usuario
        $queryTotal = "SELECT * FROM ordenes ORDER BY created_at DESC";

        $stmt = $this->conn->prepare($queryTotal);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function readOrdenes($userID)
    {
        $estado = 4;

        //Obtengo los datos de la orden del usuario
        $queryTotal = "SELECT * FROM ordenes WHERE fk_user_id = :userID AND estado_fk != :estado ORDER BY created_at DESC";

        $stmt = $this->conn->prepare($queryTotal);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':estado', $estado);

        $stmt->execute();

        return $stmt; /* ->fetch(PDO::FETCH_ASSOC); */    
    }

    public function readOrden($ordenID){
        $query = "SELECT * FROM ordenes WHERE orden_id = :ordenID";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ordenID', $ordenID);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getItems($ordenID)
    {
        
        $query = "SELECT oi.*, p.nombre AS nombre_producto
        FROM ordenes_items oi
        JOIN productos_bar p ON oi.fk_producto_id = p.id
        WHERE oi.fk_orden_id = :ordenID";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ordenID', $ordenID);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function cancelarOrden($ordenID){
        $estado = 4;

        $query = "UPDATE ordenes SET estado_fk = :estado
        WHERE orden_id = :ordenID";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ordenID', $ordenID);
        $stmt->bindParam(':estado', $estado);

        if($stmt->execute()){
            echo 'orden cancelada';
            return true;
        } else {
            echo ' error al cancelar';
            return false;
        }
    }

    public function obtenerEstado($ordenID){
        $query = "SELECT ordenes.estado_fk,
                        ordenes_estados.estado AS estado_nombre
                FROM ordenes
                JOIN ordenes_estados ON ordenes.estado_fk = ordenes_estados.id
                WHERE ordenes.orden_id = :ordenID";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ordenID', $ordenID);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_DEFAULT);
    }

    public function convertirEstado($estado_fk){
        $query = "SELECT * FROM ordenes_estados WHERE id = :estado_fk";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':estado_fk', $estado_fk);

        $stmt->execute();
        $estado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $estado['estado'];
    }

    public function modificarEstado($estado_fk, $ordenID){
        $query = "UPDATE ordenes SET estado_fk = :estado_fk WHERE orden_id = :ordenID";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':estado_fk', $estado_fk);
        $stmt->bindParam(':ordenID', $ordenID);

        $stmt->execute();
    }

    public function readAllEstados(){
        $query = "SELECT * FROM ordenes_estados";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
