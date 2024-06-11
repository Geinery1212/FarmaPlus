<?php if (isset($product)) : ?>
    <div class="row titulo-seccion">
        <div class="col-md-12">
            <h3><?= $product->nombre ?></h3>
        </div>
    </div>
    <div id="detail-product">
        <div class="image">
            <?php if ($product->imagen != null) : ?>
                <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" />
            <?php else : ?>
                <img src="<?= imagen_defecto ?>" />
            <?php endif; ?>
        </div>
        <div class="data">
            <p class="description"><?= $product->descripcion ?></p>
            <p class="price">$<?= number_format($product->precio, 2) ?> MXN</p>
            <a href="<?= base_url ?>carrito/add&id=<?= $product->id ?>" class="button">Comprar</a>
        </div>

    </div>
    <section class="row paginacion">
        <div class="col-md-12">
            <ul>
                <li class="disabled">Página 1 de 6</li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li><a href="#">Ultima »</a></li>
            </ul>
        </div>
    </section>
<?php else : ?>
    <h1>El producto no existe</h1>
<?php endif; ?>