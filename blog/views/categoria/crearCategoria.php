<!-- CAJA PRINCIPAL -->
<?php if (isset($_SESSION['CategoriaControllerMessageSuccess'])) : ?>
	<script>
		toastr.success("<?php echo $_SESSION['CategoriaControllerMessageSuccess']; ?>");
	</script>
<?php elseif (isset($_SESSION['CategoriaControllerMessageError'])) : ?>
	<script>
		toastr.error("<?php echo $_SESSION['CategoriaControllerMessageError']; ?>");
	</script>
<?php endif; ?>
<?php
Utils::deleteSession('CategoriaControllerMessageSuccess');
Utils::deleteSession('CategoriaControllerMessageError');
?>
<div id="principal">
	<h1>Crear categorias</h1>
	<p>
		Añade nuevas categorias al blog para que los usuarios puedan
		usarlas al crear sus entradas.
	</p>
	<br />
	<form action="<?= base_url_blog ?>categoriablog/guardarCategoria" method="POST">
		<label for="nombre">Nombre de la categoría:</label>
		<input type="text" name="nombre" />

		<input type="submit" value="Guardar" />
	</form>

</div> <!--fin principal-->