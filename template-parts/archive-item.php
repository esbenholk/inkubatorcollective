<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package inku
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( has_post_thumbnail() ) : ?>
		<div class="teaser">
            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
            	<?php 
            	$inku_blog_layout = get_theme_mod( 'inku_blog_layout', 'layout-1' );
            	if ( isset( $_GET[ 'blog_layout' ] ) && 'layout-4' == $_GET[ 'blog_layout' ] || 'layout-4' == $inku_blog_layout ) {
			        $inku_thumbnail_size = 'inku_post_wide';
			    }
            	?>
				<?php the_post_thumbnail(); ?>
				<?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

            </a>
        </div><!-- /post-image -->
        <?php endif; ?>

</article><!-- #post-## -->

