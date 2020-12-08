<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HOUSE_of_KILLLING
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<?php if ( has_post_thumbnail() ) : ?>
		<header class="entry-header">
			<div class="relative">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
				?>
				<?php house_of_killing_post_thumbnail(); ?>
				<div class="flex-row right absolute">
						<div class="dot"></div>
						<div class="dot"></div>
					</div>
			</div>
		</header><!-- .entry-header -->
	
	<?php else :
				
	
	endif; ?>
	
	

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'house_of_killing' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'house_of_killing' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->



	
</article><!-- #post-<?php the_ID(); ?> -->
