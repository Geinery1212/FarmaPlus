<!-- CAJA PRINCIPAL -->
<script>
	tinymce.init({
		selector: '#crear_entrada_descripcion'
	});
	tinymce.init({
		selector: '#crear_entrada_resumen'
	});
</script>
<div id="principal">
	<h1>Crear entradas</h1>
	<p>
		Añade nuevas entradas al blog para que los usuarios puedan
		leerlas y disfrutar de nuestro contenido.
	</p>
	<br />
	<form action="<?= base_url_blog ?>posts/guardarPost" method="POST">
		<label for="titulo">Titulo:</label>
		<input type="text" name="titulo" />
		<?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?>

		<label for="descripcion">Cuerpo del post: </label>
		<textarea name="descripcion" id="crear_entrada_descripcion"></textarea>
		<?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'cuerpo') : ''; ?>
		<label for="resumen">Resumen del post: </label>
		<textarea name="resumen" id="crear_entrada_resumen"></textarea>
		<?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'resumen') : ''; ?>

		<label for="categoria">Categoría</label>
		<select name="categoria">
			<?php
			if (!empty($categorias)) :
				while ($categoria = mysqli_fetch_assoc($categorias)) :
			?>
					<option value="<?= $categoria['id'] ?>">
						<?= $categoria['nombre'] ?>
					</option>
			<?php
				endwhile;
			endif;
			?>
		</select>
		<?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''; ?>

		<input type="submit" value="Guardar" />
	</form>
	<?php borrarErrores(); ?>
</div> <!--fin principal-->