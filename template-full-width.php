<?php
/*
Template Name: Full Width
*/
?>
<?php
/**
 * The template for Full Width
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package inku
 */

get_header(); ?>

	<div id="content" class="col-md-12">

		<?php
		$inku_show_title = rwmb_meta( 'inku_show_title' );
		if ( 'no' != $inku_show_title ) {
		?>
			<header class="page-header">
				<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
			</header><!-- .page-header -->
		<?php } ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
				$inku_page_content = get_the_content();
				if ( ! empty( $inku_page_content ) ) {
				?>
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				<?php } ?>

			</article><!-- #post-## -->

		<?php endwhile; // End of the loop. ?>

		<div class="clearfix"></div>

	</div><!-- /content -->

<?php get_footer(); ?>
