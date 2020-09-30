



<?php if ( get_field( '3d_image' ) ) : ?>
	<?php get_header(); ?>
	<img id="sky" style="display:none;" src="<?php the_field( '3d_image' ); ?>" />

	<div id="canvas"></div>
	<div class="instruction">
			<div id="buttons">
					<button id="mobileToggle" class="devicetoggle">MOBILE</button>
					<button id="desktopToggle" class="devicetoggle">DESKTOP</button>
			</div>
		</div>

	</div>
	<?php $src = get_stylesheet_directory_uri().'/js/skybox.js' ?>

	<script type="module" src="<?php echo esc_url($src); ?>"></script>








<?php elseif ( get_field( '3d_video' ) ) : ?>
	<?php get_header(); ?>
	<video id="sky" controls autoplay muted>
    	<source src="<?php the_field( '3d_video' ); ?>" type="video/mp4" />
    	Your browser does not support the video tag.
 	 </video>
	<div id="canvas"></div>
		<div class="instruction">
			<div id="buttons">
					<button id="mobileToggle" class="devicetoggle">MOBILE</button>
					<button id="desktopToggle" class="devicetoggle">DESKTOP</button>
			</div>
		</div>
	</div>
	<?php $src = get_stylesheet_directory_uri().'/js/skybox-video.js'; ?>

	<script type="module" src="<?php echo esc_url($src); ?>"></script>

<?php else: ?>
	<?php get_header(); ?>
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

				

				

			<?php endwhile; // End of the loop. ?>

		</div><!-- #content -->

	<?php endif; ?>
	


<?php endif ?>
<?php inku_post_navigation(); ?>



<?php get_footer(); ?>

