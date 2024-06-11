<div id="principal">

	<h1>Entradas de <?= $categoria_actual['nombre'] ?></h1>

	<?php
	if (!empty($entradas) && mysqli_num_rows($entradas) >= 1) :
		while ($entrada = mysqli_fetch_assoc($entradas)) :
	?>
			<article class="entrada">
				<a href="<?= base_url_blog ?>posts/ver&id=<?= $entrada['id'] ?>">
					<h2><?= $entrada['titulo'] ?></h2>
					<span class="fecha"><?= $entrada['categoria'] . ' | ' . $entrada['fecha'] ?></span>
					<div>
						<?= $entrada['resumen'] ?>
					</div>
				</a>
			</article>
		<?php
		endwhile;
	else :
		?>
		<div class="alerta">No hay entradas en esta categoría</div>
	<?php endif; ?>
</div> <!--fin principal-->