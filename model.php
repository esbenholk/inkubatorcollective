<?php /* Template Name: premade model */ ?>


<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 *@package HOUSE_OF_KILLING
 */

get_header(); ?>

<?php $src = get_stylesheet_directory_uri().'/js/light.js';?>

<script type="module" src="<?php echo esc_url($src); ?>"></script>

<div id="threeDfrontpage" class="page col-md-12">
    <div  id='loading-screen' class="loading-container">
            <div id="loading-status" class="loading-circle">
                <div class="loader">
                    <p>loading... <br>
                    </p>
                </div>
            </div>
    </div>
	
	<div id="canvas" class="online-exhibition-canvas">
       
        <div class="instruction">	
					<div class="absolute left flex-row">
						<div class="dot"></div>
						<div class="dot"></div>
					</div>
					<p>
						<p id="project-title">
							
						</p>

					</p>
				
			</div>	


    </div>
			
	<?php while ( have_posts() ) : the_post(); ?>

		<div class="site-content">
           
           
		
            <p><?php the_content() ?></p>
          

		</div>

	<?php endwhile; // End of the loop. ?>

    <div id="infobox" style="display: none; ">
                <div class="frame">
                    <div id="closingbutton">X</div>
                    <h1 id="artwork"></h1>
                    <h1 id="artist-name"></h1>
                    <p id="material"></p>
                    <p id="description"></p>
                    <p id="artist-url"></p>
                    <div id="images"></div>
        </div>
    </div>

    
    
											
</div>


	

		


	
<?php get_footer(); ?>


	

		


