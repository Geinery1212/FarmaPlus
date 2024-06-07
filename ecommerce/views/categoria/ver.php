<?php if (isset($categoria)) : ?>
    <div class="row titulo-seccion">
        <div class="col-md-12">
            <h3><?= $categoria->nombre ?></h3>
        </div>
    </div>
    <?php if ($productos->num_rows == 0) : ?>
            <p>No hay productos para mostrar</p>
    <?php else : ?>
        <section class="row posts">
            <?php while ($producto = $productos->fetch_object()) : ?>
                <article class="col-sm-6 col-xl-4 post">
                    <div class="contenedor">
                        <a href="<?= base_url ?>Producto/ver&id=<?= $producto->id ?>">
                            <div class="thumb">
                                <?php if ($producto->imagen != null) : ?>
                                    <img src="<?=base_url ?>uploads/images/<?= $producto->imagen?>"alt="Imagen del producto">
                                <?php else : ?>
                                    <img src="<?=imagen_defecto?>" alt="Imagen del producto">
                                <?php endif; ?>
                            </div>
                            <div class="info">
                                <h2 class="titulo"><?= $producto->nombre ?></h2>
                        </a>
                        <h3 class="precio">$<?= $producto->precio ?></h3>
                        <div class="opciones">
                            <div><a href="<?= base_url ?>Carrito/add&id=<?= $producto->id ?>" class="comprar">Comprar</a></div>
                            <div><a href="<?= base_url ?>Producto/ver&id=<?= $producto->id ?>" class="descripcion">Descripcion</a></div>
                        </div>
                    </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </section>
    <?php endif; ?>
<?php else : ?>
    <div class="col-md-12">
        <h3>La categoría no existe</h3>
    </div>
<?php endif; ?>