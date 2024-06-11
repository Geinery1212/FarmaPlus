<div class="contact-form-container">
    <h1>Formulario de Contacto</h1>
    <form class="contact-form" action="<?= base_url ?>Usuario/sendEmail" method="post">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required>
        <?php if(isset($_SESSION['errores']['name'])): ?>
            <p class="error"><?php echo $_SESSION['errores']['name']; ?></p>
        <?php endif; ?>

        <label for="email">Correo electrónico:</label>
        <input type="text" id="email" name="email" required>
        <?php if(isset($_SESSION['errores']['email'])): ?>
            <p class="error"><?php echo $_SESSION['errores']['email']; ?></p>
        <?php endif; ?>

        <label for="message">Mensaje:</label>
        <textarea id="message" name="message" rows="4" required></textarea>
        <?php if(isset($_SESSION['errores']['message'])): ?>
            <p class="error"><?php echo $_SESSION['errores']['message']; ?></p>
        <?php endif; ?>

        <input type="submit" value="Enviar">
    </form>
    </div>
<?php Utils::deleteSession('errores') ?>
