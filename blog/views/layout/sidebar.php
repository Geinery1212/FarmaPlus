</section>
<aside class="sidebar col-md-4">   
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
	
	<?php if(isset($_SESSION['identity']) && isset($_SESSION['admin'])): ?>
		<div id="usuario-logueado" class="bloque">
			<h3>Bienvenido, <?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h3>
			<!--botones-->
			<a href="<?=base_url_blog ?>posts/mostrarPaginaCrear" class="boton boton-verde">Crear entradas</a>
			<a href="<?=base_url_blog ?>categoriaBlog/mostrarPaginaCategoria" class="boton">Crear categoria</a>
			<!-- <a href="mis-datos.php" class="boton boton-naranja">Mis datos</a> -->
			<a href="<?=base_url?>Usuario/logout"class="boton boton-rojo">Cerrar sesión</a>
		</div>
	<?php endif; ?>


    <div class="widget ad">
        <div class="contenedor-ad">
            <a href="#"><img src="img/ad2.jpg" alt=""></a>
        </div>
    </div>
</aside>
</div>
</div>
<!-- FIN DEL MAIN-->