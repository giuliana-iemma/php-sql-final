    <section id="contacto">
        <h2>Reservá una mesa</h2>

        <form action="index.php?sec=formulario"  method="post">
            <label>Nombre</label>
            <input required  type="text" name="nombre">

            <label>Apellido</label>
            <input  required type="text" name="apellido">

            <label>Correo electrónico</label>
            <input  required type="email" name="email">

            <label>Apellido</label>
            <input  required type="date" name="fecha">

            <label>Sucursal</label>
            <select  required name="sucursal">
                <option value="" >Selecciona una sucursal</option>
                <option value="Caballito">Av. Directorio 1256, CABA                </option>
                <option value="Palermo">Florida 500, CABA                </option>
                <option value="Devoto">Figueroa Alcorta 2300, CABA</option>
            </select>

            <input type="submit" value="Enviar">
        </form>
    </section>
