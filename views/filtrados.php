<div>
    <ul class="navTags navTags--center">
    <li><a class="<?= (isset($_GET['cat']) && $_GET['cat'] == 1) ? 'active' : '' ?>" href="index.php?sec=filtrados&cat=1">Café</a></li>
        <li><a class="<?= (isset($_GET['cat']) && $_GET['cat'] == 2) ? 'active' : '' ?>" href="index.php?sec=filtrados&cat=2">Pastelería</a></li>
        <li><a class="<?= (isset($_GET['cat']) && $_GET['cat'] == 5) ? 'active' : '' ?>" href="index.php?sec=filtrados&cat=5">Cápsulas</a></li>
        <li><a class="<?= (isset($_GET['cat']) && $_GET['cat'] == 6) ? 'active' : '' ?>" href="index.php?sec=filtrados&cat=6">Vegano</a></li>
        <li><a class="<?= (isset($_GET['cat']) && $_GET['cat'] == 7) ? 'active' : '' ?>" href="index.php?sec=filtrados&cat=7">Sin TACC</a></li>
        <li><a class="<?= (!isset($_GET['cat'])) ? 'active' : '' ?>" href="index.php?sec=productos">Ver todos</a></li>       
    </ul>
</div>

<section id= "filtrados">
<?php
 echo '<div>';
 $categoria = isset ($_GET['cat']) ? $_GET['cat'] : die('Categoría no encontrada');
  if ($categoria == 1){
    echo ' <h2>Cafés</h2>';
  } else if ($categoria ==2){
    echo ' <h2>Pastelería</h2>';
}else if ($categoria == 5 ){
    echo ' <h2>Cápsulas</h2>';
} else if ($categoria == 6) {
    echo '<h2>Vegano</h2>';
} else if ($categoria == 7 ){
    echo '<h2>Sin TACC</h2>';
}
 echo '<div class="productos">'; 

  require 'clases/Productos.php';

  $producto = new Producto ();

  //Obtengo todos los productos y los almaceno en la variable filas
  $filas = $producto->readCat($categoria);
//   var_dump ($filas); 
  //Leer datos
  while ($row = $filas->fetch(PDO::FETCH_ASSOC)){
    extract ($row);   
                echo '<article class="card">';
                    echo '<a class="btnDetalle" href="index.php?sec=detalle&id='. $id.'"><span>Ver</span></a>';

                        echo '<img alt="'.$nombre.'" src= "img/'. $imagen. '">';
                            echo '<div class="info-tarjeta">'; 
                                echo '<h2>' . $nombre . '</h2>';
    
                                // echo '<p class="descripcion">' . $descripcion . '</p>';
                                  /*   echo '<div class="info-extra">'; 
                                        echo '<ul>';
                                        echo '<li>' . '<span>Origen </span>'. $producto->getOrigen() . '</li>';
                                        echo '<li>' . '<span>Tamaño </span>'. $producto->getTamano() . '</li>';
                                        echo '<li>' . '<span>Intensidad </span>'. $producto->getIntensidad() . '</li>';      
                                        echo '<li>' . '<span> Tipo de grano </span>'. $producto->getTipoDeGrano() . '</li>';
                                        echo'</ul>';
                                    echo '</div>'; */
    
                                echo '<p class="precio">$ ' . $precio . '</p>';
                                echo '<a class="btn" href="index.php?sec=carrito&accion=agregar&id='.$id.'"><span>Agregar al carrito</span></a>';
                            echo '</div>';
                    echo '</article>';
                
          
           
    
  }
    

  echo '</div>';
  echo '</div>';
echo'</section>';

?>