<?php if (isset($_SESSION['PostsControllerMessageSuccess'])) : ?>
	<script>
		toastr.success("<?php echo $_SESSION['PostsControllerMessageSuccess']; ?>");
	</script>
<?php elseif (isset($_SESSION['PostsControllerMessageError'])) : ?>
	<script>
		toastr.error("<?php echo $_SESSION['PostsControllerMessageError']; ?>");
	</script>
<?php endif; ?>
<?php
Utils::deleteSession('PostsControllerMessageSuccess');
Utils::deleteSession('PostsControllerMessageError');
?>
<div id="principal">
	<h1>Ultimas entradas</h1>
	<?php
	if (!empty($entradas)) :
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
	endif;
	?>

	<div id="ver-todas">
		<a href="<?= base_url_blog ?>posts/todasEntradas">Ver todas las entradas</a>
	</div>
</div> <!--fin principal-->