<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package inku
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function inku_body_classes( $classes ) {

    $inku_theme_data = wp_get_theme();

    $classes[] = sanitize_title( $inku_theme_data['Name'] );
    $classes[] = 'v' . $inku_theme_data['Version'];

    $inku_slider_fullscreen = get_theme_mod( 'inku_slider_fullscreen', false );
    if ( class_exists( 'WooCommerce' ) ){
        if ( is_shop() && $inku_slider_fullscreen || isset( $_GET[ 'fullscreen_slider' ] ) ) {
            $classes[] = 'slider-fullscreen';
        }
    }

    // Add Animations Class
    $inku_site_animations = get_theme_mod( 'inku_site_animations', 'true' );
    if ( 'true' == $inku_site_animations ) {
        $classes[] = 'ql_animations ql_portfolio_animations';
    }


    //Add Single Portfolio classes
    if ( is_single() && inku_is_portfolio_type( get_post_type() ) ) :

        $classes[] = 'inku-portfolio-type';

	endif;

    //Add class for Blog Layout
    $inku_blog_layout = get_theme_mod( 'inku_blog_layout', 'layout-1' );
    if ( isset( $_GET[ 'blog_layout' ] ) ) {
        $inku_blog_layout = sanitize_text_field( wp_unslash( $_GET[ 'blog_layout' ] ) );
    }
    $classes[] = 'inku-blog-' . esc_attr( $inku_blog_layout );

    //Add class for Site Layout
    $inku_site_layout = get_theme_mod( 'inku_site_layout', 'default' );
    if ( isset( $_GET[ 'site_layout' ] ) ) {
        $inku_site_layout = sanitize_text_field( wp_unslash( $_GET[ 'site_layout' ] ) );
    }
    $classes[] = 'inku-' . esc_attr( $inku_site_layout );

    //Add class for Top Bar
    $inku_topbar_enable = get_theme_mod( 'inku_topbar_enable', 'default' );
    if ( isset( $_GET[ 'top_bar' ] ) || $inku_topbar_enable ) {
        $classes[] = 'inku-with-top-bar';
    }
    
    //Add class if there is Sidebar
    if ( is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'inku-with-sidebar';
    }else{
        $classes[] = 'inku-with-out-sidebar';
    }

    //Add class for Header
    $inku_header_layout = get_theme_mod( 'inku_header_layout', 'header-1' );
    if ( isset( $_GET[ 'header_layout' ] ) ) {
        $inku_header_layout = sanitize_text_field( wp_unslash( $_GET[ 'header_layout' ] ) );
    }
    $classes[] = 'inku-' . esc_attr( $inku_header_layout );

    //Add class for Product View Enable/Disable
    $inku_shop_quick_view = get_theme_mod( 'inku_shop_quick_view', '1' );
    if ( '1' == $inku_shop_quick_view || isset( $_GET[ 'quick_view' ] ) ) {
        $classes[] = 'inku-product-view-enable';
    }else{
        $classes[] = 'inku-product-view-disable';
    }

    //Add class for Products delay animations
    $classes[] = 'inku-products-delay';

	return $classes;
}
add_filter( 'body_class', 'inku_body_classes' );


if ( ! function_exists( 'inku_new_content_more' ) ){
    function inku_new_content_more($more) {
           global $post;
           return ' <br><a href="' . esc_url( get_permalink() ) . '" class="more-link read-more">' . esc_html__( 'Read more', 'inku' ) . '</a>';
    }
}// end function_exists
    add_filter( 'the_content_more_link', 'inku_new_content_more' );


/**
 * Meta Slider configurations
 */
function inku_metaslider_default_slideshow_properties( $params ) {
        $params['width'] = 1450;
        $params['height'] = 700;
	return $params;
}
add_filter( 'metaslider_default_parameters', 'inku_metaslider_default_slideshow_properties', 10, 1 );

/**
 * Meta Slider referall ID
 */
function inku_metaslider_hoplink( $link ) {
    return "https://getdpd.com/cart/hoplink/15318?referrer=24l934xmnt6sc8gs";

}
add_filter( 'metaslider_hoplink', 'inku_metaslider_hoplink', 10, 1 );

/**
 * Retrieve sliders from Meta Slider plugin
 */
