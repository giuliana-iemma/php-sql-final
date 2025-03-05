<?php

class Conexion {
    //ATRIBUTOS

    //Datos para la conexión
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "maldito";

    //Declaro la conexión globalmente como protected
    protected $conn;

    //CONSTRUCTOR
    public function __construct (){
        try {
            $this->conn = new PDO ("mysql: host=$this->servername;dbname=$this->db", $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

           // echo "Conectado a la DDBB <br>";
        } catch (PDOException $e){
            echo "Conexión fallida: ". $e->getMessage();
        }
    }

    //METODOS
    public function getConn (){
        return $this->conn;
    }

     //cerrar conexion ???
     public function close() {
        $this->conn = null;
    }
}

?>