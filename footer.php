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

            </div><!-- /#row -->

        </div><!-- /#container -->

    </main><!-- #main -->
        



    <div class="">

    	<div class="sub-footer">
            <div id="ticker2">
                    <div class="headlines">
                        
                        <a class="ticker-object">BODY OCCUPATION == </a><a class="ticker-object"> <?php bloginfo( 'name' ); ?></a><a class="ticker-object" >//RESEARCH RESIDENCY</a><a class="ticker-object" href="http://dadapost.com/"> @ DADA POST - BERLIN !!</a>
                        <a class="ticker-object">BODY OCCUPATION == </a><a class="ticker-object"> <?php bloginfo( 'description' ); ?></a><a class="ticker-object" >//RESEARCH RESIDENCY</a><a class="ticker-object" href="http://dadapost.com/"> @ DADA POST - BERLIN !!</a>
                        <a class="ticker-object">BODY OCCUPATION == </a><a class="ticker-object"> <?php bloginfo( 'name' ); ?></a><a class="ticker-object" >//RESEARCH RESIDENCY</a><a class="ticker-object" href="http://dadapost.com/"> @ DADA POST - BERLIN !!</a>
                        <a class="ticker-object">BODY OCCUPATION == </a><a class="ticker-object"> <?php bloginfo( 'description' ); ?></a><a class="ticker-object" >//RESEARCH RESIDENCY</a><a class="ticker-object" href="http://dadapost.com/"> @ DADA POST - BERLIN !!</a>
        
                    </div>
                </div>
  
        </div><!-- .sub-footer -->
    </div><!-- .footer-wrap -->

</div><!-- /inku-site-wrap -->



<div class="inku-main-menu">  
    <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'inku' ); ?>">
        <?php wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
        ) ); ?>
    </nav><!-- #site-navigation -->
        
</div><!-- /inku-main-menu -->

        
    
                   

				
                    
                
              
           
	
		
			
	</div>


<?php wp_footer(); ?>

</body>
</html>
