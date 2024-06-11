<!-- <?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
	$categoria_actual = conseguirCategoria($db, $_GET['id']);

	if(!isset($categoria_actual['id'])){
		header("Location: index.php");
	}
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>
		
<!-- CAJA PRINCIPAL -->

			
<?php require_once 'includes/pie.php'; ?> -->