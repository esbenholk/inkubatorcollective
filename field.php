<?php /* Template Name: Field with Flag (static) */ ?>

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
 * @package inku
 */

get_header(); ?>

<?php $src = get_stylesheet_directory_uri().'/js/soundmeadow.js';?>

<script type="module" src="<?php echo esc_url($src); ?>"></script>

<div id="threeDfrontpage" class="page col-md-12">
	
	<div id="canvas" class="online-exhibition-canvas"></div>
			
	<?php while ( have_posts() ) : the_post(); ?>

		<div class="site-content">
			<div class="instruction">
				<p>
					these pages are virtual landscapes. <br>
					start by pressing 'start' <br>
					navigate by using AWSD and the mouse.<br>
					<br>
					u escape them by pressing ESC
				</p>
								
				<div id="buttons">
						<button id="desktopToggle" class="devicetoggle"> click to start >>></button>
				</div>	
			</div>	
			<p><?php the_content() ?></p>
		</div>

	<?php endwhile; // End of the loop. ?>
											
</div>


	

		


	
<?php get_footer(); ?>
