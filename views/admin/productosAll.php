<h1>Productos</h1>
<section id="catalogoCompleto">
    <a class="btn" href="admin.php?sec=create">Añadir nuevo producto</a>
    <div>

        <div class="productos">
            <table border="1">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Descripción</th>
                    <th>Categorias</th>
                    <th>Administrar</th>
                </tr>
            </thead>

            <tbody>

                <?php
                require 'clases/Productos.php';

                $producto = new Producto ();

                //Obtengo todos los productos y los almaceno en la variable filas
                $filas = $producto->readAll();

                while ($row = $filas->fetch(PDO::FETCH_ASSOC)) {
                    extract ($row);
                    $categorias = $producto->getCategoriasCheckedNamed($id);

                    echo '<tr>';
                        echo '<td><img class="img-miniatura" src="img/'. $imagen .'" alt="'. $nombre .'"></td>';
                        echo '<td>' . $nombre . '</td>';
                        echo '<td>' . $precio . '</td>';
                        echo '<td>' . $stock . '</td>';

                        echo '<td>' . $descripcion . '</td>';
                        echo '<td> 
                                <ul>';
                                foreach($categorias as $categoria){
                                    echo '<li>' . $categoria .'</li>';
                                } 
                        echo '</ul>
                            </td>';
                            // echo '<td>.' $stock ' .</td>';
                        echo '<td>';
                            echo'<div class="list-btn">';
                                // echo '<a class="btn btn-slim" href="index.php?sec=detalle&id='. $id.'"><span>Ver card</span></a>';
                                echo '<a class="btn btn-slim " href="admin.php?sec=update&id='. $id.'">Modificar</a>';
                                echo '<a class="btn btn-slim warn"  href="admin.php?sec=delete&id='. $id.'">Eliminar</a>';
                            echo '</div>';
                        echo '</td>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</section>