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
<?php wp_head(); ?>
<!-- End WP_Head -->

</head>

<body <?php body_class(); ?>>
<div class="inku-preloader">
    <div class="eyes formatted">   
                        <div class="eye">
                                    <div class="ball"></div>
                                    <div class="lid"></div>
                        </div>

                                <div class="eye">
                                    <div class="ball"></div>
                                    <div class="lid"></div>
                            </div>   
                    </div>

    </div>

    <div class="inku-site-wrap">
        <?php
        $header_image = "";
        if ( get_header_image() ){
            $header_image = get_header_image();
        }
         
        ?>
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
					
					<a class="ticker-object">BODY OCCUPATION == </a><a class="ticker-object"> <?php bloginfo( 'name' ); ?></a><a class="ticker-object" >//RESEARCH RESIDENCY</a><a class="ticker-object" href="http://dadapost.com/"> @ DADA POST - BERLIN !!</a>
					<a class="ticker-object">BODY OCCUPATION == </a><a class="ticker-object"> <?php bloginfo( 'description' ); ?></a><a class="ticker-object" >//RESEARCH RESIDENCY</a><a class="ticker-object" href="http://dadapost.com/"> @ DADA POST - BERLIN !!</a>
					<a class="ticker-object">BODY OCCUPATION == </a><a class="ticker-object"> <?php bloginfo( 'name' ); ?></a><a class="ticker-object" >//RESEARCH RESIDENCY</a><a class="ticker-object" href="http://dadapost.com/"> @ DADA POST - BERLIN !!</a>
					<a class="ticker-object">BODY OCCUPATION == </a><a class="ticker-object"> <?php bloginfo( 'description' ); ?></a><a class="ticker-object" >//RESEARCH RESIDENCY</a><a class="ticker-object" href="http://dadapost.com/"> @ DADA POST - BERLIN !!</a>
	
				</div>
            </div>
            
    </div>
    <!-- <div id="ticker3">
				<div class="headlines">
					
                    <a href="/projects" class="ticker-object"> > Projects</a>
                    <a href="/artists" class="ticker-object"> > Artists</a>
                    <a href="/3Dexperiences" class="ticker-object"> > 3D</a>
                    <a href="/bodyoccupation" class="ticker-object"> > Body Occupation</a>
                    <a href="/collective" class="ticker-object"> > Inkubator Collective</a>
                    <a href="/projects" class="ticker-object"> > Projects</a>
                    <a href="/artists" class="ticker-object"> > Artists</a>
                    <a href="/3Dexperiences" class="ticker-object"> > 3D</a>
                    <a href="/bodyoccupation" class="ticker-object"> > Body Occupation</a>
                    <a href="/collective" class="ticker-object"> > Inkubator Collective</a>
                    <a href="/projects" class="ticker-object"> > Projects</a>
                    <a href="/artists" class="ticker-object"> > Artists</a>
                    <a href="/3Dexperiences" class="ticker-object"> > 3D</a>
                    <a href="/bodyoccupation" class="ticker-object"> > Body Occupation</a>
                    <a href="/collective" class="ticker-object"> > Inkubator Collective</a>
                    <a href="/projects" class="ticker-object"> > Projects</a>
                    <a href="/artists" class="ticker-object"> > Artists</a>
                    <a href="/3Dexperiences" class="ticker-object"> > 3D</a>
                    <a href="/bodyoccupation" class="ticker-object"> > Body Occupation</a>
                    <a href="/collective" class="ticker-object"> > Inkubator Collective</a>
                    <a href="/projects" class="ticker-object"> > Projects</a>
                    <a href="/artists" class="ticker-object"> > Artists</a>
                    <a href="/3Dexperiences" class="ticker-object"> > 3D</a>
                    <a href="/bodyoccupation" class="ticker-object"> > Body Occupation</a>
                    <a href="/collective" class="ticker-object"> > Inkubator Collective</a>
                    <a href="/projects" class="ticker-object"> > Projects</a>
                    <a href="/artists" class="ticker-object"> > Artists</a>
                    <a href="/3Dexperiences" class="ticker-object"> > 3D</a>
                    <a href="/bodyoccupation" class="ticker-object"> > Body Occupation</a>
                    <a href="/collective" class="ticker-object"> > Inkubator Collective</a>

				
				</div>
            </div> -->
            </div>  
            
          
              
    
        </header>
         


    <main id="main" class="site-main ">

        <div id="container" class="container">

            <div class="row">