function inku_all_meta_sliders( $sort_key = 'date' ) {

    $sliders = array();

    // list the tabs
    $args = array(
        'post_type' => 'ml-slider',
        'post_status' => 'publish',
        'orderby' => $sort_key,
        'suppress_filters' => 1, // wpml, ignore language filter
        'order' => 'ASC',
        'posts_per_page' => -1
    );

    $args = apply_filters( 'metaslider_all_meta_sliders_args', $args );

    // WP_Query causes issues with other plugins using admin_footer to insert scripts
    // use get_posts instead
    $all_sliders = get_posts( $args );

    foreach( $all_sliders as $slideshow ) {

        $sliders[] = array(
            'title' => $slideshow->post_title,
            'id' => $slideshow->ID
        );

    }

    return $sliders;

}


/**
 * Convert HEX colors to RGB
 */
function inku_hex2rgb( $colour ) {
    $colour = str_replace("#", "", $colour);
    if ( strlen( $colour ) == 6 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
    } elseif ( strlen( $colour ) == 3 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
    } else {
            return false;
    }
    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Return only slug from all portfolios CPT
 *
 * @return array
 */
 function inku_get_portfolios_slug(){

    if ( class_exists( 'Multiple_Portfolios' ) ) {

        $inku_portfolio_types = Multiple_Portfolios::get_post_types();
        $inku_portfolio_types_slugs = array();
        foreach ( $inku_portfolio_types as $portfolio ) {
            $inku_portfolio_types_slugs[] = $portfolio['slug'];
        }
        return $inku_portfolio_types_slugs;
    }else{
        return new WP_Error( 'plugin_missing', esc_html__( 'Multiple Portfolios plugin not installed', 'inku' ) );
    }

 }


/**
* Return portfolios as option for Meta Box
*
* @return array
*/
function inku_get_portfolios_options(){

    if ( class_exists( 'Multiple_Portfolios' ) ) {

        $inku_portfolio_types = Multiple_Portfolios::get_post_types();
        $inku_portfolio_types_option = array();
        foreach ( $inku_portfolio_types as $portfolio ) {
            $inku_portfolio_types_option[$portfolio['slug']] = $portfolio['name'];
        }
        return $inku_portfolio_types_option;
    }else{
        return new WP_Error( 'plugin_missing', esc_html__( 'Multiple Portfolios plugin not installed', 'inku' ) );
    }

}


/**
 * Return only slug from all portfolios CPT
 *
 * @return array
 */
 function inku_is_portfolio_category( $category ){

    if ( class_exists( 'Multiple_Portfolios' ) ) {

        $inku_portfolio_types = Multiple_Portfolios::get_post_types();
        $taxonomy_objects = get_object_taxonomies( 'portfolio' );

        foreach ( $inku_portfolio_types as $portfolio ) {
            $taxonomy_objects = get_object_taxonomies( $portfolio );
            $portfolio_tax_category = $taxonomy_objects[0]; //portfolio_category
            if ( $category == $portfolio_tax_category ) {
                return true;
            }
        }
        return false;
    }else{
        return new WP_Error( 'plugin_missing', esc_html__( 'Multiple Portfolios plugin not installed', 'inku' ) );
    }

 }


/**
* Avoid undefined functions if Meta Box is not activated
*
* @return bool
*/
if ( ! function_exists( 'rwmb_meta' ) ) {
    function rwmb_meta( $key, $args = '', $post_id = null ) {
        return false;
    }
}


/**
* Check if the post type is a Portfolio post type
*
* @return bool
*/
if ( ! function_exists( 'inku_is_portfolio_type' ) ) {
    function inku_is_portfolio_type( $post_type ) {

    	$inku_portfolios_post_types = inku_get_portfolios_slug();
        if ( ! is_wp_error( $inku_portfolios_post_types ) ) {
        	if ( in_array( $post_type, $inku_portfolios_post_types ) ) :
                return true;
            else:
                return false;
            endif;
        }else{
            return false;
        }

    }
}


/**
* Display Portfolio or Post navigation
*
* @return html
*/
if ( ! function_exists( 'inku_post_navigation' ) ) {
    function inku_post_navigation() {

        $post_nav_bck = '';
        $post_nav_bck_next = '';
        $prev_post = get_previous_post();
        if ( ! empty( $prev_post ) ):
            $portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ), 'inku_portfolio' );
            if ( ! empty( $portfolio_image ) ) {
                $post_nav_bck = ' style="background-image: url(' . esc_url( $portfolio_image[0] ) . ');"';
            }
        endif;
        $next_post = get_next_post();
        if ( ! empty( $next_post ) ):
            $portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ), 'inku_portfolio' );
            if ( ! empty( $portfolio_image ) ) {
                $post_nav_bck_next = ' style="background-image: url(' . esc_url( $portfolio_image[0] ) . ');"';
            }
        endif;

        if ( ! empty( $prev_post ) || ! empty( $next_post ) ):
        ?>
            <nav class="navigation post-navigation" >
                <div class="nav-links">
                    <?php if ( ! empty( $prev_post ) ): ?>
                    <div class="nav-previous" <?php echo $post_nav_bck; // WPCS: XSS OK. ?>>
                        <?php
                        $prev_text = esc_html__( '', 'inku' );
                        if ( inku_is_portfolio_type( get_post_type() ) ) {
                            $prev_text = esc_html__( 'Previous Project', 'inku' );
                        }
                        ?>
                        <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev"><span><?php echo $prev_text; // WPCS: XSS OK. ?></span><?php echo esc_html( $prev_post->post_title ); ?></a>
                    </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $next_post ) ): ?>
                    <div class="nav-next" <?php echo $post_nav_bck_next; // WPCS: XSS OK. ?>>
                        <?php
                        $next_text = esc_html__( '', 'inku' );
                        if ( inku_is_portfolio_type( get_post_type() ) ) {
                            $next_text = esc_html__( 'Next Project', 'inku' );
                        }
                        ?>
                        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next"><span><?php echo $next_text; // WPCS: XSS OK. ?></span><?php echo esc_html( $next_post->post_title ); ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            </nav>
        <?php endif;

    }
}

