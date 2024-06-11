<?php if (isset($_SESSION['CarritoControllerMessageSuccess'])) : ?>
    <script>
        toastr.success("<?php echo $_SESSION['CarritoControllerMessageSuccess']; ?>");
    </script>
<?php elseif (isset($_SESSION['CarritoControllerMessageError'])) : ?>
    <script>
        toastr.error("<?php echo $_SESSION['CarritoControllerMessageError']; ?>");
    </script>
<?php endif; ?>
<?php
Utils::deleteSession('CarritoControllerMessageSuccess');
Utils::deleteSession('CarritoControllerMessageError');
?>
<div class="row titulo-seccion">
    <div class="col-md-12">
        <h3>Carrito de la compra</h3>
    </div>
</div>
<?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) : ?>
    <div class="table-responsive">
        <table class="responsive-table">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carrito as $indice => $elemento) :
                    $producto = $elemento['producto'];
                ?>
                    <tr>
                        <td data-label="Imagen">
                            <?php if ($producto->imagen != null) : ?>
                                <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito" />
                            <?php else : ?>
                                <img src="<?= imagen_defecto ?>" class="img_carrito" />
                            <?php endif; ?>
                        </td>
                        <td data-label="Nombre">
                            <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>">
                                <?= $producto->nombre ?>
                            </a>
                        </td>
                        <td data-label="Precio"><?= number_format($producto->precio, 2) ?>MXN</td>
                        <td data-label="Unidades">
                            <?= $elemento['unidades'] ?>
                            <div class="updown-unidades">
                                <a href="<?= base_url ?>carrito/down&index=<?= $indice ?>" class="button"><i class="fa-solid fa-angles-left"></i></a>
                                <a href="<?= base_url ?>carrito/up&index=<?= $indice ?>&stock=<?= $producto->stock ?>" class="button"><i class="fa-solid fa-angles-right"></i></a>
                            </div>
                        </td>
                        <td data-label="Eliminar">
                            <a href="<?= base_url ?>carrito/delete&index=<?= $indice ?>"><i class="fa-solid fa-trash carrito-icon-delete"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <br />
    <div class="responsive-distribution">
        <div class="delete-carrito">
            <form action="<?= base_url ?>carrito/delete_all" method="post">
                <button type="submit" class="button-37 rojo">Vaciar carrito</button>
            </form>
        </div>
        <div class="total-carrito">
            <?php $stats = Utils::statsCarrito(); ?>
            <h3>Precio total: $<?= number_format($stats['total'], 2) ?> MXN</h3>
            <form action="<?= base_url ?>pedido/hacer" method="post">
                <button type="submit" class="button-37">Hacer pedido</button>
            </form>
        </div>
    </div>
<?php else : ?>
    <p>El carrito está vació, añade algún producto</p>
<?php endif; ?>