<section id="listadoUsuarios">
<h2>Usuarios</h2>

    <div>
        <div class="productos tabla-responsive">
            <table border="1">
            <thead>
                <tr>
                    <!-- <th>Imagen</th> -->
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Administrar</th>
                </tr>
            </thead>

            <tbody>

                <?php
                require 'clases/Usuario.php';

                $usuario = new Usuario ();

                //Obtengo todos los productos y los almaceno en la variable filas
                $filas = $usuario->readAll();

                while ($row = $filas->fetch(PDO::FETCH_ASSOC)) 
                {
                    extract ($row);
                    $rol = $usuario->obtenerRol($id, $fk_rol);

                    echo '<tr>';
                        // echo '<td><img class="img-miniatura" src="img/'. $imagen .'" alt="'. $nombre .'"></td>';
                        echo '<td>' . $username . '</td>';
                        echo '<td>' . $email . '</td>';
                        echo '<td>' . $rol['categoria_user'] . '</td>';
                        
                        echo '<td>';
                            echo'<div class="list-btn">';
                                echo '<a class="btn btn-slim " href="admin.php?sec=updateUsuarios&id='. $id.'">Modificar</a>';
                                echo '<a class="btn btn-slim warn"  href="admin.php?sec=deleteUsuarios&id='. $id.'">Eliminar</a>';
                            echo '</div>';
                        echo '</td>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</section>