/**
* Return a darker color in HEX
*
* @return string
*/
function inku_darken_color( $rgb, $darker = 2 ) {

    $hash = (strpos($rgb, '#') !== false) ? '#' : '';
    $rgb = (strlen($rgb) == 7) ? str_replace('#', '', $rgb) : ((strlen($rgb) == 6) ? $rgb : false);
    if(strlen($rgb) != 6) return $hash.'000000';
    $darker = ($darker > 1) ? $darker : 1;

    list($R16,$G16,$B16) = str_split($rgb,2);

    $R = sprintf("%02X", floor(hexdec($R16)/$darker));
    $G = sprintf("%02X", floor(hexdec($G16)/$darker));
    $B = sprintf("%02X", floor(hexdec($B16)/$darker));

    return $hash.$R.$G.$B;
}


/**
 * Enqueues front-end CSS for retina images of portfolio.
 *
 * @see wp_add_inline_style()
 */
function inku_portfolio_retina_images() {

    $custom_css = inku_get_portfolio_retina_css();

    wp_add_inline_style( 'inku_style', $custom_css );

}
add_action( 'wp_enqueue_scripts', 'inku_portfolio_retina_images' );


/**
 * Returns CSS for the color schemes.
 *
 * @param array $colors colors.
 * @return string CSS.
 */
