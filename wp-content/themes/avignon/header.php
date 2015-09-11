<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9 lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="UTF-8" />
				
		<title>
			<?php is_front_page() ? bloginfo('description') : wp_title(''); ?> | <?php bloginfo('name'); ?>
		</title>

		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="/android-chrome-36x36.png" sizes="36x36">	
		<link rel="icon" type="image/png" href="/android-chrome-48x48.png" sizes="48x48">
		<link rel="icon" type="image/png" href="/android-chrome-72x72.png" sizes="72x72">
		<link rel="icon" type="image/png" href="/android-chrome-96x96.png" sizes="96x96">
		<link rel="manifest" href="/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/mstile-144x144.png">
		<meta name="theme-color" content="#ffffff">

		<?php wp_head(); ?>
		
	</head>

	<body <?php body_class(); ?>>

		<div id='content'>

			<header role="banner">

				<div class="container big clearfix">
					<a href="<?php echo site_url(); ?>" title="Home" rel="home" id="logo-institut-avignon">
						<span class="visu-logo"><img src='<?php echo get_template_directory_uri(); ?>/layoutImg/logo.png' alt="Institut d'Avignon"/></span><span class="txt-logo">
							<strong>Institut</strong> d'Avignon
						</span>
					</a>
					
					<a id="hamburger-menu" href="<?php echo site_url(); ?>/sitemap/" title="Open menu" rel='nofollow'>
						<span class="txt-menu">Menu</span><span class="hamburger-icon">
							<i id="b1"></i><i id="b2"></i><i id="b3"></i>
						</span>
					</a>
				</div>
					
			</header>

			<nav role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'first' ) ); ?>
			</nav>

			<div id="wrapper">