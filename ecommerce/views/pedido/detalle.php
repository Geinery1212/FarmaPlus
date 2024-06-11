<?php if (isset($_SESSION['PedidoControllerMessageSuccess'])) : ?>
    <script>
        toastr.success("<?php echo $_SESSION['PedidoControllerMessageSuccess']; ?>");
    </script>
<?php elseif (isset($_SESSION['PedidoControllerMessageError'])) : ?>
    <script>
        toastr.error("<?php echo $_SESSION['PedidoControllerMessageError']; ?>");
    </script>
<?php elseif (isset($_SESSION['pago']) && $_SESSION['pago'] === 'APPROVED') : ?>
    <script>
        toastr.success('¡Pago exitoso! ');
    </script>
<?php endif; ?>
<?php
Utils::deleteSession('PedidoControllerMessageSuccess');
Utils::deleteSession('PedidoControllerMessageError');
Utils::deleteSession('pago');
?>

<div class="row titulo-seccion">
    <div class="col-md-12">
        <h3>Detalle del pedido</h3>
    </div>
</div>
<?php if (isset($pedido)) : ?>
    <?php if (isset($_SESSION['admin'])) : ?>
        <h3>Cambiar el estado del pedido</h3>
        <form action="<?= base_url ?>pedido/estado" method="POST">
            <input type="hidden" value="<?= $pedido->id ?>" name="pedido_id">
            <select name="estado">
                <option value="confirm" <?= $pedido->estado == 'confirm' ? 'selected' : '' ?>>Pendiente</option>
                <option value="preparation" <?= $pedido->estado == 'preparation' ? 'selected' : '' ?>>En preparacion</option>
                <option value="ready" <?= $pedido->estado == 'ready' ? 'selected' : '' ?>>Preparado</option>
                <option value="sended" <?= $pedido->estado == 'sended' ? 'selected' : '' ?>>Enviado</option>
                <input type="submit" value="Cambiar estado">
            </select>
        </form>
        <br>
    <?php endif; ?>
    <h3>Datos del usuario</h3>
    <p>Nombre: <?= $pedido->nombre ?></p>
    <p>Correo: <?= $pedido->email ?></p>
    <p>Telefono: <?= $pedido->numeroTel ?></p>
    <!-- ---------------------------------------------------------------------  -->
    <h3>Direccion del envio</h3>
    <p>Municipio: <?= $pedido->municipio ?></p>
    <p>Localidad: <?= $pedido->localidad ?></p>
    <p>Direccion: <?= $pedido->direccion ?></p>
    <p>Referencia: <?= $pedido->referencia ?></p>

    <!-- ---------------------------------------------------------------------  -->
    <h3>Datos del pedido: </h3>
    <p>Estado: <?= Utils::showStatus($pedido->estado) ?></p>
    <p>Numero de pedido: <?= $pedido->id ?></p>
    <p>Total a pagar: $<?= number_format($pedido->coste, 2) ?> MXN</p>
    <h3>Productos:</h3>
    <div class="table-responsive">
        <table class="responsive-table">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($producto = $productos->fetch_object()) : ?>
                    <tr>
                        <td data-label="Imagen">
                            <?php if ($producto->imagen != null) : ?>
                                <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="Imagen del producto" class="img_carrito">
                            <?php else : ?>
                                <img src="<?= imagen_defecto ?>" alt="Imagen del producto" class="img_carrito">
                            <?php endif; ?>
                        </td>
                        <td data-label="Nombre">
                            <a href="<?= base_url ?>/producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
                        </td>
                        <td data-label="Precio">
                            $<?= number_format($producto->precio, 2) ?> MXN
                        </td>
                        <td data-label="Unidades">
                            <?= $producto->unidades ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete') : ?>
    <h1>Tu pedido No ha podido realizarce</h1>
<?php endif; ?>

<?php if (isset($pedido) && $pedido->estado == 'confirm') : ?>
    <div id="paypal-button-container">
        <h2>Necesitas pagar tu pedido para que empiece a procesarse </h2>

    </div>
<?php endif; ?>

<script>
    paypal.Buttons({
        style: {
            layout: 'vertical',
            color: 'blue',
            shape: 'rect',
            label: 'paypal'
        },
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    description: 'Compra en FarmaPlus',
                    amount: {
                        currency_code: 'MXN',
                        value: <?= json_encode($pedido->coste) ?>
                    },
                }]
            });
        },
        onApprove: (data, actions) => {
            window.location.href = <?= json_encode(base_url_blog . "pedido/pagoCompletado&paymentID=") ?> + data.paymentID + <?= json_encode("&pedido_id=" . $pedido->id) ?>;
        },
        onCancel: (data, actions) => {
            alert('Cancelado :(');
        }
    }).render('#paypal-button-container');
</script>