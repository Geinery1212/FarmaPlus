<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] === 'complete') : ?>
    <div class="row titulo-seccion">
        <div class="col-md-12">
            <h3>Tu pedido se ha confirmado</h3>
        </div>
    </div>
    <p>
        Tu pedido ha sido guardado con éxito. Una vez que realices el pago, será procesado y enviado.
    </p>
    <br>
    <?php if (isset($pedido)) : ?>
        <h3>Datos del pedido:</h3>
        <p>Número de pedido: <?= $pedido->id ?></p>
        <p>Total a pagar: <?= $pedido->coste ?></p>
        <h3>Productos:</h3>
        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
            </tr>
            <?php while ($producto = $productos->fetch_object()) : ?>
                <tr class='table'>
                    <td>
                        <?php if ($producto->imagen != null) : ?>
                            <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="Imagen del producto" class="img_carrito">
                        <?php else : ?>
                            <img src="<?= base_url ?>assets/imagenes/camiseta.png" alt="Imagen del producto" class="img_carrito">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
                    </td>
                    <td>
                        <?= $producto->precio ?>
                    </td>
                    <td>
                        <?= $producto->unidades ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <div id="paypal-button-container"></div>
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
<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] !== 'complete') : ?>
    <h1>Tu pedido no ha podido realizarse</h1>
<?php endif; ?>