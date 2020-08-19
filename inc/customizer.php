<?php
/**
 * inku Theme Customizer.
 *
 * @package inku
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function inku_customize_register( $wp_customize ) {


	/**
	 * Control for the PRO buttons
	 */
	class inku_Pro_Version extends WP_Customize_Control{
		public function render_content()
		{
			$args = array(
				'a' => array(
					'href' => array(),
					'title' => array()
					),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				);
			echo wp_kses( $this->label, $args );
		}
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';



	/*
    Colors
    ===================================================== */
    	/*
		Featured
		------------------------------ */
		$wp_customize->add_setting( 'inku_hero_color', array( 'default' => '#0000ff', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inku_hero_color', array(
			'label'        => esc_html__( 'Featured Color', 'inku' ),
			'section'    => 'colors',
		) ) );

		/*
		Headings
		------------------------------ */
		$wp_customize->add_setting( 'inku_headings_color', array( 'default' => '#222222', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inku_headings_color', array(
			'label'        => esc_html__( 'Headings Color', 'inku' ),
			'section'    => 'colors',
		) ) );

		/*
		Text
		------------------------------ */
		$wp_customize->add_setting( 'inku_text_color', array( 'default' => '#808080', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inku_text_color', array(
			'label'        => esc_html__( 'Text Color', 'inku' ),
			'section'    => 'colors',
		) ) );

		/*
		Link
		------------------------------ */
		$wp_customize->add_setting( 'inku_link_color', array( 'default' => '#0000ff', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inku_link_color', array(
			'label'        => esc_html__( 'Link Color', 'inku' ),
			'section'    => 'colors',
		) ) );

		/*
		Footer Background
		------------------------------ */
		$wp_customize->add_setting( 'inku_footer_background', array( 'default' => '#ffffff', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inku_footer_background', array(
			'label'        => esc_html__( 'Footer Background Color', 'inku' ),
			'section'    => 'colors',
		) ) );



	if ( class_exists( 'Kirki' ) ){

		Kirki::add_config( 'inku', array(
			'capability'    => 'edit_theme_options',
			'option_type'   => 'theme_mod',
		) );

	}


    /*
    Site Options
    ===================================================== */

    $wp_customize->add_section( 'inku_site_options_section', array(
			'title' => esc_html__( 'Site Options', 'inku' ),
			'priority' => 140,
	) );

	$animations_options = array(
			'true' => esc_html__( 'Enable', 'inku' ),
			'false' => esc_html__( 'Disable', 'inku' ),
		);
	$wp_customize->add_setting( 'inku_site_animations', array( 'default' => 'true', 'sanitize_callback' => 'inku_sanitize_text', 'type' => 'theme_mod' ) );
	$wp_customize->add_control( 'inku_site_animations', array(
        'label'   => esc_html__( 'Enable/Disable Site Animations', 'inku' ),
        'section' => 'inku_site_options_section',
        'settings'   => 'inku_site_animations',
        'type'       => 'select',
        'choices'    => $animations_options,
    ));






	/*
	Typography
	------------------------------ */
	$wp_customize->add_section( 'inku_typography_section', array(
		'title' => esc_html__( 'Typography', 'inku' ),
	) );

	if ( class_exists( 'Kirki' ) ){

		Kirki::add_field( 'inku', array(
		    'type'     => 'select',
		    'settings' => 'inku_typography_font_family',
		    'label'    => esc_html__( 'Font Family', 'inku' ),
		    'section'  => 'inku_typography_section',
		    'default'  => 'Open Sans',
		    'priority' => 20,
		    'choices'  => Kirki_Fonts::get_font_choices(),
		    'output'   => array(
		        array(
		            'element'  => 'body',
		            'property' => 'font-family',
		        ),
		    ),
		) );

		Kirki::add_field( 'inku', array(
		    'type'     => 'select',
		    'settings' => 'inku_typography_font_family_headings',
		    'label'    => esc_html__( 'Headings Font Family', 'inku' ),
		    'section'  => 'inku_typography_section',
		    'default'  => 'Playfair Display',
		    'priority' => 22,
		    'choices'  => Kirki_Fonts::get_font_choices(),
		    'output'   => array(
		        array(
		            'element'  => 'h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a',
		            'property' => 'font-family',
		        ),
		    ),
		) );

		Kirki::add_field( 'inku', array(
		    'type'        => 'multicheck',
		    'settings'    => 'inku_typography_subsets',
		    'label'       => esc_html__( 'Google-Font subsets', 'inku' ),
		    'description' => esc_html__( 'The subsets used from Google\'s API.', 'inku' ),
		    'section'     => 'inku_typography_section',
		    'default'     => '',
		    'priority'    => 23,
		    'choices'     => Kirki_Fonts::get_google_font_subsets(),
		    'output'      => array(
		        array(
		            'element'  => 'body',
		            'property' => 'font-subset',
		        ),
		    ),
		) );

		Kirki::add_field( 'inku', array(
		    'type'      => 'slider',
		    'settings'  => 'inku_typography_font_size',
		    'label'     => esc_html__( 'Font Size', 'inku' ),
		    'section'   => 'inku_typography_section',
		    'default'   => 16,
		    'priority'  => 25,
		    'choices'   => array(
		        'min'   => 7,
		        'max'   => 48,
		        'step'  => 1,
		    ),
		    'output' => array(
		        array(
		            'element'  => 'html',
		            'property' => 'font-size',
		            'units'    => 'px',
		        ),
		    ),
		    'transport' => 'postMessage',
		    'js_vars'   => array(
		        array(
		            'element'  => 'html',
		            'function' => 'css',
		            'property' => 'font-size',
		            'units'    => 'px'
		        ),
		    ),
		) );
	}else{
		$wp_customize->add_setting( 'inku_typography_not_kirki', array( 'default' => '', 'sanitize_callback' => 'inku_sanitize_text', ) );
		$wp_customize->add_control( new inku_Display_Text_Control( $wp_customize, 'inku_typography_not_kirki', array(
			'section' => 'inku_typography_section', // Required, core or custom.
			'label' => sprintf( /* translators: 1: anchor link, 2: close anchor */ esc_html__( 'To change typography make sure you have installed the %1$s Kirki Toolkit %2$s plugin.', 'inku' ), '<a href="' . get_admin_url( null, 'themes.php?page=tgmpa-install-plugins' ) . '">', '</a>' ),
		) ) );
	}//if Kirki exists


}
add_action( 'customize_register', 'inku_customize_register' );




