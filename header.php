<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package inku
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">


<!-- WP_Head -->
<?php wp_head(); 
    $image = wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'large');?>
    <!-- End WP_Head -->
    <meta property="og:image" content="<?php echo $image; ?>" />
    <meta name="twitter:image" content="<?php echo $image; ?>" />
</head>

<body>
<div class="inku-preloader">
                    <div class="eyes formatted">   
                            <div class="eye eyeload">
                                    <div class="ball"></div>
                                    <div class="lid"></div>
                            </div>
                           
                            <div class="eye eyeload">
                                    <div class="ball"></div>
                                    <div class="lid"></div>
                            </div>   
                         
                    </div>
</div>


 <header id="header" class="site-header" <?php echo ( $header_image ) ? 'style="background-image: url(' . esc_url( $header_image ) . ');"' : ''; ?>>
            <div class="fixedtop">
                <div class="row1">
                        <button id="inku-nav-btn" type="button" class="menu-toggle" data-toggle="collapse" aria-controls="primary-menu" aria-expanded="false">
                            <div class="eyes">   
                                <div class="eye">
                                            <div class="ball"></div>
                                            <div class="lid"></div>
                                </div>

                                        <div class="eye">
                                            <div class="ball"></div>
                                            <div class="lid"></div>
                                    </div>   
                            </div>
                        </button>  
   
                        <div id="ticker1">
                            <div class="headlines">
                                
                                <a href="/body-occupation/" class="ticker-object"> <?php the_excerpt(); ?> </a>
                                <a href="/body-occupation/" class="ticker-object"> <?php the_excerpt(); ?> </a> 
                                <a href="/body-occupation/" class="ticker-object"> <?php the_excerpt(); ?> </a> 
                                <a href="/body-occupation/" class="ticker-object"> <?php the_excerpt(); ?> </a> 
                                <a href="/body-occupation/" class="ticker-object"> <?php the_excerpt(); ?> </a> 
                                <a href="/body-occupation/" class="ticker-object"> <?php the_excerpt(); ?> </a> 
                                <a href="/body-occupation/" class="ticker-object"> <?php the_excerpt(); ?> </a>

                            </div>
                        
                        </div>
                
                </div> <!-- ROW ONE -->
            <div><!-- FIXED TOP -->
        </header>

         


<main id="main" class="site-main ">

    <div id="container" class="container">

         <div class="row">
