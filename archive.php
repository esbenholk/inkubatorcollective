<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package inkubator
 */

get_header();
?>

<main id="primary" class="site-main" id="archive-page">
		<?php $src = get_stylesheet_directory_uri().'/js/raycast-picker.js';?>

		<script type="module" src="<?php echo esc_url($src); ?>"></script>

		<div class="relative">

			<div  id='loading-screen' class="loading-container">
						<div id="loading-status" class="loading-circle">
							<div class="loader">
								<p>loading... <br>
								</p>
							</div>
						</div>
			</div>

			<div id="canvas" class="online-exhibition-canvas"></div>
		
			<div class="fixed media-relative">
				<div id="archive">
					<?php if ( have_posts() ) : ?>
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							// /*
							// * Include the Post-Type-specific template for the content.
							// * If you want to override this in a child theme, then include a file
							// * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							// */
							get_template_part( 'template-parts/archive-item', get_post_type() );

							?>
								

						<?php

						endwhile;
						

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
				</div>
			</div>
		
		
		</div>	




		
</main><!-- #main -->





<div id="crystal" >	
	<div class="flex-row right absolute">
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
	</div>

	<img  src="https://stayvirtual.s3.amazonaws.com/crystals/greencrystal">

</div>