<!DOCTYPE html>
<html lang="es">

<head>
    <script src="https://kit.fontawesome.com/712575d4a5.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url ?>assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url ?>assets/bootstrap/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= base_url ?>assets/bootstrap/css/estilos.css?v=" <?php echo time(); ?> />
    <link rel="stylesheet" href="<?= base_url ?>assets/button_general_styles.css?v=" <?php echo time(); ?> />
    <!-- <link rel="stylesheet" href="<?= base_url ?>assets/bootstrap/css/estilos.css" /> -->
    <link rel="stylesheet" href="<?= base_url ?>assets/bootstrap/css/shopInfo.css" />
    <!-- Agrega Easy Toast -->
    <script type="text/javascript" src="<?= base_url ?>assets/jquery/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Paypal -->
    <script src="https://www.paypal.com/sdk/js?client-id=AfqYGWG766pnnSs5SEr9zAUDXcHnlkO6QExSePpHhK-ns8yQZAJCBJqIXJWf_yjhb4Y9OcxDY8C0qqFk&currency=MXN"></script>
    <!-- PARA QUE FUNCIONE LOS SLIDERS Y MÁS-->
    <script type="text/javascript" src="<?= base_url ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- PARA QUE FUNCIONE LOS SLIDERS Y MÁS-->
    <script type="text/javascript" src="<?= base_url ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/fc7ee59db0.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $(".carousel").carousel({
                interval: 2000,
            });

            $(".btn-tool").tooltip();
            $(".btn-pop").popover();
        });

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        // JavaScript to prevent back navigation
        history.pushState(null, null, window.location.href);
        window.addEventListener('popstate', function() {
            history.pushState(null, null, window.location.href);
        });
    </script>
    <title>FarmaPlus</title>
</head>

<body>

    <body>
        <?php if (isset($_SESSION['successful_login'])) : ?>
            <script>
                toastr.success('Bienvenido a FarmaPlus!');
            </script>
        <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
            <script>
                toastr.success('¡Cuenta creada! Por favor loguéate');
            </script>
        <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
            <script>
                toastr.error('¡Cuenta no creada!');
            </script>
        <?php endif; ?>
        <?php Utils::deleteSession('successful_login'); ?>
        <?php Utils::deleteSession('register'); ?>
        <header>
            <!-- TITULO PÁGINA -->
            <div class="container">
                <div class="row">
                    <div class="logo col-xs-12 col-sm-4">
                        <a href="#"><img src="<?= base_url ?>assets/img/logo-farmacia.png" alt="FarmaciaJesusito Logo" /></a>
                    </div>
                    <!-- FIN TITULO PÁGINA -->
                    <!-- BARRA DE BUSQUEDA -->
                    <div class="barra-busqueda col-xs-12 col-sm-12 col-md-5 mb-2">
                        <form class="d-flex" action="<?= base_url ?>producto/busqueda" method="POST">
                            <input class="mx-2 me-2 mt-4" type="search" name="buscar" placeholder="Buscar" />
                            <button class="btn mt-4">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <!-- FIN DE LA BARRA DE BUSQUEDA -->
                    <div class="redes-sociales col-xs-12 col-sm-3">
                        <a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a>
                        <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                        <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                    </div>
                </div>
            </div>


            <!-- MENU -->
            <?php $categorias = Utils::showCategorias(); ?>
            <nav class="menu">
                <div class="container">
                    <div class="row">
                        <ul>
                            <li>
                                <a href="<?= base_url ?>producto/index">Inicio</a>
                            </li>
                            <li>
                                <a href="#">Categorías </a>
                                <ul>
                                    <?php while ($categoria = $categorias->fetch_object()) : ?>
                                        <li>
                                            <a href="<?= base_url ?>categoria/ver&id=<?= $categoria->id ?>"><?= $categoria->nombre ?></a>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </li>
                            <li>
                                <a href="<?= base_url ?>shopInfo/quienesSomos">Quienes somos</a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>shopInfo/vision">Visión</a>
                            </li>
                            <li>
                                <a href="<?= base_url_blog ?>posts/index">Blog</a>
                            </li>
                            <li class="registro" id="registro_carrito">
                                <div id="carrito">
                                    <a href="<?= base_url ?>carrito/index" id="enlace_carrito"><img id="logo-carrito" src="<?= base_url ?>/assets/img/carrito.png" /> Carrito</a>
                                </div>

                            </li>
                            <?php if (!isset($_SESSION['identity'])) : ?>
                                <li class="registro">
                                    <a href="<?= base_url ?>views/usuario/ingreso.php">Ingresa</a>
                                </li>
                                <li class="registro">
                                    <a href="<?= base_url ?>views/usuario/registro.php">Registrate aquí</a>
                                </li>
                            <?php else : ?>
                                <li class="registro"><a href="#"><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellidos ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!--INCIO SLIDER-->
        <?php if (Utils::isAdmin() != true && isset($_GET['controller']) && isset($_GET['action']) && $_GET['controller'] == 'producto' && $_GET['action'] == 'index') : ?>

            <div id="slider" class="carousel slide mb-3 d-xs" data-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#slider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#slider" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#slider" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="<?= base_url ?>assets/img/imagenes-slider/slider-img-1.gif" />
                        <!--carousel caption con Bootstrap-->
                        <div class="carousel-caption d-none d-md-block">
                            <h5>FarmaPlus</h5>
                            <p>:)</p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?= base_url ?>assets/img/imagenes-slider/slider-img-1.gif" />
                    </div>

                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?= base_url ?>assets/img/imagenes-slider/slider-img-1.gif" />
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
            </div>

        <?php endif; ?>
        <!--FIN SLIDER-->
        <div class="container">
            <div class="row">
                <section class="main col-md-8 col-xs-12">
                    <!-- Para que ocupe el espacio adecuado -->