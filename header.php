<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width">
		<title><?php bloginfo('name'); ?></title>

		<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>

	<!-- Site Header -->
	<header class="site-header">
	<nav class="nav-header">
		<div class="container">
	    <div class="nav-wrapper">
	      <a href="<?php echo home_url(); ?>" class="brand-logo" ><?php bloginfo('name'); ?></a>
	     <?php

                $args = array (
                		'theme_location' => 'main_header_menu',
                		'menu_class' => 'right hide-on-med-and-down',
                		'menu_id' => 'nav-mobile'
                	);

                	?>

            	<?php wp_nav_menu( $args ); ?>
	     <!--  <ul id="nav-mobile" class="right hide-on-med-and-down">
	        <li><a href="sass.html">Sass</a></li>
	        <li><a href="badges.html">Components</a></li>
	        <li><a href="collapsible.html">JavaScript</a></li>
	      </ul> -->
	    </div>
	    </div>
	</nav>
	<div class="header-line">
	</div>
	</header>
<div class="container">