<?php if (isset($_SESSION['identity'])) : ?>
    <div class="row titulo-seccion">
        <div class="col-md-12">
            <h3>Realizar pedido</h3>
        </div>
    </div>
    <p>
        <a href="<?= base_url ?>Carrito/index">Detalle del pedido </a>
    </p>
    <br>
    <h3>Domicilio para el envió</h3>
    <form action="<?= base_url ?>Pedido/add" method="POST">
        <label for="municipio">Municipio</label>
        <input type="text" name="municipio" required>
        <label for="localidad">Localidad</label>
        <input type="text" name="localidad">
        <label for="direccion">Direccion (barrio, calle, numero interior y exterior )</label>
        <textarea name="direccion" required></textarea>
        <label for="referencia" name="referencia">Referencia</label>
        <input type="text" name="referencia">
        <label for="telefono" name="telefono">Número de teléfono </label>
        <input type="text" name="telefono">
        <input type="submit" value="Confirmar pedido">
    </form>
<?php else : ?>
    <h1>Necesitas iniciar sesión para proceder con tu compra.</h1>
<?php endif; ?>