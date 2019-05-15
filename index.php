<?php
require_once "php/functions.php";
$config = getConfig();
?><!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php if ($config->info->descripcion != ""): ?>
		<meta name="description" content="<?php echo $config->info->descripcion; ?>">
		<?php endif; ?>
		<title><?php echo $config->info->titulo ?></title>

		<?php if( $config->configuracion->openGraph == 1 ): ?>
		<!-- Metas OG - Open Graph para contenido compartido en Facebook -->
		<meta property="og:title" content="<?php echo $config->info->titulo ?>">
		<meta property="og:type" content="article"/>
		<meta property="og:url" content="<?php echo validateUrl($config->info->url); ?>">
		<meta property="og:site_name" content="<?php echo $config->info->titulo; ?>">
		<meta property="og:description" content="<?php echo $config->info->descripcion; ?>">
		<meta property="og:image" content="<?php echo $config->info->url; ?><?php echo $config->info->logo ?>"/>
		<?php endif; ?>

		<!-- FAVICONS -->
		<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
		<link rel="icon" href="images/favicon.png" type="image/x-icon">

		<!-- GOOGLE FONT -->
		<?php foreach( $config->configuracion->fonts as $key => $fonts ): ?> 
		<link href="https://fonts.googleapis.com/css?family=<?php echo str_replace(" ","+",$key); ?><?php if ( $fonts->weight != "") { echo ":" . str_replace(" ","",$fonts->weight); } ?>" rel="stylesheet">
		<?php endforeach; ?>

		<?php if ( $config->configuracion->revolution == 1 ): ?>
		<!-- revolution slider -->
    	<link rel="stylesheet" href="revolution/css/settings.css"/>
		<?php endif; ?>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">

		<?php if ( $config->configuracion->assets->slick == 1 ): ?>
		<link rel="stylesheet" type="text/css" href="./node_modules/slick-carousel/slick/slick.css">
		<link rel="stylesheet" type="text/css" href="./node_modules/slick-carousel/slick/slick-theme.css">
		<?php endif; ?>

		<?php if ( $config->configuracion->assets->fontawesome == 1 ): ?>
		<link rel="stylesheet" href="./node_modules/@fortawesome/fontawesome-free/css/all.css">
		<?php endif; ?>

		<?php if ( $config->configuracion->assets->animate == 1 ): ?>
		<link rel="stylesheet" href="./node_modules/animate.css/animate.min.css">
		<?php endif; ?>
		<?php if ( $config->configuracion->assets->aos == 1 ): ?>
		<link rel="stylesheet" href="./node_modules/aos/dist/aos.css">
		<?php endif; ?>

		<link rel="stylesheet" href="./node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.css" />

		<link rel="stylesheet" href="assets/css/styles.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<?php if ( $config->info->fbPixel != "" ): ?>
		<!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '<?php echo $config->info->fbPixel; ?>');
		fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" alt="facebook pixel" style="display:none"
		src="https://www.facebook.com/tr?id=<?php echo $config->info->fbPixel; ?>&ev=PageView&noscript=1"
		/></noscript>
		<!-- End Facebook Pixel Code -->
		<?php endif ?>

		<?php if ( $config->info->googleAnalytics != "" ): ?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $config->info->googleAnalytics; ?>"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', '<?php echo $config->info->googleAnalytics; ?>');
		</script>
		<!-- End Google Analytics -->
		<?php endif ?>

	</head>
	<body>

		<?php if ( $config->configuracion->loading == 1 ): ?>
		<div class="loading" id="particles-js">
			<div class="loading-logo"><img src="images/logo.png" alt="Loading" class="mb-1" /><br /><p>Cargando...</p></div>
		</div>
		<?php endif; ?>

		<?php if ( $config->contactos->whatsapp != "" ): ?>
		<div class="floating">
			<a href="https://wa.me/<?php echo cleanString($config->contactos->whatsapp); ?>" target="_blank" class="btn-floating">
				<img src="images/ico-float-whatsapp.png" class="img-fluid" />
			</a>
		</div>
		<?php endif; ?>

		<?php if ( $config->contactos->messenger != "" ): ?>
		<div class="floating-messenger">
			<a href="http://m.me/<?php echo $config->contactos->messenger; ?>" target="_blank" class="btn-floating">
				<img src="images/ico-float-messenger.png" class="img-fluid" />
			</a>
		</div>
		<?php endif; ?>

		<section id="header" class="position-fixed w-100">
			
			<div class="container">
				<div class="row align-items-center py-1">

					<div class="col-4">
						<a class="navbar-brand p-1" href="#" data-aos="fade-left" data-aos-delay="0">
							<img src="<?php echo $config->info->logo; ?>" alt="<?php echo $config->info->titulo; ?>" class="img-fluid"/>
						</a>
					</div>
					<div class="col-8">
						<nav class="navbar navbar-expand-lg float-right float-lg-none p-0">
							<button class="navbar-toggler p-0" type="button" data-toggle="collapse" data-target="#navbarMain2" aria-controls="navbarMain2" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon text-white d-inline"><i class="fas fa-bars fa-lg"></i></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarMain">
								<ul class="navbar-nav w-100 justify-content-end align-items-end">
									<?php echo createMenu($config->menu, 'li'); ?>
									<?php foreach ($config->redes as $red): ?>
									<li class="nav-item"><a href="<?php echo $red->url ?>" target="_blank"><i class="<?php echo $red->icon ?> fa-lg"></i></a></li>
									<?php endforeach; ?>
								</ul>
							</div>
						</nav>
					</div>		
					<div class="col-12 d-lg-none bg-menu">
						<div class="collapse navbar-collapse" id="navbarMain2">
							<ul class="navbar-nav w-100 align-items-center menu-movil">
								<?php echo createMenu($config->menu, 'li'); ?>
								<?php foreach ($config->redes as $red): ?>
								<li class="nav-item"><a href="<?php echo $red->url ?>" target="_blank"><i class="<?php echo $red->icon ?> fa-lg"></i></a></li>
								<?php endforeach; ?>
								<li class="nav-item"><span class="d-none d-xl-inline">Pide más Información al </span><i class="fas fa-phone"></i> <a href="tel:<?php echo cleanString($config->contactos->telefono); ?>"><?php echo $config->contactos->telefono; ?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		
		</section>

		<section id="slider">

			<?php include_once ('slider.php'); ?>
			
		</section>


		<section id="paquetes" class="py-5">

			<header id="header-section" class="text-center mb-4" data-aos="fade-up" data-aos-delay="300">
				<h2 class="title-section">Paquetes</h2>
			</header>

			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="card card-paquetes mb-3 mb-lg-0 shadow">
							<div class="card-header text-center">
								<div class="content-header">
									<h3>Básico</h3>
									<h5>50mb de espacio</h5>
									<small>Recomendado para landing pages</small>
								</div>
							</div>
							<div class="card-body">
								<div class="box-paquete-features">
									<ul>
										<li><i class="far fa-hdd fa-lg"></i> 50mb de espacio</li> 
										<li><i class="far fa-envelope fa-lg"></i> Cuentas de correo ilimitadas</li> 
										<li><i class="fas fa-shield-alt fa-lg"></i> Certificado SSL</li>
										<li><i class="fas fa-tools fa-lg"></i> cPanel&copy;</li>
									</ul>
								</div>
								<div class="box-paquete-notes text-center mt-4">
									<h2 class="mb-3">$599 mxn</h2>
								</div>
							</div>
							<div class="card-footer">
								<a href="#" class="btn-popup btn btn-primary btn-full" data-toggle="modal" data-subtitle="50mb" data-target="#popup_cotiza" data-title="Paquete Básico" data-product="">¡Contratar ahora!</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card card-paquetes mb-3 mb-lg-0 shadow featured">
							<div class="card-header text-center">
								<div class="feature">Más vendido</div>
								<div class="content-header">
									<h3>Profesional</h3>
									<h5>200mb de espacio</h5>
									<small>Recomendado para Sitios básicos</small>
								</div>
							</div>
							<div class="card-body">
								<div class="box-paquete-features">
									<ul>
										<li><i class="far fa-hdd fa-lg"></i> 200mb de espacio</li> 
										<li><i class="far fa-envelope fa-lg"></i> Cuentas de correo ilimitadas</li> 
										<li><i class="fas fa-shield-alt fa-lg"></i> Certificado SSL</li>
										<li><i class="fas fa-tools fa-lg"></i> cPanel&copy;</li>
									</ul>
								</div>
								<div class="box-paquete-notes text-center mt-4">
									<h2>$999 mxn</h2>
								</div>
							</div>
							<div class="card-footer">
								<a href="#" class="btn-popup btn btn-primary btn-full" data-toggle="modal" data-subtitle="200mb" data-target="#popup_cotiza" data-title="Paquete Profesional" data-product="">¡Contratar ahora!</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card card-paquetes mb-3 mb-lg-0 shadow">
							<div class="card-header text-center">
								<div class="content-header">
									<h3>Plus</h3>
									<h5>500mb</h5>
									<small>Recomendado para CMS's</small>
								</div>
							</div>
							<div class="card-body">
								<div class="box-paquete-features">
									<ul>
										<li><i class="far fa-hdd fa-lg"></i> 500mb de espacio</li> 
										<li><i class="far fa-envelope fa-lg"></i> Cuentas de correo ilimitadas</li> 
										<li><i class="fas fa-shield-alt fa-lg"></i> Certificado SSL</li>
										<li><i class="fas fa-tools fa-lg"></i> cPanel&copy;</li>
									</ul>
								</div>
								<div class="box-paquete-notes text-center mt-4">
									<h2 class="mb-3">$1,299 mxn</h2>
								</div>
							</div>
							<div class="card-footer">
								<a href="#" class="btn-popup btn btn-primary btn-full" data-toggle="modal" data-subtitle="500mb" data-target="#popup_cotiza" data-title="Paquete Plus" data-product="">¡Contratar ahora!</a>
							</div>
						</div>
					</div>
				</div>
			</div>

		</section>


		<section id="beneficios" class="py-5">

			<div class="container py-lg-5">
				<div class="row align-items-center">
					<div class="col-md-5 pb-3 pb-md-0">
						<img src="images/beneficios.jpg" alt="Beneficios" class="img-fluid" data-aos="fade-left" data-aos-delay="300">
					</div>
					<div class="col-md-7">
						<div class="box-content text-white" data-aos="fade-right" data-aos-delay="600">
							<h2 class="mb-1">Beneficios</h2>
							<span class="subtitle mb-3 d-block">Lorem ipsum dolor sit amet consectetur, adipisicing elit.</span>
							<div class="box-content-text"><p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Optio voluptate laudantium, magnam autem ratione id ipsam dolore atque asperiores? Iusto ipsam culpa accusantium quos nostrum eligendi unde cupiditate perspiciatis tempore. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam quibusdam quaerat vero sed pariatur. </p>
							</div>
						</div>
					</div>
				</div>
			</div>

		</section>

		<section id="clientes" class="py-5">

			<div class="slider-logos py-2">

				<h2 class="mb-4 text-center">Algunos clientes</h2>

				<div class="slide-logos d-flex justify-content-around align-items-center">
					<?php 
					$files = glob('images/logos/*.{jpg,png,gif}', GLOB_BRACE);
					foreach($files as $file): ?>
					<div><img src="<?php echo $file; ?>" class="img-fluid" alt="Logo" /></div>
					<?php endforeach; ?>
				</div>

			</div>

		</section>

		<footer id="footer" class="py-5">
			
			<div class="container pt-md-4">
				<div class="row">
					<div class="col">

						<header id="header-section" class="text-center">
							<h4 class="title-section">¿Encontraste la opción que deseas?</h4>
						</header>

						<div class="box-form">
							<div class="form-text text-center mb-3">
								Es posible cotizar según tus necesidades, déjanos tus datos y te contactamos para presentarte una propuesta personalizada.
							</div>

							<?php createForm( $config->forms->contacto ); ?>

						</div>

						<div class="box-direccion-footer text-center">

							<?php echo $config->contactos->direccion; ?><br>
							Teléfono y Whatsapp<br>
							<i class="fas fa-phone pl-lg-2"></i> <a href="tel:<?php echo cleanString($config->contactos->telefono); ?>"><?php echo $config->contactos->telefono; ?></a>

						</div>

					</div>

					<div class="col-12 col-copy text-center mt-5">
						<?php echo replaceValues($config->info->copyright); ?> 
					</div>
				</div>
			</div>
			<?php if ( $config->configuracion->particlesFooter == 1 ): ?>
			<div id="particles-footer"></div>
			<?php endif ?>
		</footer>

		<?php if ( $config->configuracion->popup == 1 ): ?>
			<?php include_once "popup.php"; ?>
		<?php endif ?>

		<script type="text/javascript">
			var jam_gotop = '<?php echo $config->configuracion->gotop; ?>';
			var jam_popup = '<?php echo $config->configuracion->popup; ?>';
			var jam_particlesFooter = '<?php echo $config->configuracion->particlesFooter; ?>';
		</script>

		<?php if ( $config->configuracion->gotop == 1 ): ?>
		<a href="javascript:void(0)" class="scrollup" aria-label="">&nbsp;</a>
		<?php endif; ?>

		<!-- jQuery -->
		<script src="./node_modules/jquery/dist/jquery.min.js"></script>

		<!-- Bootstrap JavaScript -->
		<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

		<?php if ( $config->configuracion->assets->matchHeight == 1 ): ?>
		<script src="./node_modules/jquery-match-height/dist/jquery.matchHeight-min.js"></script>
		<?php endif; ?>

		<?php if ( $config->configuracion->assets->slick == 1 ): ?>
		<script type="text/javascript" src="./node_modules/slick-carousel/slick/slick.min.js"></script>
		<?php endif; ?>

		<?php if ( $config->configuracion->revolution == 1 ): ?>
		<!-- revolution -->
		<script type="text/javascript" src="assets/js/revolution.init.js"></script>
		<script src="revolution/js/jquery.themepunch.tools.min.js"></script>
		<script src="revolution/js/jquery.themepunch.revolution.min.js"></script>
		<!-- revolution extension -->
		<script src="revolution/js/extensions/revolution.extension.actions.min.js"></script>
		<script src="revolution/js/extensions/revolution.extension.carousel.min.js"></script>
		<script src="revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
		<script src="revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
		<script src="revolution/js/extensions/revolution.extension.migration.min.js"></script>
		<script src="revolution/js/extensions/revolution.extension.navigation.min.js"></script>
		<script src="revolution/js/extensions/revolution.extension.parallax.min.js"></script>
		<script src="revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
		<script src="revolution/js/extensions/revolution.extension.video.min.js"></script>
		<?php endif; ?>

		<script src="./node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.js"></script>
		
		<?php if ( $config->configuracion->loading == 1 || $config->configuracion->particlesFooter == 1 ): ?>
		<script src="./node_modules/particles.js/particles.js"></script>
		<?php endif; ?>
		<?php if ( $config->configuracion->loading == 1 ): ?>
		<script>
			particlesJS.load('particles-js', 'assets/particlesjs-config.json', function() {});
		</script>
		<?php endif; ?>

		<?php if ( $config->configuracion->assets->aos == 1 ): ?>
		<script src="./node_modules/aos/dist/aos.js"></script>
		<script>
		
		AOS.init({
			easing: 'ease-out-back',
			duration: 1000,
			once: true
		});
		</script>
		<?php endif; ?>

		<script src="assets/js/scripts.js"></script>

	</body>
</html>