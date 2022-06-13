<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php body_class(); ?>>
<head>
	<?php // Load Meta ?>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php  wp_title('|', true, 'right'); ?></title>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <!-- stylesheets should be enqueued in functions.php -->
  <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>

<header>
  <main class="headerContainer">
    <section class="title">
      <a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name', 'display' ); ?>" rel="home">
      <svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M20.5951 22.9314C20.2286 23.1733 19.1574 23.7305 17.8027 23.6717C17.0034 23.6372 16.1873 23.4017 15.4222 22.9256C12.5206 21.1203 12.2077 16.9962 12.1915 16.75C11.765 20.4313 9.89298 23.2464 7.54956 23.8696C5.43858 24.4312 3.69284 23.0149 3.3267 22.7179C0.149599 20.1404 0.0484915 14.7412 0.0134929 12.8761C-0.0463338 9.63004 -0.077743 3.47103 3.8783 1.3988C4.12299 1.27054 6.65127 -0.00286885 9.18104 1.19249C11.7476 2.4045 12.2513 5.18344 12.3022 5.49361C12.3743 3.20303 13.741 1.20856 15.7721 0.401133C17.5448 -0.303574 19.8939 -0.0932526 21.2248 1.13912C23.284 3.04665 20.5966 5.74038 20.532 11.9212C20.4727 17.6854 22.7473 21.5102 20.5951 22.9314Z" fill="#F5ECD6"/>
      </svg>
      <span>MC</span>
        </a>
    </section>
      <?php wp_nav_menu( array(
        'container' => false,
        'theme_location' => 'primary'
      )); ?>
      <div id="menu-wrapper">
         <div id="hamburger-menu"><span></span><span></span><span></span></div>
         <!-- hamburger-menu -->
      </div>
  </main>

</header><!--/.header-->
<?php require 'backgrounds/bg.php'; ?> 

