<?php

?>
<section id="carrito">
<h1>Carrito de compras</h1>
<?php

require_once ('clases/Productos.php');
require_once ('clases/Carrito.php');

if(!isset($_SESSION['email'])){
  header('Location: ./index.php?sec=login');
  exit();
  };

$userID = $_SESSION['user_id'];
//echo $userID;

$carrito = new Carrito ();
$carritoID = $carrito->iniciarCarrito($userID); 

  //corroborar si el carrito esta vacío o lleno y mostrar lo que corresponda
  if ($carritoID)
  {
    //Si existe un carritoID es pq existe un carrito creado para ese cliente
    $carritoItems = $carrito->obtenerItemsCarrito($carritoID);
    //var_dump ($carritoItems);
    $totalCarrito = 0;

    if ($carritoItems){
      echo '<section class=carrito-prod>' ;

      foreach ($carritoItems as $producto){
          $totalProducto = $producto['precio'] *$producto['cantidad'];
          $totalCarrito += $totalProducto;
  
          echo'<article class="carrito-card">';
              echo'<ul>';
                  echo'<li class="img-carrito"><img src="./img/'.$producto['imagen'] .'" alt="'. $producto['nombre']. '"></li> '   ;
                  echo'<li class="nombre-carrito">'.$producto['nombre'].'</li>';
                  echo'<li class="precio-carrito">$'.$producto['precio'].'</li>';
                  echo'<li class="cantidad-carrito">'.$producto['cantidad'].'</li>';
                  echo'<li class="total-carrito">Total: '. $totalProducto.'</li>';
                  echo'<li><a href="index.php?sec=eliminarProdCarrito&id='.$producto['item_id'].'">Eliminar</a></li>';
              echo'</ul>';
          echo'</article>';

          echo '<div class="carrito-total">';
          echo '<a class="btn" href="index.php?sec=pago&userID='.$userID.'&carritoID='.$carritoID.'">Pagar</a>';

            echo '<p>Total: $'. $totalCarrito.'</p>';
            $carrito->cargarTotal($totalCarrito, $carritoID, $userID);
        echo '</div>';
      }
      echo'</section>';
    } else{
      echo '<p>El carrito está vacío</p>';
      echo '<a href="index.php?sec=productos">Ver productos</a>';
    }

        

    // Manejar la acción de agregar productos al carrito
    if (isset($_GET['sec']) && $_GET['sec'] == 'carrito' && isset($_GET['accion']) && $_GET['accion'] == 'agregar' && isset($_GET['id'])) 
    {
        $productoID = $_GET['id'];
        //echo $productoID;
        $carrito->añadirProducto($productoID, $carritoID);
        header ('Location: index.php?sec=carrito');
    } 

    //Eliminar producto

    //Obtengo el ID del producto para eliminarlo
    if (isset($_GET['sec']) && $_GET['sec'] == 'carrito' && isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id'])) {

      //Elimino el artículo
      if ($producto->eliminarProducto($id)) {
        // header ("Location: index.php?sec=carrito");
          //Detengo la ejecución
          //exit();
          echo 'eliminado';
      } else{
          echo "Error al eliminar producto";
      }
    }


  } else {
    //Error al crear el carrito
    $carritoItems = [];
    
  } 

    
?>

