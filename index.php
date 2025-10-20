<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puro Encanto</title>
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/puroencantocores.css">
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>


    <script src="asset/js/lib/jquery.js"></script>
    <script src="asset/js/lib/sweatalert.js"></script>
    <link rel="stylesheet" href="asset/js/lib/datatables.js">
    <script src="js/modernizr.custom.js"></script>

    <script src="asset/js/homepage.js"></script>
</head>

<body class="index">

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">Puro Encanto</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav">
                    <li><a class="page-scroll" href="#feature">O que oferecemos?</a></li>
                    <li><a class="page-scroll" href="#portfolio">Galeria</a></li>
                    <li><a class="page-scroll" href="#pricing">Serviço</a></li>
                    <li><a class="page-scroll" href="#testimonial">Opiniões</a></li>
                    <li><a class="page-scroll" href="#contact">Contacto</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <?php if(isset($_SESSION['cliente_nome'])): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user fa-2x"></i>
                            <?php echo htmlspecialchars($_SESSION['cliente_nome']); ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" id="PerfilTipo">
                        </ul>
                    </li>
                    <?php else: ?>
                    <li class="nav-login">
                        <a href="login.php">
                            <i class="fa fa-user fa-2x"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Start Home Page Slider -->
    <section id="page-top">
        <!-- Carousel -->
        <div id="main-slide" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#main-slide" data-slide-to="0" class="active"></li>
                <li data-target="#main-slide" data-slide-to="1"></li>
                <li data-target="#main-slide" data-slide-to="2"></li>
            </ol>
            <!--/ Indicators end-->

            <!-- Carousel inner -->
            <div class="carousel-inner">
                <div class="item active">
                    <img class="img-responsive" src="images/taças.png" alt="slider">
                    <div class="slider-content">
                        <div class="col-md-12 text-center">
                            <h1 class="animated3">
                                <span><strong class="logotitulo">Puro Encanto</strong> </span>
                            </h1>
                            <p class="animated2">Transformamos momentos em memórias inesquecíveis!</p>

                        </div>
                    </div>
                </div>
                <div class="item">
                    <img class="img-responsive" src="images/Decoracao.png" alt="slider">

                    <div class="slider-content">
                        <div class="col-md-12 text-center">
                            <h1 class="animated1">
                                <span>Bem Vindo ao<strong> Puro Encanto</strong></span>
                            </h1>
                            <p class="animated2">Transformamos o seu sonho em realidade encantada</p>

                        </div>
                    </div>
                </div>

                <!--/ Carousel item end -->

                <div class="item">
                    <img class="img-responsive" src="images/nova.png" alt="slider">
                    <div class="slider-content">
                        <div class="col-md-12 text-center">
                            <h1 class="animated2">
                                <span>A sua festa <strong>começa aqui!</strong></span>
                            </h1>
                            <p class="animated1"> Estás a pensar planear uma festa ou evento?<br> Nós ajudamos!</p>

                        </div>
                    </div>
                </div>
                <!--/ Carousel item end -->
            </div>
            <!-- Carousel inner end-->

            <!-- Controls -->
            <a class="left carousel-control" href="#main-slide" data-slide="prev">
                <span><i class="fa fa-angle-left"></i></span>
            </a>
            <a class="right carousel-control" href="#main-slide" data-slide="next">
                <span><i class="fa fa-angle-right"></i></span>
            </a>
        </div>
        <!-- /carousel -->
    </section>
    <!-- End Home Page Slider -->




  <section id="feature" class="feature-section">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-md-offset-1 col-sm-6 col-xs-12">
                    <div class="feature">
                        <i class="fa fa-magic"></i>
                        <div class="feature-content">
                            <h4>Decoração</h4>
                            <p>Decoramos a sua festa ou evento totalmente a seu gosto!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <div class="feature">
                        <i class="fa fa-birthday-cake"></i>
                        <div class="feature-content">
                            <h4>Bolos</h4>
                            <p>Fazemos o seu bolo com que sempre sonhou!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <div class="feature">
                        <i class="fa fa-cutlery"></i>
                        <div class="feature-content">
                            <h4>Catering</h4>
                            <p>As comidas perfeitas para tornar a sua festa inesquecível!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <div class="feature">
                        <i class="fa fa-gift"></i>
                        <div class="feature-content">
                            <h4>Insufláveis</h4>
                            <p>Festa com crianças? Temos o presente perfeito para não faltar diversão!</p>
                        </div>

                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <div class="feature">
                        <i class="fa fa-calendar"></i>
                        <div class="feature-content">
                            <h4>Calendário</h4>
                            <p>Nós ajustamos o nosso calendário de acordo com a sua festa!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- Start Call to Action Section -->
    <section class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Quer planear a sua festa, mas não sabe onde? </br>Nós temos a solução!</h1>
                    <a href="#pricing"><button type="submit" class="btn btn-primary">Ver os nossos
                            serviços</button></a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Call to Action Section -->



    <!-- Start Portfolio Section -->
    <section id="portfolio" class="portfolio-section-1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3>Galeria</h3>
                        <p>Explore a nossa Galeria!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <!-- Start Portfolio items -->
                    <ul id="portfolio-list">
                        <li>
                            <div class="portfolio-item">
                                <img src="images/baloes-e-decoracoes-sao-dispostos-em-uma-sala-com-um-tema-arco-iris-generativo-ai_1035763-6807.jpg"
                                    class="img-responsive" height="100px" with="10px" alt=""
                                    style="height:260px; width:100%;">
                                <div class=" portfolio-caption">
                                    <h4>Decoração</h4>
                                    <a href="#portfolio-modal" data-toggle="modal" class="link-1"><i
                                            class="fa fa-magic"></i></a>
                                    <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="portfolio-item">
                                <img src="images/premium_photo-1663099598927-4d0db938250d (1).jpg"
                                    class="img-responsive" alt="" style="height:260px; width:100%;">
                                <div class="portfolio-caption">
                                    <h4>Catering</h4>
                                    <a href="#portfolio-modal" data-toggle="modal" class="link-1"><i
                                            class="fa fa-magic"></i></a>
                                    <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="portfolio-item">
                                <img src="images/candles-cake-cake-sweet-wallpaper-preview.jpg" class="img-responsive"
                                    alt="" style="height:260px; width:100%;" />
                                <div class="portfolio-caption">
                                    <h4>Bolos</h4>
                                    <a href="#portfolio-modal" data-toggle="modal" class="link-1"><i
                                            class="fa fa-magic"></i></a>
                                    <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="portfolio-item">
                                <img src="images/4d75f888fd630bcb810c29665425cb08.jpg" class="img-responsive" alt=""
                                    style="height:260px; width:100%;" />
                                <div class="portfolio-caption">
                                    <h4>Insufláveis</h4>
                                    <a href="#portfolio-modal" data-toggle="modal" class="link-1"><i
                                            class="fa fa-magic"></i></a>
                                    <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="portfolio-item">
                                <img src="images/1.jpg" height="100px" class="img-responsive" alt=""
                                    style="height:260px; width:100%;" />
                                <div class="portfolio-caption">
                                    <h4>Casamentos</h4>
                                    <a href="#portfolio-modal" data-toggle="modal" class="link-1"><i
                                            class="fa fa-magic"></i></a>
                                    <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="portfolio-item">
                                <img src="images/8c59e46694d92a60666d6b7e173de650.jpg" class="img-responsive" alt=""
                                    style="height:260px; width:100%;" />
                                <div class=" portfolio-caption">
                                    <h4>Festas Empresariais</h4>
                                    <a href="#portfolio-modal" data-toggle="modal" class="link-1"><i
                                            class="fa fa-magic"></i></a>
                                    <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                        </li>


                    </ul>
                    <!-- End Portfolio items -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Portfolio Section -->

    <!-- Start Portfolio Modal Section -->
    <div class="section-modal modal fade" id="portfolio-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="section-title text-center">
                        <h3>Galeria</h3>
                        <p>Algumas imagens da nossa galeria!</p>
                    </div>
                </div>
                <div class="row">
                    <h2><strong>Decoração</strong></h2>
                    <div class="col-md-4">
                        <img src="images/Decoração-Mesa-de-Festa-Tema-Jardim-Lojas-Linna.jpg" class="img-responsive"
                            alt=".." style="height:450px; width:100%">
                    </div>
                    <div class="col-md-4 w-100">
                        <img src="images/92ccc97b017d054a2b58f89e11618870.jpg" class="img-responsive" alt=".."
                            style="height:450px; width:100%">
                    </div>
                    <div class="col-md-4 w-100 h-100">
                        <img src="images/IMG_7928-1024x1024.jpg" class="img-responsive" alt=".."
                            style="height:450px; width:100%">
                    </div>
                </div>
                <div class="row">
                    <h2><strong>Catering</strong></h2>
                    <div class="col-md-4">
                        <img src="images/catering-4.jpg" class="img-responsive" alt=".."
                            style="height:450px; width:100%">
                    </div>
                    <div class="col-md-4">
                        <img src="images/catering-8.jpg" class="img-responsive" alt=".."
                            style="height:450px; width:100%">
                    </div>
                    <div class="col-md-4">
                        <img src="images/Catering+na+marinha+grande.jpg" class="img-responsive" alt=".."
                            style="height:450px; width:100%">
                    </div>

                </div><!-- /.row -->
                <div class="row">
                    <h2><strong>Bolos</strong></h2>
                    <div class="col-md-4 w-50">
                        <img src="images/85d05eef8a30c26354a53212792abcee.jpg" class="img-responsive" alt=".."
                            style="height:450px; width:100%">
                    </div>
                    <div class="col-md-4">
                        <img src="images/87feffe684f8a884d1881a7e8cceb54e.jpg" class="img-responsive" alt=".."
                            style="height:450px; width:100%">
                    </div>
                    <div class="col-md-4">
                        <img src="images/7d04481bd1ccb741adf3ac7b67825db0.jpg" class="img-responsive" alt=".."
                            style="height:450px; width:100%">
                    </div>

                </div><!-- /.row -->
                <div class="row">
                    <h2><strong>Insufláveis</strong></h2>
                    <div class="col-md-4 w-50">
                        <img src="images/66cf408bcc299cf69dcd0631d13b2c38.jpg" class="img-responsive" alt=".."
                            style="height:450px; width:100%">
                    </div>
                    <div class="col-md-4">
                        <img src="images/c3e83ba55a19a1ffb07c142bfb564215.jpg" class="img-responsive" alt=".."
                            style="height:450px; width:100%">
                    </div>
                    <div class="col-md-4">
                        <img src="images/20edc6174ce72c0b608459e58959ecf5.jpg" class="img-responsive" alt=".."
                            style="height:450px; width:100%">
                    </div>

                </div><!-- /.row -->
                <div class="row">
                    <h2><strong>Casamentos</strong></h2>
                    <div class="col-md-4 w-50">
                        <img src="images/7f484044e7c2848f5f66028ffc6b683b.jpg" class="img-responsive" alt=".."
                            style="height:450px; width:100%">
                    </div>
                    <div class="col-md-4">
                        <img src="images/e9d54c65473460121c6a98e22df61b2e.jpg" class="img-responsive" alt=".."
                            style="height:450px; width:100%">
                    </div>
                    <div class="col-md-4">
                        <img src="images/6caef9dd8fae6216ff47e4cdfab7f254.jpg" class="img-responsive" alt=".."
                            style="height:450px; width:100%">
                    </div>

                </div><!-- /.row -->
            </div>
        </div>
    </div>
    <!-- End Portfolio Modal Section -->

    <!-- Start Pricing Table Section -->

    <div id="pricing" class="pricing-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <h3>Serviços</h3>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="pricing">
                    <div class="col-md-12">
                        <div class="pricing-table">
                            <div class="plan-name">
                                <h3>Bolo</h3>
                            </div>
                            <div class="plan-price">
                                <div class="price-value">86.10€</div>
                                <div class="interval">iva incluido</div>
                            </div>
                            <div class="plan-list">
                                <ul>
                                </ul>
                            </div>
                            <div class="plan-signup">
                                <a href="dashboardCliente.php" class="btn-system btn-small">Comprar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pricing-table">
                            <div class="plan-name">
                                <h3>Catering</h3>
                            </div>
                            <div class="plan-price">
                                <div class="price-value">246.00€</span></div>
                                <div class="interval">iva incluido</div>
                            </div>
                            <div class="plan-list">
                                <ul>
                                </ul>
                            </div>
                            <div class="plan-signup">
                                <a href="dashboardCliente.php" class="btn-system btn-small">Comprar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pricing-table">
                            <div class="plan-name">
                                <h3>Decoração</h3>
                            </div>
                            <div class="plan-price">
                                <div class="price-value">123.00€</span></div>
                                <div class="interval">iva incluido</div>
                            </div>
                            <div class="plan-list">
                                <ul>
                                </ul>
                            </div>
                            <div class="plan-signup">
                                <a href="dashboardCliente.php" class="btn-system btn-small">Comprar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pricing-table">
                            <div class="plan-name">
                                <h3>Insuflável</h3>
                            </div>
                            <div class="plan-price">
                                <div class="price-value">123.00€</span></div>
                                <div class="interval">iva incluido</div>
                            </div>
                            <div class="plan-list">
                                <ul>
                                </ul>
                            </div>
                            <div class="plan-signup">
                                <a href="dashboardCliente.php" class="btn-system btn-small">Comprar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pricing-table">
                            <div class="plan-name">
                                <h3>Pipocas</h3>
                            </div>
                            <div class="plan-price">
                                <div class="price-value">369.00€</span></div>
                                <div class="interval">iva incluido</div>
                            </div>
                            <div class="plan-list">
                                <ul>
                                </ul>
                            </div>
                            <div class="plan-signup">
                                <a href="dashboardCliente.php" class="btn-system btn-small">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

    <!-- End Pricing Table Section -->


    <!-- Start Testimonial Section -->
    <div id="testimonial" class="testimonial-section">
        <h2>Opiniões</h2>
        <br>
        <br>
        <br>
        <div class="container">
            <!-- Start Testimonials Carousel -->
            <div id="testimonial-carousel" class="testimonials-carousel">
                <!-- Testimonial 1 -->
                <div class="testimonials item">
                    <div class="testimonial-content">
                        <img src="images/jose.jpg" alt="">
                        <div class="testimonial-author">
                            <div class="author">José Miguel</div>
                        </div>
                        <p>Excelente serviço! Adorei poder organizar tudo pela app, foi muito prático e rápido. A
                            festa ficou linda e os convidados adoraram. Recomendo a 100%!</p>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="testimonials item">
                    <div class="testimonial-content">
                        <img src="images/margarida.jpg" alt="">
                        <div class="testimonial-author">
                            <div class="author">Margarida Lopes</div>



                        </div>
                        <p>A experiência foi fantástica! O Puro Encanto cuidou de todos os detalhes com
                            profissionalismo e carinho. A decoração e as pipocas foram um sucesso entre as crianças!
                        </p>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="testimonials item">
                    <div class="testimonial-content">
                        <img src="images/carlos.jpg" alt="">
                        <div class="testimonial-author">
                            <div class="author">Carlos Vieira</div>



                        </div>
                        <p>Foi uma experiência incrível! Houve alguns contratempos no início, mas a Puro Encanto
                            transformou a adversidade em encanto — literalmente. A dedicação e a calma da equipa
                            fizeram toda a diferença.</p>
                    </div>
                </div>

            </div>
            <!-- End Testimonials Carousel -->
        </div>
    </div>
    <!-- End Testimonial Section -->
     <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h3>Contacte-nos!</h3>
                    </div>
                </div>
            </div>
            <form action="send_mail.php" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name *" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Your Email *" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" class="form-control" placeholder="Your Phone *" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="message" class="form-control" placeholder="Your Message *" required></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </div>
            </form>
        </div>
    </section>  
        </div>
        </div>
        </div>
        <footer class="style-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <span class="copyright">Copyright &copy; <a href="index.php">Puro Encanto</a> 2025</span>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="footer-social text-center">
                            <ul>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="footer-link">
                        <ul class="pull-right">
                            <li><a href="#">Privacy Policy</a>
                            </li>
                            <li><a href="#">Terms of Use</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </footer>


    </section>


    <div id="loader">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>



    <!-- jQuery Version 2.1.1 -->
    <script src="js/jquery-2.1.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="asset/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/count-to.js"></script>
    <script src="js/jquery.appear.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.fitvids.js"></script>
    <script src="js/styleswitcher.js"></script>



    <!-- Custom Theme JavaScript -->
    <script src="js/script.js"></script>
</body>