function inku_get_portfolio_retina_css() {


    $inku_portfolio_display = rwmb_meta( 'inku_portfolio_display' );
    $inku_retina_css = '';

    $args = array(
        'post_type'      => $inku_portfolio_display,
        'posts_per_page' => -1,
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {


        while ( $the_query->have_posts() ) { $the_query->the_post();

            if ( has_post_thumbnail() ) {
                $portfolio_image_2x = wp_get_attachment_image_src( get_post_thumbnail_id(), 'inku_portfolio_2x' );

                $inku_retina_css .= "@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {";
                $inku_retina_css .= "#portfolio-item-" . esc_attr( get_the_ID() ) . "{ background-image: url(" . esc_url( $portfolio_image_2x[0] ) . "); }";
                $inku_retina_css .=  "}\n";
            }
            
        }//while


    }// if have posts
    wp_reset_postdata();


    $css = <<<CSS

    /*============================================
    // Retina Images
    ============================================*/
    {$inku_retina_css}
    


CSS;

    return $css;
}




/**
* Return CSS class for #content
*
* @return bool
*/
if ( ! function_exists( 'inku_content_css_class' ) ) {
    function inku_content_css_class() {

        if ( is_page_template( 'template-full-width.php' ) ) {
            return 'col-md-12';
        }
        if ( is_page_template( 'template-fullscreen.php' ) ) {
            return '';
        }

        $inku_site_layout = get_theme_mod( 'inku_site_layout', 'default' );
        if ( isset( $_GET[ 'site_layout' ] ) ) {
            $inku_site_layout = sanitize_text_field( wp_unslash( $_GET[ 'site_layout' ] ) );
        }

        switch ( $inku_site_layout ) {
            case 'default':
                if ( is_single() && is_active_sidebar( 'sidebar-1' ) && ! is_singular( array( 'product' ) ) ) {
                    return 'col-md-6 col-md-push-2';
                }else{
                    return 'col-md-8 col-md-push-2';
                }
                break;

            case 'sidenav':
                if ( is_single() && is_active_sidebar( 'sidebar-1' ) && ! is_singular( array( 'product' ) ) ) {
                    return 'col-md-6 col-md-push-2';
                }else{
                    return 'col-md-8 col-md-push-2';
                }
                break;            
            default:
                return 'col-md-8 col-md-push-2';
                break;
        }

    }
}



/**
* Return CSS class for #footer
*
* @return bool
*/
if ( ! function_exists( 'inku_footer_css_class' ) ) {
    function inku_footer_css_class() {

        $inku_site_layout = get_theme_mod( 'inku_site_layout', 'default' );
        if ( isset( $_GET[ 'site_layout' ] ) ) {
            $inku_site_layout = sanitize_text_field( wp_unslash( $_GET[ 'site_layout' ] ) );
        }

        switch ( $inku_site_layout ) {
            case 'default':
                    return 'col-md-8 col-md-push-2';
                break;

            case 'sidenav':
                    return 'col-md-12';
                break;            
            default:
                return 'col-md-8 col-md-push-2';
                break;
        }

    }
}

/**
* Return CSS class for Shop Page
*
* @return bool
*/
if ( ! function_exists( 'inku_shop_css_class' ) ) {
    function inku_shop_css_class() {

        $inku_shop_page_layout = get_theme_mod( 'inku_shop_page_layout', 'shop-narrow' );
        if ( isset( $_GET[ 'shop_page_layout' ] ) ) {
            $inku_shop_page_layout = sanitize_text_field( wp_unslash( $_GET[ 'shop_page_layout' ] ) );
        }

        switch ( $inku_shop_page_layout ) {
            case 'shop-narrow':
                return 'col-md-8 col-md-push-2';
                break;

            case 'shop-fullwidth':
                return 'col-md-12';
                break;
            
            default:
                return 'col-md-8 col-md-push-2';
                break;
        }

    }
}


/**
* Return CSS class for Container
*
* @return bool
*/
if ( ! function_exists( 'inku_container_css_class' ) ) {
    function inku_container_css_class() {
        $inku_site_layout = get_theme_mod( 'inku_site_layout', 'default' );
        if ( isset( $_GET[ 'site_layout' ] ) ) {
            $inku_site_layout = sanitize_text_field( wp_unslash( $_GET[ 'site_layout' ] ) );
        }

        //Default
        $container_css_class = 'container';

         if ( ! is_singular( array( 'product' ) ) ) {
    
            if( 'default' == $inku_site_layout ){

                $inku_shop_page_layout = get_theme_mod( 'inku_shop_page_layout', 'shop-narrow' );
                if ( isset( $_GET[ 'shop_page_layout' ] ) ) {
                    $inku_shop_page_layout = sanitize_text_field( wp_unslash( $_GET[ 'shop_page_layout' ] ) );
                }

                //If it is Shop or Shop Archive page, show as full width.
                if ( function_exists( 'is_shop' ) ) {
                    if ( ( is_shop() || is_product_category() ) && 'shop-fullwidth' == $inku_shop_page_layout ) {
                        $container_css_class = 'container-fluid';                    
                    }
                }
                

            }elseif( 'sidenav' == $inku_site_layout ){
                $container_css_class = 'container-fluid';
            }
        }

        if ( is_page_template( 'template-full-width.php' ) ) {
            $container_css_class = 'container-fluid';
        }
        if ( is_page_template( 'template-fullscreen.php' ) ) {
            $container_css_class = '';
        }

        return $container_css_class;

    }
}

/**
* Return CSS class for Main
*
* @return bool
*/
if ( ! function_exists( 'inku_main_css_class' ) ) {
    function inku_main_css_class() {
        //Default
        $main_css_class = 'row';

        if ( is_page_template( 'template-fullscreen.php' ) ) {
            $main_css_class = '';
        }

        return $main_css_class;

    }
}



/**
 * Return SVG markup.
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 *     @type string $title Optional SVG title.
 *     @type string $desc  Optional SVG description.
 * }
 * @return string SVG markup.
 */
function inku_get_svg( $args = array() ) {
    // Make sure $args are an array.
    if ( empty( $args ) ) {
        return __( 'Please define default parameters in the form of an array.', 'inku' );
    }

    // Define an icon.
    if ( false === array_key_exists( 'icon', $args ) ) {
        return __( 'Please define an SVG icon filename.', 'inku' );
    }

    // Set defaults.
    $defaults = array(
        'icon'        => '',
        'title'       => '',
        'desc'        => '',
        'fallback'    => false,
    );

    // Parse args.
    $args = wp_parse_args( $args, $defaults );

    // Set aria hidden.
    $aria_hidden = ' aria-hidden="true"';

    // Set ARIA.
    $aria_labelledby = '';

    /*
     * Twenty Seventeen doesn't use the SVG title or description attributes; non-decorative icons are described with .screen-reader-text.
     *
     * However, child themes can use the title and description to add information to non-decorative SVG icons to improve accessibility.
     *
     * Example 1 with title: <?php echo inku_get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ) ) ); ?>
     *
     * Example 2 with title and description: <?php echo inku_get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ), 'desc' => __( 'This is the description', 'textdomain' ) ) ); ?>
     *
     * See https://www.paciellogroup.com/blog/2013/12/using-aria-enhance-svg-accessibility/.
     */
    if ( $args['title'] ) {
        $aria_hidden     = '';
        $unique_id       = uniqid();
        $aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';

        if ( $args['desc'] ) {
            $aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
        }
    }

    // Begin SVG markup.
    $svg = '<svg class="icon icon-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

    // Display the title.
    if ( $args['title'] ) {
        $svg .= '<title id="title-' . $unique_id . '">' . esc_html( $args['title'] ) . '</title>';

        // Display the desc only if the title is already set.
        if ( $args['desc'] ) {
            $svg .= '<desc id="desc-' . $unique_id . '">' . esc_html( $args['desc'] ) . '</desc>';
        }
    }

    /*
     * Display the icon.
     *
     * The whitespace around `<use>` is intentional - it is a work around to a keyboard navigation bug in Safari 10.
     *
     * See https://core.trac.wordpress.org/ticket/38387.
     */
    $svg .= ' <use href="#icon-' . esc_html( $args['icon'] ) . '" xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use> ';

    // Add some markup to use as a fallback for browsers that do not support SVGs.
    if ( $args['fallback'] ) {
        $svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
    }

    $svg .= '</svg>';

    return $svg;
}


/**
 * Add dropdown icon if menu item has children.
 *
 * @param  string $title The menu item's title.
 * @param  object $item  The current menu item.
 * @param  array  $args  An array of wp_nav_menu() arguments.
 * @param  int    $depth Depth of menu item. Used for padding.
 * @return string $title The menu item's title with dropdown icon.
 */
function inku_dropdown_icon_to_menu_link( $title, $item, $args, $depth ) {
    if ( 'primary' === $args->theme_location ) {
        foreach ( $item->classes as $value ) {
            if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
                $title = $title . '<i class="fa-angle-down fa icon"></i>';
            }
        }
    }

    return $title;
}
add_filter( 'nav_menu_item_title', 'inku_dropdown_icon_to_menu_link', 10, 4 );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function inku_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'inku_pingback_header' );