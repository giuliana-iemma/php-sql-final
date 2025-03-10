<?php

require 'conexion.php';

class Producto 
{
//ATRIBUTOS
    private $id;
    private $categoria;
    private $nombre;
    private $descripcion;
    private $fk_opcion_comida;
    private $imagen;
    private $precio;
    private $stock;
    private $fk_opcion_bebida;

    //Variable para almacenar la conexión
    private $conn;

    //Variable para almacenar la tabla 
    private $tabla = 'productos_bar';
//CONSTRUCTOR DE CONEXIÓN
    public function __construct ()
    {
        //Creo una nueva instancia de la clase Conexión.
        $database_conexion = new Conexion();
        //Dentro de la variable $conn inicializada en este documento, obtengo la conexión a la bbdd realizada en el archivo conexion.php
        $this->conn = $database_conexion ->getConn();
    }

//MÉTODOS CRUD
    //Añadir producto nuevo
    public function create( $categorias,  $nombre, $descripcion, $imagen, $precio, $stock, /* $opcion */){
        //Asigno los valores a cada variable
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        $this->precio = $precio;
        $this->stock = $stock;
    
        //Insertamos el producto en la tabla productos_bar
            $query = "INSERT INTO $this->tabla(nombre, descripcion, imagen, precio, stock) VALUES (:nombre, :descripcion, :imagen, :precio, :stock)";

            //Preparo
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":descripcion", $descripcion);
            $stmt->bindParam(":imagen", $imagen);
            $stmt->bindParam(":precio", $precio);
            $stmt->bindParam(":stock", $stock);
    
            //Ejecuto
            if ($stmt->execute()){
                $producto_id = $this->conn->lastInsertId();  // Obtener el ID del producto recién insertado  

                //Insertamos las relaciones para categorias
                foreach ($categorias as $categoria_id){
                $query_categoria = "INSERT INTO productos_categorias (producto_fk, categoria_fk) VALUES (:producto_id, :categoria_id)";

                $stmt_categoria = $this->conn->prepare($query_categoria);
                $stmt_categoria->bindParam(":producto_id", $producto_id);
                $stmt_categoria->bindParam(":categoria_id", $categoria_id);
                $stmt_categoria->execute();
                }

                echo "Artículo agregado con categorías asociadas.";
                return true;

            } else {
                echo "Error al agregar el producto.";
                return false;
            }
    }

    //Obtener productos 
    public function readAll ()
    {
        $query = "SELECT * FROM $this->tabla";

        //Preparo
        $stmt = $this->conn->prepare($query);

        //Ejecuto
        $stmt->execute();

        return $stmt; 
    }

    //Obtener producto por id
    public function read ($id)
    {
        $query = "SELECT * FROM $this->tabla WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt ->bindParam (":id", $id);

        $stmt-> execute();
        
        //Devuelvo el restulado
        return $stmt;
    }

    //Obtener productos por categoría
    public function readCat ($categoria)
    {
        $query = "SELECT p. * FROM productos_bar p
        INNER JOIN productos_categorias pc ON p.id  = pc.producto_fk
        INNER JOIN categorias c ON pc.categoria_fk = c.id
        WHERE c.id = :categoria";

        $stmt = $this->conn->prepare($query);

        $stmt ->bindParam (":categoria", $categoria);

        $stmt-> execute();
        
        //Devuelvo el restulado
        return $stmt;
    }

    //Actualizar producto
    public function update ($producto_id, $nombre, $descripcion, $precio, $stock, $imagen, $categorias)
    {
        $query = "UPDATE $this->tabla SET nombre = :nombre, descripcion = :descripcion, precio = :precio, stock = :stock, imagen = :imagen WHERE id = :producto_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);

        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":stock", $stock);
        $stmt->bindParam(":imagen", $imagen);
        $stmt->bindParam(":producto_id", $producto_id);

        if($stmt->execute()){
            if (!is_array($categorias)) {
                echo "Error: Las categorías no están en formato de array.";
                return false;
            }

        //Borro las categorias ya presentes
            $query_delete = "DELETE FROM productos_categorias WHERE producto_fk = :producto_id";
            $stmt_delete = $this->conn->prepare($query_delete);
            $stmt_delete->bindParam(":producto_id", $producto_id);
            $stmt_delete->execute();

            //Insertamos las relaciones para categorias
            foreach ($categorias as $categoria_id){
                $query_categoria = "INSERT INTO productos_categorias (producto_fk, categoria_fk) VALUES (:producto_id, :categoria_id)";

                $stmt_categoria = $this->conn->prepare($query_categoria);
                $stmt_categoria->bindParam(":producto_id", $producto_id);
                $stmt_categoria->bindParam(":categoria_id", $categoria_id);
                
                if (!$stmt_categoria->execute()) {
                    var_dump($stmt_categoria->errorInfo()); // Verifica si hay errores en la consulta
                    return false;
                } else {
                    return true;
                }                            
                }

        } else{
            echo 'ERROR';

            return false;
        }
    }


    //Borrar producto
    public function delete ($id)
    {
        $query = "DELETE FROM $this->tabla WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam (":id", $id);

        if ($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getCategorias (){
        $query = "SELECT * FROM categorias";

        $stmt = $this->conn->prepare($query);
       
        $stmt->execute();

        if ($stmt->rowCount() > 0){
           return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getCategoriasChecked ($producto_id){
        $query = "SELECT categoria_fk FROM productos_categorias WHERE producto_fk = :producto_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam (":producto_id", $producto_id);

        $stmt->execute();
        $categorias_asignadas = $stmt->fetchAll(PDO::FETCH_COLUMN); 

        return $categorias_asignadas;
    }

    public function getCategoriasCheckedNamed ($producto_id){
        $query = "SELECT c.categoria
        FROM productos_categorias pc
        INNER JOIN categorias c ON pc.categoria_fk = c.id
        WHERE pc.producto_fk = :producto_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam (":producto_id", $producto_id);

        $stmt->execute();
        $categorias_nombradas = $stmt->fetchAll(PDO::FETCH_COLUMN); 

        return $categorias_nombradas;

    }
}