/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function inku_customize_preview_js() {

	wp_register_script( 'inku_customizer_preview', get_template_directory_uri() . '/js/customizer-preview.js', array( 'customize-preview' ), '20151024', true );
	wp_localize_script( 'inku_customizer_preview', 'wp_customizer', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'theme_url' => get_template_directory_uri(),
		'site_name' => get_bloginfo( 'name' )
	));
	wp_enqueue_script( 'inku_customizer_preview' );

}
add_action( 'customize_preview_init', 'inku_customize_preview_js' );


/**
 * Load scripts on the Customizer not the Previewer (iframe)
 */
function inku_customize_js() {

	wp_enqueue_script( 'inku_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-controls' ), '20151024', true );

}
add_action( 'customize_controls_enqueue_scripts', 'inku_customize_js' );










/*
Sanitize Callbacks
*/

/**
 * Sanitize for post's categories
 */
function inku_sanitize_categories( $value ) {
    if ( ! array_key_exists( $value, inku_categories_ar() ) )
        $value = '';
    return $value;
}

/**
 * Sanitize return an non-negative Integer
 */
function inku_sanitize_integer( $value ) {
    return absint( $value );
}

/**
 * Sanitize return pro version text
 */
function inku_pro_version( $input ) {
    return $input;
}

/**
 * Sanitize Any
 */
function inku_sanitize_any( $input ) {
    return $input;
}

/**
 * Sanitize Text
 */
function inku_sanitize_text( $str ) {
	return sanitize_text_field( $str );
}

/**
 * Sanitize URL
 */
function inku_sanitize_url( $url ) {
	return esc_url( $url );
}

/**
 * Sanitize Boolean
 */
function inku_sanitize_bool( $string ) {
	return (bool)$string;
}

/**
 * Sanitize Text with html
 */
function inku_sanitize_text_html( $str ) {
	$args = array(
			    'a' => array(
			        'href' => array(),
			        'title' => array()
			    ),
			    'br' => array(),
			    'em' => array(),
			    'strong' => array(),
			    'span' => array(),
			);
	return wp_kses( $str, $args );
}

/**
 * Sanitize array for multicheck
 * http://stackoverflow.com/a/22007205
 */
function inku_sanitize_multicheck( $values ) {

    $multi_values = ( ! is_array( $values ) ) ? explode( ',', $values ) : $values;
	return ( ! empty( $multi_values ) ) ? array_map( 'sanitize_title', $multi_values ) : array();
}

/**
 * Sanitize GPS Latitude and Longitud
 * http://stackoverflow.com/a/22007205
 */
function inku_sanitize_lat_long( $coords ) {
	if ( preg_match( '/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?),[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $coords ) ) {
	    return $coords;
	} else {
	    return 'error';
	}
}



/**
 * Create the "PRO version" buttons
 */
if ( ! function_exists( 'inku_pro_btns' ) ){
	function inku_pro_btns( $args ){

		$wp_customize = $args['wp_customize'];
		$title = $args['title'];
		$label = $args['label'];
		if ( isset( $args['priority'] ) || array_key_exists( 'priority', $args ) ) {
			$priority = $args['priority'];
		}else{
			$priority = 120;
		}
		if ( isset( $args['panel'] ) || array_key_exists( 'panel', $args ) ) {
			$panel = $args['panel'];
		}else{
			$panel = '';
		}

		$section_id = sanitize_title( $title );

		$wp_customize->add_section( $section_id , array(
			'title'       => $title,
			'priority'    => $priority,
			'panel' => $panel,
		) );
		$wp_customize->add_setting( $section_id, array(
			'sanitize_callback' => 'inku_pro_version'
		) );
		$wp_customize->add_control( new inku_Pro_Version( $wp_customize, $section_id, array(
	        'section' => $section_id,
	        'label' => $label
		   )
		) );
	}
}//end if function_exists

/**
 * Display Text Control
 * Custom Control to display text
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	class inku_Display_Text_Control extends WP_Customize_Control {
		/**
		* Render the control's content.
		*/
		public function render_content() {

	        $wp_kses_args = array(
			    'a' => array(
			        'href' => array(),
			        'title' => array(),
			        'data-section' => array(),
			    ),
			    'br' => array(),
			    'em' => array(),
			    'strong' => array(),
			    'span' => array(),
			);
	        ?>
			<p><?php echo wp_kses( $this->label, $wp_kses_args ); ?></p>
		<?php
		}
	}
}



/*
* AJAX call to retreive an image URI by its ID
*/
add_action( 'wp_ajax_nopriv_inku_get_image_src', 'inku_get_image_src' );
add_action( 'wp_ajax_inku_get_image_src', 'inku_get_image_src' );

function inku_get_image_src() {
	if ( isset( $_POST[ 'image_id' ] ) ) {
        $image_id = sanitize_text_field( wp_unslash( $_GET[ 'image_id' ] ) );
    }
	$image = wp_get_attachment_image_src( absint( $image_id ), 'full' );
	$image = $image[0];
	echo wp_kses_post( $image );
	die();
}
