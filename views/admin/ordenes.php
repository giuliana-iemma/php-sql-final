<h1>Ordenes</h1>
<section id="ordenes">
    <div>

        <div">
            <table border="1">
            <thead>
                <tr>
                    <th>Número de orden</th>
                    <th>Email del usuario</th>
                    <th>Precio a pagar</th>
                    <th>Estado</th>
                    <th>Administrar</th>
                </tr>
            </thead>

            <tbody>

                <?php
                require 'clases/Orden.php';
                require 'clases/Usuario.php';

                $usuario = new Usuario();
                $orden = new Orden ();

                //Obtengo todos los productos y los almaceno en la variable filas
                $ordenes = $orden->readAll();

                foreach ($ordenes as $item) {
                    echo '<tr>';
                        echo '<td>' . $item['orden_id'] . '</td>';

                        $usuarioData = $usuario->getUserById($item['fk_user_id']);
                        $arrayUsuario = $usuarioData->fetch(PDO::FETCH_ASSOC);

                        echo '<td>' . $arrayUsuario['email'] . '</td>';

                        echo '<td>$' . round($item['precio_total']) . '</td>';
                        echo '<td>' . $orden->convertirEstado($item['estado_fk']) . '</td>';
                        echo '<td><a href="admin.php?sec=editarOrden&ordenID='. $item['orden_id'] .'">Editar estado</a> </td>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</section>