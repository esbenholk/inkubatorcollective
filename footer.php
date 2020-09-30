<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package inku
 */

?>
            

            </div><!-- .row -->

    </div><!-- .container -->

</main><!-- #main -->

<div class="inku-main-menu">  
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
                    
                                        
     <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'inku' ); ?>">
             
            <?php wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
             ) ); ?>
                       
    </nav><!-- #site-navigation -->
                    
</div><!-- /inku-main-menu -->

        



</body>


</html>
