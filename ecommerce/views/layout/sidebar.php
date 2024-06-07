</section>
<aside class="sidebar col-md-4">
    <?php if(isset($_SESSION['identity'])): ?>
    <div>
        <div class="titulo-seccion">
            <h3>Bienvenido  <?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h3>
        </div>
        <ul>
            <?php if(isset($_SESSION['admin'])) : ?>
            <li><a class= "acciones"href="<?=base_url?>Categoria/index">Gestionar categorías</a></li>
            <li><a class= "acciones" href="<?=base_url?>Producto/gestion">Gestionar productos</a></li>
            <li><a class= "acciones" href="<?=base_url?>Pedido/gestion">Gestionar pedidos</a></li>
            <?php endif;?>
            <?php if(isset($_SESSION['identity'])) : ?>
            <li><a class= "acciones" href="<?=base_url?>Pedido/mis_pedidos">Mis pedidos</a></li>
            <li><a class= "acciones" href="<?=base_url?>Usuario/logout">Cerrar sesion</a></li>
            <?php else: ?>
            <li><a class= "acciones" href="<?=base_url?>Usuario/registro">Registrate aqui</a></li>
            <?php endif;?>
        </ul>
    </div>
    <?php endif; ?>
    <div class="widget redes-sociales">
        <div class="titulo-seccion">
            <h3>Síguenos</h3>
        </div>
        <div class="redes-sociales">
            <a class="youtube" href="#"><i class="icono fa fa-youtube-play"></i><span
                    class="seguidores">90K</span></a>
            <a class="facebook" href="#"><i class="icono fa fa-facebook"></i><span
                    class="seguidores">6K</span></a>
            <a class="twitter" href="#"><i class="icono fa fa-twitter"></i><span
                    class="seguidores">3.5K</span></a>
        </div>
    </div>

    <div class="widget boletin">
        <div class="titulo-seccion">
            <h3>Suscríbete</h3>
            <form class="formulario" action="">
                <label for="email">¡Suscribete para recomendaciones semanales!</label>
                <input type="email" id="email" placeholder="Correo Electronico" required>
                <input type="submit" value="Enviar">
            </form>
        </div>
    </div>

    <div class="widget ad">
        <div class="contenedor-ad">
            <a href="#"><img src="img/ad2.jpg" alt=""></a>
        </div>
    </div>
</aside>
</div>
</div>
<!-- FIN DEL MAIN-->