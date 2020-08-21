


<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package inku
 */

get_header(); ?>

<?php if ( get_field( '3d_image' ) ) : ?>
	<img id="sky" style="display:none;" src="<?php the_field( '3d_image' ); ?>" />

	<div id="canvas">
		
	</div>
	<div id="buttons">
  			<button id="mobileToggle" class="devicetoggle">MOBILE</button>
  			<button id="desktopToggle" class="devicetoggle">DESKTOP</button>
	</div>

</div>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/three.js/84/three.min.js"></script>
	<?php

	$src = get_stylesheet_directory_uri().'/js/skybox.js';
	?>
	<script type="module" src="<?php echo esc_url($src); ?>"></script>
<?php else: ?>
	<?php

	if ( 'jetpack-portfolio' == get_post_type() ) :
	?>
		<div id="content" class="col-md-10 col-md-push-1">

			<?php get_template_part( 'template-parts/single-portfolio', 'single' ); ?>

		</div><!-- #content -->
	<?php
	else:
	?>

		<div id="content" class="site-content col-md-8" role="content">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'single' ); ?>

				<?php inku_post_navigation(); ?>

				

			<?php endwhile; // End of the loop. ?>

		</div><!-- #content -->

	<?php endif; ?>
	


<?php endif ?>
	

<?php get_footer(); ?>
<?php inku_post_navigation(); ?>

