
<?php
    require 'clases/Productos.php';
?>

<section id="catalogoCompleto">

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



    <h2>Todos los productos</h2>

<?php
    $producto = new Producto ();

    //Obtengo todos los productos y los almaceno en la variable filas
    $filas = $producto->readAll();

    echo '
    <div>
        <div class="productos productos--lista">';

    while ($row = $filas->fetch(PDO::FETCH_ASSOC)) {
        extract ($row);
        
        echo '<article class="card">';
        echo '<a class="btnDetalle" href="index.php?sec=detalle&id='. $id.'"><span>Ver</span></a>';
    
        echo '<img alt="'.$nombre.'"src=img/'. $imagen. '>';
        echo '<div class="info-tarjeta">'; 
    
        echo '<h2>' . $nombre . '</h2>';

        //echo '<p class="descripcion">' . $descripcion. '</p>';
            echo '<div class="info-extra">'; 
                echo '<ul>';
                    echo '<li>' . '<span>Categoría </span>'. $fk_categoria . '</li>';
                    echo '<li>' . '<span>Stock </span>'. $stock . '</li>';  
                echo'</ul>';
                echo '</div>';
                echo '<p class="precio">$ ' . $precio . '</p>';
                //Pongo action=add para que esto suceda solo cuando se intente agregar un prod al carrito
                echo '<a class="btn" href="index.php?sec=carrito&accion=agregar&id='.$id.'"><span>Agregar al carrito</span></a>';

            echo '</div>';
            echo '</article>';
    }
?>

</section>