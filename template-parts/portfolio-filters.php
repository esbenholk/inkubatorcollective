<?php
$inku_portfolio_display = rwmb_meta( 'inku_portfolio_display' );

//Portfolio Categories
$terms = get_terms( array(
    'taxonomy' => $inku_portfolio_display . '_category'
) );
?>
<?php if ( ! is_wp_error( $terms ) ): ?>
    <div class="ql_filter filter_list">
        <ul>
            <li class="active"><a href="#" data-category="all" data-filter="*" ><?php esc_html_e( 'All', 'inku' ); ?></a></li>
            <?php foreach ( $terms as $term ) { ?>
                    <li><a href="#" data-category="<?php echo esc_attr( $term->slug ); ?>" data-filter=".<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
            <?php } ?>
        </ul>
        <div class="clearfix"></div>
    </div><!-- /ql_filter -->
<?php endif; ?>
