<?php /* Template Name: Joannies Sound Page */ ?>


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

<?php $src = get_stylesheet_directory_uri().'/js/soundlandscape.js';?>

<script type="module" src="<?php echo esc_url($src); ?>"></script>

<div id="threeDfrontpage" class="page col-md-12">
			<audio loop id="music1" preload="auto" style="display: none">
				<source src="/wp-content/themes/inkubatorcollective/Nothing but Sheepdog Thing (online-audio-converter.com).mp3"></source>
			</audio>
			<audio loop id="music2" preload="auto" style="display: none">
				<source src="/wp-content/themes/inkubatorcollective/Nothing but Sheepdog Thing (online-audio-converter.com).mp3"></source>
			</audio>
			<audio loop id="music3" preload="auto" style="display: none">
				<source src="/wp-content/themes/inkubatorcollective/Nothing but Sheepdog Thing (online-audio-converter.com).mp3"></source>
			</audio>
			
			<audio loop id="music4" preload="auto" style="display: none">
				<source src="/wp-content/themes/inkubatorcollective/Nothing but Sheepdog Thing (online-audio-converter.com).mp3"></source>
			</audio>
			<audio loop id="music5" preload="auto" style="display: none">
				<source src="/wp-content/themes/inkubatorcollective/Nothing but Sheepdog Thing (online-audio-converter.com).mp3"></source>
			</audio>
			<audio loop id="music6" preload="auto" style="display: none">
				<source src="/wp-content/themes/inkubatorcollective/Nothing but Sheepdog Thing (online-audio-converter.com).mp3"></source>
			</audio>
			<audio loop id="music7" preload="auto" style="display: none">
				<source src="/wp-content/themes/inkubatorcollective/Nothing but Sheepdog Thing (online-audio-converter.com).mp3"></source>
			</audio>

	
	<div id="canvas" class="online-exhibition-canvas"></div>
	
	<div id="container"></div>
			
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






	
<?php get_footer(); ?>




