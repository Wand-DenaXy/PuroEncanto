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
a
    <script src="js/modernizr.custom.js"></script>
</head>
<body class="index">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header page-scroll">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
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
              <ul class="dropdown-menu">
                  <li><a href="dashboard.php">Dashboard</a></li>
                  <li><a href="perfil.php">Perfil</a></li>
                  <li><a href="asset/controller/controllerLogin.php?op=3">Logout</a></li>


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
                <li data-target="#main-slide" data-slide-to="1" ></li>
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

    
    
    <!-- Start Feature Section -->
        <section id="feature" class="feature-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature">
                            <i class="fa fa-magic"></i>
                            <div class="feature-content">
                                <h4>Decoração</h4>
                                <p>Decoramos a sua festa ou evento totalmente a seu gosto!</p>
                            </div>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature">
                            <i class="fa fa-gift"></i>
                            <div class="feature-content">
                                <h4>Bolos</h4>
                                <p>Fazemos o seu bolo com que sempre sonhou!</p>
                            </div>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature">
                            <i class="fa fa-wordpress"></i>
                            <div class="feature-content">
                                <h4>Insuflável</h4>
                                <p>Festa com crianças? Temos a solução perfeita para não faltar diversão!</p>
                            </div>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature">
                            <i class="fa fa-plug"></i>
                            <div class="feature-content">
                                <h4>Catering</h4>
                                <p>O Catering ideal para a sua festa ou envento!</p>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->
            
            </div><!-- /.container -->
        </section>
        <!-- End Feature Section -->
    
    
    <!-- Start Call to Action Section -->
    <section class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Quer planear a sua festa, mas não sabe onde? </br>Nós temos a solução!</h1>
                    <a href="#pricing.html"><button type="submit" class="btn btn-primary">Ver os nossos serviços</button></a>
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
                                    <img src="images/Decoração.jpg" class="img-responsive" alt="" />
                                    <div class="portfolio-caption">
                                        <h4>Decoração</h4>
                                        <a href="#portfolio-modal" data-toggle="modal" class="link-1"><i class="fa fa-magic"></i></a>
                                        <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="portfolio-item">
                                    <img src="images/Cateringg.jpg" class="img-responsive" alt="" />
                                    <div class="portfolio-caption">
                                        <h4>Catering</h4>
                                        <a href="#portfolio-modal" data-toggle="modal" class="link-1"><i class="fa fa-magic"></i></a>
                                        <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="portfolio-item">
                                    <img src="images/portfolio/img3.jpg" class="img-responsive" alt="" />
                                    <div class="portfolio-caption">
                                        <h4>Bolos</h4>
                                        <a href="#portfolio-modal" data-toggle="modal" class="link-1"><i class="fa fa-magic"></i></a>
                                        <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="portfolio-item">
                                    <img src="images/insufláveis.jpg" class="img-responsive" alt="" />
                                    <div class="portfolio-caption">
                                        <h4>Insufláveis</h4>
                                        <a href="#portfolio-modal" data-toggle="modal" class="link-1"><i class="fa fa-magic"></i></a>
                                        <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="portfolio-item">
                                    <img src="images/portfolio/img5.jpg" class="img-responsive" alt="" />
                                    <div class="portfolio-caption">
                                        <h4>Portfolio Title</h4>
                                        <a href="#portfolio-modal" data-toggle="modal" class="link-1"><i class="fa fa-magic"></i></a>
                                        <a href="#" class="link-2"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="portfolio-item">
                                    <img src="images/portfolio/img6.jpg" class="img-responsive" alt="" />
                                    <div class="portfolio-caption">
                                        <h4>Portfolio Title</h4>
                                        <a href="#portfolio-modal" data-toggle="modal" class="link-1"><i class="fa fa-magic"></i></a>
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
                            <h3>Portfolio Details</h3>
                            <p>Duis aute irure dolor in reprehenderit in voluptate</p>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-6">
                            <img src="images/portfolio/img1.jpg" class="img-responsive" alt="..">
                        </div>
                        <div class="col-md-6">
                            <img src="images/portfolio/img1.jpg" class="img-responsive" alt="..">
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
                            <p class="white-text">Duis aute irure dolor in reprehenderit in voluptate</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                        
                <div class="pricing">
                        
                        <div class="col-md-12">
                            <div class="pricing-table">
                                <div class="plan-name">
								    <h3>20 Convidados</h3>
                                </div>
                                <div class="plan-price">
                                    <div class="price-value">86<span>.99€</span></div>
                                    <div class="interval">iva incluido</div>
                                </div>
                                <div class="plan-list">
                                    <ul>
                                        <li>20 Convidados</li>
                                        <li>Bolo</li>
                                        <li>Decoração</li>
                                        <li>Catering</li>
                                        <li></li>
                                    </ul>
                                </div>
                                <div class="plan-signup">
                                    <a href="servico.html" class="btn-system btn-small">Comprar</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="pricing-table">
                                <div class="plan-name">
								    <h3>40 Convidados</h3>
                                </div>
                                <div class="plan-price">
                                    <div class="price-value">172<span>.99€</span></div>
                                    <div class="interval">iva incluido</div>
                                </div>
                                <div class="plan-list">
                                     <ul>
                                        <li>40 Convidados</li>
                                        <li>Bolo</li>
                                        <li>Decoração</li>
                                        <li>Catering</li>
                                        <li></li>
                                    </ul> 
                                </div>
                                <div class="plan-signup">
                                    <a href="servico.html" class="btn-system btn-small">Comprar</a>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-12">
                            <div class="pricing-table"> 
                                <div class="plan-name">
								    <h3>60 Convidados</h3>
                                </div>
                                <div class="plan-price">
                                    <div class="price-value">258<span>.99€</span></div>
                                    <div class="interval">iva incluido</div>
                                </div>
                                <div class="plan-list">
                                     <ul>
                                        <li>60 Convidados</li>
                                        <li>Bolo</li>
                                        <li>Decoração</li>
                                        <li>Catering</li>
                                        <li></li>
                                    </ul>
                                </div>
                                <div class="plan-signup">
                                    <a href="servico.html" class="btn-system btn-small">Comprar</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="pricing-table">
                                <div class="plan-name">
								    <h3>80 convidados</h3>
                                </div>
                                <div class="plan-price">
                                    <div class="price-value">344<span>.99€</span></div>
                                    <div class="interval">iva incluido</div>
                                </div>
                                <div class="plan-list">
                                     <ul>
                                        <li>80 Convidados</li>
                                        <li>Bolo</li>
                                        <li>Decoração</li>
                                        <li>Catering</li>
                                        <li></li>
                                    </ul>
                                </div>
                                <div class="plan-signup">
                                    <a href="servico.html" class="btn-system btn-small">Comprar</a>
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
                        <img src="images/testimonial/face_1.png" alt="" >
                        <div class="testimonial-author">
                            <div class="author">John Doe</div>
                            <div class="designation">Organization Founder</div>
                        </div>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque<br> laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.</p>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="testimonials item">
                    <div class="testimonial-content">
                        <img src="images/testimonial/face_2.png" alt="" >
                        <div class="testimonial-author">
                            <div class="author">Jane Doe</div>
                            <div class="designation">Lead Developer</div>
                        </div>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia<br> consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="testimonials item">
                    <div class="testimonial-content">
                        <img src="images/testimonial/face_3.png" alt="" >
                        <div class="testimonial-author">
                            <div class="author">John Doe</div>
                            <div class="designation">Honorable Customer</div>
                        </div>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit<br> anim laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
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
                        <h3>Contactos-nos!</h3>
                        <p class="white-text"></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
               
                    </div>
                </div>
            </div>
        </div>
        <footer class="style-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <span class="copyright">Copyright &copy; <a href="http://guardiantheme.com">GuardinTheme</a> 2015</span>
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

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/script.js"></script>

</body>

</html>