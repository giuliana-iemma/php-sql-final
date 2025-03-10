<?php

require_once ('Conexion.php');

class Carrito 
{
    //DUDA: Es mejor hacer la conexión acá o dentro de cada método?
    private $conn;

    //Constructor
    public function __construct()
    {
        //Instanciamos la conexión y se la asignamos a la variable conn

        $bd = new Conexion();
        $this->conn = $bd->getConn();
    }

    public function iniciarCarrito ($userID)
    {
        //Código para iniciar un nuevo carrito para determinado usuario
        //Usuario
        $userID = $_SESSION['user_id'];
        
        //CONSULTA
        //Accedo a la tabla carritos y selecciono solo la información de los carritos que coincidan con el id del usuario y que aún no se haya concretado la compra
        $query = "SELECT id FROM carritos WHERE fk_user_id = :userID AND fk_estado = 1"; 

        //PREPARO
        $stmt = $this->conn->prepare ($query);
        $stmt->bindParam(':userID', $userID);

        //EJECUTO
        if($stmt->execute()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row){
                //Si hay algo en las filas significa que existe un carrito creado para ese usuario que aún está en curso.
                //Retorno el id del carrito para poder trabajar luego al mostrarlo
                return $row['id'];
                //Obtengo el ID del carrito para poder mostrar luego lo que hay dentro vinculando con la tabla carrito_items
            } else {
                $carritoEstado = 1;
                //Creo un nuevo carrito
                //CONSULTA: insertar en la tabla carrito los valores
                $query = "INSERT INTO carritos (fk_user_id, fk_estado) VALUES (:userID, :carritoEstado)";

                //PREPARO
                $stmt = $this->conn->prepare($query);

                $stmt->bindParam(':userID', $userID);
                $stmt->bindParam(':carritoEstado', $carritoEstado);

                //EJECUTO
                if ($stmt->execute()) {
                    // Retornamos el id del nuevo carrito creado
                    return $this->conn->lastInsertId();
                }
            }
        } else {
            //No se pudo crear el carrito
            return false;
        }

        //Si no lo fue, reviso qué contenido tiene ese carrito

        //Lo muestro con JOIN y la tabla carrito_items

        //Si fue completado, muestro el carrito vacío 
    }

    public function obtenerCarrito($userID){
        $query = "SELECT id FROM carritos WHERE fk_user_id = :userID AND fk_estado = 1"; 

        $stmt = $this->conn->prepare ($query);
        $stmt->bindParam(':userID', $userID);
        if($stmt->execute()){
            return $stmt;
        };

    }

    public function obtenerItemsCarrito($carritoID) //obtengo el chango
    {
        //CONSULTA: seleccionar de la tabla los elementos en los que el id del carrito sea igual al que se pasa por parámetro
        $query = "SELECT * FROM carrito_items 
        JOIN productos_bar ON carrito_items.fk_producto_id = productos_bar.id WHERE fk_carrito_id = :carritoID";
        
        //PREPARO
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':carritoID', $carritoID);

        //EJECUTO
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
           // $fila= $stmt->fetch(PDO::FETCH_ASSOC);
           // return $fila;
            /* echo'<pre>';
            var_dump ($fila);
             echo'</pre>'; */
        }

        //Retorno un array vacío si no existe
        return [];
    }

    public function añadirProducto ($productoID, $carritoID)
    {
        //Verifico si el producto está en el carrito
        //Consulta
        $query = "SELECT item_id, cantidad FROM carrito_items WHERE fk_carrito_id = :carritoID AND fk_producto_id = :productoID";

        //Preparo
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':carritoID', $carritoID);
        $stmt->bindParam(':productoID', $productoID);

        //Ejecuto
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row){
            //El producto está en el carrito
            //Le agrego uno más a cantidad
            $cantidad = $row['cantidad'] + 1;

            //Actualizo la bbdd
            $query = "UPDATE carrito_items SET cantidad = :cantidad WHERE item_id = :item_id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':item_id', $row['item_id']);
            $stmt->execute();

        } else{
            //El producto aún no está agregado al carrito
            $query = "INSERT INTO carrito_items (fk_carrito_id, fk_producto_id, cantidad) VALUES (:carritoID, :productoID, 1)";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':carritoID', $carritoID);
            $stmt->bindParam(':productoID', $productoID);
            $stmt->execute();
        }
    }
    
    public function obtenerInfoProductosCarrito($productoID) //Tomo solo un prod
    {
        $query = "SELECT * FROM productos_bar WHERE id = :producto_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':producto_id', $productoID);

        $stmt->execute();

        return $stmt;
    }

    public function eliminarProducto ($productoID)
    {
        $query = "DELETE FROM `carrito_items` WHERE item_id = :productoID";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':productoID', $productoID);

        if ($stmt->execute()){
            return true;
        } else {
            return false;
        }    
    }

    public function vaciarCarrito($carritoID)
    {
        
        $query = "DELETE FROM carrito_items WHERE fk_carrito_id = :carritoID";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':carritoID', $carritoID);
        if($stmt->execute()){
            return true;
        } else {
            echo ' error al vaciar carrito';
            return false;
        }
    }

    public function cargarTotal($total, $carritoID, $userID)
    {
        $query = "UPDATE carritos SET total = :total WHERE id = :carritoID AND fk_user_id = :userID";
            
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':carritoID', $carritoID);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
    }

    public function obtenerOrden($carritoID){
        $query = "SELECT o.* /* Seleccionamos todo de la tabla ordenes */
                FROM ordenes o 
                JOIN carritos c ON o.carrito_fk = c.id /* Unimos con la tabla carritos en la columna carrito_fk que tendrá el dato del id del carrito */
                WHERE c.id = :carritoID "; /* Siempre que el carrito del ID sea determinado */

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':carritoID', $carritoID);
        $stmt->execute();
        
        $orden = $stmt->fetch(PDO::FETCH_ASSOC);

        return $orden['orden_id']; // Devuelve solo el ID de la orden
    }
}