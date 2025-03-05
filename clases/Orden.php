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

        $estado = 'incompleta'; //De base, la ordene está incompleta.
        
        //Insertamos los valores en la tabla ordenes
        $query = "INSERT INTO ordenes (fk_user_id, precio_total, estado) VALUES (:usuario, :total, :estado)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario', $userID);
        $stmt->bindParam(':total', $totalPedido);
        $stmt->bindParam(':estado', $estado);

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
    }
}