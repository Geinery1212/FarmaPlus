<div class="row titulo-seccion">
    <div class="col-md-12">
        <h3>Algunos de nuestros productos</h3>
    </div>
</div>
<?php if ($productos != false) : ?>  
    <section class="row posts">
        <?php while ($producto = $productos->fetch_object()) : ?>
            <article class="col-sm-6 col-xl-4 post">
                <div class="contenedor">
                    <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>">
                        <div class="thumb">
                            <?php if ($producto->imagen != null) : ?>
                                <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="Imagen del producto">
                            <?php else : ?>
                                <img src="<?= imagen_defecto ?>" alt="Imagen del producto">
                            <?php endif; ?>
                        </div>
                        <div class="info">
                            <h2 class="titulo"><?= $producto->nombre ?></h2>
                    </a>
                    <h3 class="precio">$<?= $producto->precio ?></h3>
                    <div class="opciones">
                        <div>                            
                            <a href="<?= base_url ?>Carrito/add&id=<?= $producto->id ?>" class="comprar">Comprar</a>
                        </div>
                        <div>
                            <a href="<?= base_url ?>Producto/ver&id=<?= $producto->id ?>" class="descripcion">Descripción</a>
                        </div>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
    </section>

    <section class="row paginacion">
        <div class="col-md-12">
            <ul>
                <?php if ($pagina_actual > 1) : ?>
                    <li><a href="?pagina=<?= $pagina_actual - 1 ?>">« Anterior</a></li>
                <?php else : ?>
                    <li class="disabled">« Anterior</li>
                <?php endif; ?>

                <?php
                for ($i = 1; $i <= $total_paginas; $i++) : ?>
                    <?php if ($i == $pagina_actual) : ?>
                        <li class="active"><?= $i ?></li>
                    <?php else : ?>
                        <li><a href="<?=pagination_url?>?pagina=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($pagina_actual < $total_paginas) : ?>
                    <li><a href="<?=pagination_url?>?pagina=<?= $pagina_actual + 1 ?>">Siguiente »</a></li>
                <?php else : ?>
                    <li class="disabled">Siguiente »</li>
                <?php endif; ?>
            </ul>
        </div>
    </section>
<?php else : ?>
    <div class="row titulo-seccion">
        <div class="col-md-12">
            <h3>Lo sentimos, sin resultados en la búsqueda</h3>
        </div>
    </div>
<?php endif; ?>