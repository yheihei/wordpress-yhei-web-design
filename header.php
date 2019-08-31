<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package draft_portfolio
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link href="https://fonts.googleapis.com/css?family=Saira+Condensed:100,400,900" rel="stylesheet">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site  grid">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'draft-portfolio' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
	<div class="site-branding col-6-12">
	<h1 class="site-title">
			<?php

                $output = null;

                if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                    $output .= get_custom_logo();
                } else {
                    $output .= '<a href="'. esc_url( trailingslashit( home_url() ) ).'" title="'.esc_attr( get_bloginfo( 'name' ) ).'" rel="home">';
                    $output .= get_bloginfo( 'name' );
                    $output .= '</a>';
                }

                echo $output; ?>
                
            </h1>
            <?php

            $description = get_bloginfo( 'description', 'display' );
            if ( ( function_exists( 'the_custom_logo' ) && ! has_custom_logo() ) && $description || is_customize_preview() ) : ?>
                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
            <?php endif; ?>
		</div><!-- .site-branding -->

		<div class="main-nav col-6-12 pull-right">

		<?php	if (  has_nav_menu( 'primary' ) ) {
		 wp_nav_menu(array(
        'menu' => 'Main Navigation',
        'container_id' => 'cssmenu',
        'theme_location' => 'primary',
        'walker' => new Draft_Portfolio_CSS_Menu_Walker()
    	));	}?>
    	</div>
        <!--<?php do_action('draft-welcome-text')?>-->
        <?php if ( is_front_page() ) : ?>
        <div class="col-10-12 welcome">
            <h1>Welcome To Yhei Web Desgin,<br>
I Am A Professional Web Designer & Writer <br>
From Sapporo.</h1>
        </div>
        <?php endif; ?>
        <?php if ( is_category() ) : ?>
        <?php
        $cat_info = get_category( $cat );
        ?>
        <div class="welcome">
            <h1 class="heading heading--primary heading--dropcap"><?php echo wp_specialchars( $cat_info->name ); ?></h1>
        </div>
        <?php endif; ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-99703120-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-99703120-1');
        </script>

	</header><!-- #masthead -->


	<div id="content" class="site-content">

