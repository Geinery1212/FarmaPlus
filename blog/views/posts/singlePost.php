		<!-- CAJA PRINCIPAL -->
		<div id="principal">

			<h1><?= $entrada_actual['titulo'] ?></h1>

			<a href="categoria.php?id=<?= $entrada_actual['categoria_id'] ?>">
				<h2><?= $entrada_actual['categoria'] ?></h2>
			</a>
			<h4><?= $entrada_actual['fecha'] ?> | <?= $entrada_actual['usuario'] ?></h4>
			<p>
				<?= $entrada_actual['descripcion'] ?>
			</p>

			<?php if (isset($_SESSION['identity']) && $_SESSION['identity']->id == $entrada_actual['usuario_id']) : ?>
				<br />
				<a href="<?= base_url_blog ?>posts/mostrarPaginaEditar&id=<?= $entrada_actual['id'] ?>" class="boton boton-verde">Editar entrada</a>
				<a href="#" onclick="return confirmDeletion(<?= $entrada_actual['id'] ?>);" class="boton">Eliminar entrada</a>
			<?php endif; ?>

		</div> <!--fin principal-->
		<script>
			function confirmDeletion(id) {
				Swal.fire({
					title: '¿Estás seguro?',
					text: "No podrás revertir esto!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sí, eliminarlo!',
					cancelButtonText: 'Cancelar'
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = "<?= base_url_blog ?>posts/borrarPost&id=" + id;
					}
				})
			}
		</script>