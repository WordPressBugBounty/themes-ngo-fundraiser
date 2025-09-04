<?php
/**
 * NGO Fundraiser Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package NGO Fundraiser
 */

if ( ! defined( 'NGO_FUNDRAISER_URL' ) ) {
    define( 'NGO_FUNDRAISER_URL', esc_url( 'https://www.themagnifico.net/products/ngo-fundraiser-wordpress-theme', 'ngo-fundraiser') );
}
if ( ! defined( 'NGO_FUNDRAISER_TEXT' ) ) {
    define( 'NGO_FUNDRAISER_TEXT', __( 'NGO Fundraiser Pro','ngo-fundraiser' ));
}
if ( ! defined( 'NGO_FUNDRAISER_BUY_TEXT' ) ) {
    define( 'NGO_FUNDRAISER_BUY_TEXT', __( 'Buy NGO Fundraiser Pro','ngo-fundraiser' ));
}

use WPTRT\Customize\Section\Ngo_Fundraiser_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Ngo_Fundraiser_Button::class );

    $manager->add_section(
        new Ngo_Fundraiser_Button( $manager, 'ngo_fundraiser_pro', [
            'title'       => esc_html( NGO_FUNDRAISER_TEXT,'ngo-fundraiser' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'ngo-fundraiser' ),
            'button_url'  => esc_url( NGO_FUNDRAISER_URL )
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'ngo-fundraiser-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'ngo-fundraiser-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ngo_fundraiser_customize_register($wp_customize){

    // Pro Version
    class Ngo_Fundraiser_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>' . esc_html('For More','ngo-fundraiser') . ' <strong>' . esc_html($this->label) . '</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( NGO_FUNDRAISER_BUY_TEXT) .'<strong></a>';
            echo '</a>';
        }
    }

    // Custom Controls
    function Ngo_Fundraiser_sanitize_custom_control( $input ) {
        return $input;
    }

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    $wp_customize->add_setting('ngo_fundraiser_logo_title_text', array(
        'default' => true,
        'sanitize_callback' => 'ngo_fundraiser_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'ngo_fundraiser_logo_title_text',array(
        'label'          => __( 'Enable Disable Title', 'ngo-fundraiser' ),
        'section'        => 'title_tagline',
        'settings'       => 'ngo_fundraiser_logo_title_text',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('ngo_fundraiser_logo_title_font_size',array(
        'default'   => '',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_number_absint'
    ));
    $wp_customize->add_control('ngo_fundraiser_logo_title_font_size',array(
        'label' => esc_html__('Title Font Size','ngo-fundraiser'),
        'section' => 'title_tagline',
        'type'    => 'number'
    ));

    $wp_customize->add_setting('ngo_fundraiser_theme_description', array(
        'default' => false,
        'sanitize_callback' => 'ngo_fundraiser_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'ngo_fundraiser_theme_description',array(
        'label'          => __( 'Enable Disable Tagline', 'ngo-fundraiser' ),
        'section'        => 'title_tagline',
        'settings'       => 'ngo_fundraiser_theme_description',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('ngo_fundraiser_logo_tagline_font_size',array(
        'default'   => '',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_number_absint'
    ));
    $wp_customize->add_control('ngo_fundraiser_logo_tagline_font_size',array(
        'label' => esc_html__('Tagline Font Size','ngo-fundraiser'),
        'section'   => 'title_tagline',
        'type'      => 'number'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_logo', array(
        'sanitize_callback' => 'Ngo_Fundraiser_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Ngo_Fundraiser_Customize_Pro_Version ( $wp_customize,'pro_version_logo', array(
        'section'     => 'title_tagline',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'ngo-fundraiser' ),
        'description' => esc_url( NGO_FUNDRAISER_URL ),
        'priority'    => 100
    )));

    // Social Link
    $wp_customize->add_section('ngo_fundraiser_social_link',array(
        'title' => esc_html__('Social Links','ngo-fundraiser'),
    ));

    $wp_customize->add_setting('ngo_fundraiser_facebook_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_facebook_icon',array(
        'label' => esc_html__('Facebook Icon','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_social_link',
        'setting' => 'ngo_fundraiser_facebook_icon',
        'type'  => 'text',
        'default' => 'fab fa-facebook-f',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-facebook-f','ngo-fundraiser')
    ));

    $wp_customize->add_setting('ngo_fundraiser_facebook_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('ngo_fundraiser_facebook_url',array(
        'label' => esc_html__('Facebook Link','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_social_link',
        'setting' => 'ngo_fundraiser_facebook_url',
        'type'  => 'url'
    ));


    $wp_customize->add_setting('ngo_fundraiser_twitter_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_twitter_icon',array(
        'label' => esc_html__('Twitter Icon','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_social_link',
        'setting' => 'ngo_fundraiser_twitter_icon',
        'type'  => 'text',
        'default' => 'fab fa-twitter',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-twitter','ngo-fundraiser')
    ));

    $wp_customize->add_setting('ngo_fundraiser_twitter_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('ngo_fundraiser_twitter_url',array(
        'label' => esc_html__('Twitter Link','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_social_link',
        'setting' => 'ngo_fundraiser_twitter_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('ngo_fundraiser_intagram_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_intagram_icon',array(
        'label' => esc_html__('Intagram Icon','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_social_link',
        'setting' => 'ngo_fundraiser_intagram_icon',
        'type'  => 'text',
        'default' => 'fab fa-instagram',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-instagram','ngo-fundraiser')
    ));

    $wp_customize->add_setting('ngo_fundraiser_intagram_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('ngo_fundraiser_intagram_url',array(
        'label' => esc_html__('Intagram Link','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_social_link',
        'setting' => 'ngo_fundraiser_intagram_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('ngo_fundraiser_linkedin_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_linkedin_icon',array(
        'label' => esc_html__('Linkedin Icon','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_social_link',
        'setting' => 'ngo_fundraiser_linkedin_icon',
        'type'  => 'text',
        'default' => 'fab fa-linkedin-in',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-linkedin-in','ngo-fundraiser')
    ));

    $wp_customize->add_setting('ngo_fundraiser_linkedin_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('ngo_fundraiser_linkedin_url',array(
        'label' => esc_html__('Linkedin Link','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_social_link',
        'setting' => 'ngo_fundraiser_linkedin_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('ngo_fundraiser_pintrest_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_pintrest_icon',array(
        'label' => esc_html__('Pinterest Icon','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_social_link',
        'setting' => 'ngo_fundraiser_pintrest_icon',
        'type'  => 'text',
        'default' => 'fab fa-pinterest-p',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-pinterest-p','ngo-fundraiser')
    ));

    $wp_customize->add_setting('ngo_fundraiser_pintrest_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('ngo_fundraiser_pintrest_url',array(
        'label' => esc_html__('Pinterest Link','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_social_link',
        'setting' => 'ngo_fundraiser_pintrest_url',
        'type'  => 'url'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_social_setting', array(
        'sanitize_callback' => 'Ngo_Fundraiser_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Ngo_Fundraiser_Customize_Pro_Version ( $wp_customize,'pro_version_social_setting', array(
        'section'     => 'ngo_fundraiser_social_link',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'ngo-fundraiser' ),
        'description' => esc_url( NGO_FUNDRAISER_URL ),
        'priority'    => 100
    )));

    // Global Color Settings
     $wp_customize->add_section('ngo_fundraiser_global_color_settings',array(
        'title' => esc_html__('Global Settings','ngo-fundraiser'),
        'priority'   => 28,
    ));

     $wp_customize->add_setting( 'ngo_fundraiser_global_color', array(
        'default' => '#FF9F0D',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ngo_fundraiser_global_color', array(
        'description' => __('Change the global color of the theme in one click.', 'ngo-fundraiser'),
        'section' => 'ngo_fundraiser_global_color_settings',
        'settings' => 'ngo_fundraiser_global_color',
    )));

    //Typography option
    $ngo_fundraiser_font_array = array(
        ''                       => 'No Fonts',
        'Abril Fatface'          => 'Abril Fatface',
        'Acme'                   => 'Acme',
        'Anton'                  => 'Anton',
        'Architects Daughter'    => 'Architects Daughter',
        'Arimo'                  => 'Arimo',
        'Arsenal'                => 'Arsenal',
        'Arvo'                   => 'Arvo',
        'Alegreya'               => 'Alegreya',
        'Alfa Slab One'          => 'Alfa Slab One',
        'Averia Serif Libre'     => 'Averia Serif Libre',
        'Bangers'                => 'Bangers',
        'Boogaloo'               => 'Boogaloo',
        'Bad Script'             => 'Bad Script',
        'Bitter'                 => 'Bitter',
        'Bree Serif'             => 'Bree Serif',
        'BenchNine'              => 'BenchNine',
        'Cabin'                  => 'Cabin',
        'Cardo'                  => 'Cardo',
        'Courgette'              => 'Courgette',
        'Cherry Swash'           => 'Cherry Swash',
        'Cormorant Garamond'     => 'Cormorant Garamond',
        'Crimson Text'           => 'Crimson Text',
        'Cuprum'                 => 'Cuprum',
        'Cookie'                 => 'Cookie',
        'Chewy'                  => 'Chewy',
        'Days One'               => 'Days One',
        'Dosis'                  => 'Dosis',
        'Droid Sans'             => 'Droid Sans',
        'Economica'              => 'Economica',
        'Fredoka One'            => 'Fredoka One',
        'Fjalla One'             => 'Fjalla One',
        'Francois One'           => 'Francois One',
        'Frank Ruhl Libre'       => 'Frank Ruhl Libre',
        'Gloria Hallelujah'      => 'Gloria Hallelujah',
        'Great Vibes'            => 'Great Vibes',
        'Handlee'                => 'Handlee',
        'Hammersmith One'        => 'Hammersmith One',
        'Inconsolata'            => 'Inconsolata',
        'Indie Flower'           => 'Indie Flower',
        'IM Fell English SC'     => 'IM Fell English SC',
        'Julius Sans One'        => 'Julius Sans One',
        'Josefin Slab'           => 'Josefin Slab',
        'Josefin Sans'           => 'Josefin Sans',
        'Kanit'                  => 'Kanit',
        'Lobster'                => 'Lobster',
        'Lato'                   => 'Lato',
        'Lora'                   => 'Lora',
        'Libre Baskerville'      => 'Libre Baskerville',
        'Lobster Two'            => 'Lobster Two',
        'Merriweather'           => 'Merriweather',
        'Monda'                  => 'Monda',
        'Montserrat'             => 'Montserrat',
        'Muli'                   => 'Muli',
        'Marck Script'           => 'Marck Script',
        'Noto Serif'             => 'Noto Serif',
        'Open Sans'              => 'Open Sans',
        'Overpass'               => 'Overpass',
        'Overpass Mono'          => 'Overpass Mono',
        'Oxygen'                 => 'Oxygen',
        'Orbitron'               => 'Orbitron',
        'Patua One'              => 'Patua One',
        'Pacifico'               => 'Pacifico',
        'Padauk'                 => 'Padauk',
        'Playball'               => 'Playball',
        'Playfair Display'       => 'Playfair Display',
        'PT Sans'                => 'PT Sans',
        'Philosopher'            => 'Philosopher',
        'Permanent Marker'       => 'Permanent Marker',
        'Poiret One'             => 'Poiret One',
        'Quicksand'              => 'Quicksand',
        'Quattrocento Sans'      => 'Quattrocento Sans',
        'Raleway'                => 'Raleway',
        'Rubik'                  => 'Rubik',
        'Roboto'                 => 'Roboto',
        'Rokkitt'                => 'Rokkitt',
        'Russo One'              => 'Russo One',
        'Righteous'              => 'Righteous',
        'Slabo'                  => 'Slabo',
        'Source Sans Pro'        => 'Source Sans Pro',
        'Shadows Into Light Two' => 'Shadows Into Light Two',
        'Shadows Into Light'     => 'Shadows Into Light',
        'Sacramento'             => 'Sacramento',
        'Shrikhand'              => 'Shrikhand',
        'Tangerine'              => 'Tangerine',
        'Ubuntu'                 => 'Ubuntu',
        'VT323'                  => 'VT323',
        'Varela Round'           => 'Varela Round',
        'Vampiro One'            => 'Vampiro One',
        'Vollkorn'               => 'Vollkorn',
        'Volkhov'                => 'Volkhov',
        'Yanone Kaffeesatz'      => 'Yanone Kaffeesatz'
    );

    // Heading Typography
    $wp_customize->add_setting( 'ngo_fundraiser_heading_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ngo_fundraiser_heading_color', array(
        'label' => __('Heading Color', 'ngo-fundraiser'),
        'section' => 'ngo_fundraiser_global_color_settings',
        'settings' => 'ngo_fundraiser_heading_color',
    )));

    $wp_customize->add_setting('ngo_fundraiser_heading_font_family', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices',
    ));
    $wp_customize->add_control( 'ngo_fundraiser_heading_font_family', array(
        'section' => 'ngo_fundraiser_global_color_settings',
        'label'   => __('Heading Fonts', 'ngo-fundraiser'),
        'type'    => 'select',
        'choices' => $ngo_fundraiser_font_array,
    ));

    $wp_customize->add_setting('ngo_fundraiser_heading_font_size',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_heading_font_size',array(
        'label' => esc_html__('Heading Font Size','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_global_color_settings',
        'setting' => 'ngo_fundraiser_heading_font_size',
        'type'  => 'text'
    ));

    // Paragraph Typography
    $wp_customize->add_setting( 'ngo_fundraiser_paragraph_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ngo_fundraiser_paragraph_color', array(
        'label' => __('Paragraph Color', 'ngo-fundraiser'),
        'section' => 'ngo_fundraiser_global_color_settings',
        'settings' => 'ngo_fundraiser_paragraph_color',
    )));

    $wp_customize->add_setting('ngo_fundraiser_paragraph_font_family', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices',
    ));
    $wp_customize->add_control( 'ngo_fundraiser_paragraph_font_family', array(
        'section' => 'ngo_fundraiser_global_color_settings',
        'label'   => __('Paragraph Fonts', 'ngo-fundraiser'),
        'type'    => 'select',
        'choices' => $ngo_fundraiser_font_array,
    ));

    $wp_customize->add_setting('ngo_fundraiser_paragraph_font_size',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_paragraph_font_size',array(
        'label' => esc_html__('Paragraph Font Size','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_global_color_settings',
        'setting' => 'ngo_fundraiser_paragraph_font_size',
        'type'  => 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_global_color_settings', array(
        'sanitize_callback' => 'Ngo_Fundraiser_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Ngo_Fundraiser_Customize_Pro_Version ( $wp_customize,'pro_version_global_color_settings', array(
        'section'     => 'ngo_fundraiser_global_color_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'ngo-fundraiser' ),
        'description' => esc_url( NGO_FUNDRAISER_URL ),
        'priority'    => 100
    )));

    // General Settings
     $wp_customize->add_section('ngo_fundraiser_general_settings',array(
        'title' => esc_html__('General Settings','ngo-fundraiser'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('ngo_fundraiser_width_option',array(
        'default' => 'Full Width',
        'transport' => 'refresh',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices'
    ));
    $wp_customize->add_control('ngo_fundraiser_width_option',array(
        'type' => 'select',
        'section' => 'ngo_fundraiser_general_settings',
        'choices' => array(
            'Full Width' => __('Full Width','ngo-fundraiser'),
            'Wide Width' => __('Wide Width','ngo-fundraiser'),
            'Boxed Width' => __('Boxed Width','ngo-fundraiser')
        ),
    ) );

    $wp_customize->add_setting('ngo_fundraiser_preloader_hide', array(
        'default' => 0,
        'sanitize_callback' => 'ngo_fundraiser_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'ngo_fundraiser_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'ngo-fundraiser' ),
        'section'        => 'ngo_fundraiser_general_settings',
        'settings'       => 'ngo_fundraiser_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting( 'ngo_fundraiser_preloader_bg_color', array(
        'default' => '#FF9F0D',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ngo_fundraiser_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_general_settings',
        'settings' => 'ngo_fundraiser_preloader_bg_color'
    )));

    $wp_customize->add_setting( 'ngo_fundraiser_preloader_dot_1_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ngo_fundraiser_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_general_settings',
        'settings' => 'ngo_fundraiser_preloader_dot_1_color'
    )));

    $wp_customize->add_setting( 'ngo_fundraiser_preloader_dot_2_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ngo_fundraiser_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_general_settings',
        'settings' => 'ngo_fundraiser_preloader_dot_2_color'
    )));

    $wp_customize->add_setting('ngo_fundraiser_scroll_hide', array(
        'default' => false,
        'sanitize_callback' => 'ngo_fundraiser_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'ngo_fundraiser_scroll_hide',array(
        'label'          => __( 'Show Theme Scroll To Top', 'ngo-fundraiser' ),
        'section'        => 'ngo_fundraiser_general_settings',
        'settings'       => 'ngo_fundraiser_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('ngo_fundraiser_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices'
    ));
    $wp_customize->add_control('ngo_fundraiser_scroll_top_position',array(
        'type' => 'radio',
        'label' => __( 'Scroll To Top Position', 'ngo-fundraiser' ),
        'section' => 'ngo_fundraiser_general_settings',
        'choices' => array(
            'Right' => __('Right','ngo-fundraiser'),
            'Left' => __('Left','ngo-fundraiser'),
            'Center' => __('Center','ngo-fundraiser')
        ),
    ) );

    $wp_customize->add_setting( 'ngo_fundraiser_scroll_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ngo_fundraiser_scroll_bg_color', array(
        'label' => esc_html__('Scroll Top Background Color','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_general_settings',
        'settings' => 'ngo_fundraiser_scroll_bg_color'
    )));

    $wp_customize->add_setting( 'ngo_fundraiser_scroll_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ngo_fundraiser_scroll_color', array(
        'label' => esc_html__('Scroll Top Color','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_general_settings',
        'settings' => 'ngo_fundraiser_scroll_color'
    )));

    $wp_customize->add_setting('ngo_fundraiser_scroll_font_size',array(
        'default'   => '16',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_scroll_font_size',array(
        'label' => __('Scroll Top Font Size','ngo-fundraiser'),
        'description' => __('Put in px','ngo-fundraiser'),
        'section'   => 'ngo_fundraiser_general_settings',
        'type'      => 'number'
    ));

    $wp_customize->add_setting('ngo_fundraiser_scroll_border_radius',array(
        'default'   => '0',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_scroll_border_radius',array(
        'label' => __('Scroll Top Border Radius','ngo-fundraiser'),
        'description' => __('Put in %','ngo-fundraiser'),
        'section'   => 'ngo_fundraiser_general_settings',
        'type'      => 'number'
    ));

    // Product Columns
    $wp_customize->add_setting( 'ngo_fundraiser_products_per_row' , array(
       'default'           => '3',
       'transport'         => 'refresh',
       'sanitize_callback' => 'ngo_fundraiser_sanitize_select',
    ) );

    $wp_customize->add_control('ngo_fundraiser_products_per_row', array(
       'label' => __( 'Product per row', 'ngo-fundraiser' ),
       'section'  => 'ngo_fundraiser_general_settings',
       'type'     => 'select',
       'choices'  => array(
           '2' => '2',
           '3' => '3',
           '4' => '4',
       ),
    ) );

    $wp_customize->add_setting('ngo_fundraiser_product_per_page',array(
        'default'   => '9',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_product_per_page',array(
        'label' => __('Product per page','ngo-fundraiser'),
        'section'   => 'ngo_fundraiser_general_settings',
        'type'      => 'number'
    ));

    //Woocommerce shop page Sidebar
    $wp_customize->add_setting('ngo_fundraiser_woocommerce_shop_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'ngo_fundraiser_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'ngo_fundraiser_woocommerce_shop_page_sidebar',array(
        'label'          => __( 'Hide Shop Page Sidebar', 'ngo-fundraiser' ),
        'section'        => 'ngo_fundraiser_general_settings',
        'settings'       => 'ngo_fundraiser_woocommerce_shop_page_sidebar',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('ngo_fundraiser_shop_page_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices'
    ));
    $wp_customize->add_control('ngo_fundraiser_shop_page_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Shop Page Sidebar','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','ngo-fundraiser'),
            'Right Sidebar' => __('Right Sidebar','ngo-fundraiser'),
        ),
    ) );

    //Woocommerce Single Product page Sidebar
    $wp_customize->add_setting('ngo_fundraiser_woocommerce_single_product_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'ngo_fundraiser_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'ngo_fundraiser_woocommerce_single_product_page_sidebar',array(
        'label'          => __( 'Hide Single Product Page Sidebar', 'ngo-fundraiser' ),
        'section'        => 'ngo_fundraiser_general_settings',
        'settings'       => 'ngo_fundraiser_woocommerce_single_product_page_sidebar',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('ngo_fundraiser_single_product_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices'
    ));
    $wp_customize->add_control('ngo_fundraiser_single_product_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Single Product Page Sidebar','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','ngo-fundraiser'),
            'Right Sidebar' => __('Right Sidebar','ngo-fundraiser'),
        ),
    ) );

    // Pro Version
    $wp_customize->add_setting( 'pro_version_general_setting', array(
        'sanitize_callback' => 'Ngo_Fundraiser_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Ngo_Fundraiser_Customize_Pro_Version ( $wp_customize,'pro_version_general_setting', array(
        'section'     => 'ngo_fundraiser_general_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'ngo-fundraiser' ),
        'description' => esc_url( NGO_FUNDRAISER_URL ),
        'priority'    => 100
    )));

    // Header
    $wp_customize->add_section('ngo_fundraiser_header_settings',array(
        'title' => esc_html__('Header Settings','ngo-fundraiser'),
    ));

    $wp_customize->add_setting('ngo_fundraiser_search_setting', array(
        'default' => false,
        'sanitize_callback' => 'ngo_fundraiser_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'ngo_fundraiser_search_setting',array(
        'label'          => __( 'Enable Header Search', 'ngo-fundraiser' ),
        'section'        => 'ngo_fundraiser_header_settings',
        'settings'       => 'ngo_fundraiser_search_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('ngo_fundraiser_header_button_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_header_button_text',array(
        'label' => __('Header Button Text','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_header_settings',
        'setting' => 'ngo_fundraiser_header_button_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('ngo_fundraiser_header_button_url',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_header_button_url',array(
        'label' => __('Header Button Url','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_header_settings',
        'setting' => 'ngo_fundraiser_header_button_url',
        'type'  => 'url'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_header_setting', array(
        'sanitize_callback' => 'Ngo_Fundraiser_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Ngo_Fundraiser_Customize_Pro_Version ( $wp_customize,'pro_version_header_setting', array(
        'section'     => 'ngo_fundraiser_header_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'ngo-fundraiser' ),
        'description' => esc_url( NGO_FUNDRAISER_URL ),
        'priority'    => 100
    )));

    //Menu Settings
    $wp_customize->add_section('ngo_fundraiser_menu_settings',array(
        'title' => esc_html__('Menus Settings','ngo-fundraiser'),
    ));

    $wp_customize->add_setting('ngo_fundraiser_menu_font_size',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_menu_font_size',array(
        'label' => esc_html__('Menu Font Size','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_menu_settings',
        'type'  => 'number'
    ));

    $wp_customize->add_setting('ngo_fundraiser_nav_menu_text_transform',array(
        'default'=> 'Capitalize',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices'
    ));
    $wp_customize->add_control('ngo_fundraiser_nav_menu_text_transform',array(
        'type' => 'radio',
        'label' => esc_html__('Menu Text Transform','ngo-fundraiser'),
        'choices' => array(
            'Uppercase' => __('Uppercase','ngo-fundraiser'),
            'Capitalize' => __('Capitalize','ngo-fundraiser'),
            'Lowercase' => __('Lowercase','ngo-fundraiser'),
        ),
        'section'=> 'ngo_fundraiser_menu_settings',
    ));

    $wp_customize->add_setting('ngo_fundraiser_nav_menu_font_weight',array(
        'default'=> '700',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_nav_menu_font_weight',array(
        'type' => 'number',
        'label' => esc_html__('Menu Font Weight','ngo-fundraiser'),
        'input_attrs' => array(
            'step'             => 100,
            'min'              => 100,
            'max'              => 1000,
        ),
        'section'=> 'ngo_fundraiser_menu_settings',
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_menu_settings', array(
        'sanitize_callback' => 'Ngo_Fundraiser_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Ngo_Fundraiser_Customize_Pro_Version ( $wp_customize,'pro_version_menu_settings', array(
        'section'     => 'ngo_fundraiser_menu_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'ngo-fundraiser' ),
        'description' => esc_url( NGO_FUNDRAISER_URL ),
        'priority'    => 100
    )));

    //Slider
    $wp_customize->add_section('ngo_fundraiser_top_slider',array(
        'title' => esc_html__('Slider Settings','ngo-fundraiser'),
    ));

    $wp_customize->add_setting('ngo_fundraiser_slider_short_heading',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_slider_short_heading',array(
        'label' => __('Short Heading','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_top_slider',
        'setting' => 'ngo_fundraiser_slider_short_heading',
        'type'  => 'text'
    ));

    for ( $ngo_fundraiser_count = 1; $ngo_fundraiser_count <= 3; $ngo_fundraiser_count++ ) {

        $wp_customize->add_setting( 'ngo_fundraiser_top_slider_page' . $ngo_fundraiser_count, array(
            'default'           => '',
            'sanitize_callback' => 'ngo_fundraiser_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'ngo_fundraiser_top_slider_page' . $ngo_fundraiser_count, array(
            'label'    => __( 'Select Slide Page', 'ngo-fundraiser' ),
            'description' => __('Slider image size (1400 x 550)','ngo-fundraiser'),
            'section'  => 'ngo_fundraiser_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    $wp_customize->add_setting('ngo_fundraiser_slider_mail_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_slider_mail_text',array(
        'label' => __('Email Address','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_top_slider',
        'setting' => 'ngo_fundraiser_slider_mail_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('ngo_fundraiser_slider_content_layout',array(
        'default'=> 'Left',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices'
    ));
    $wp_customize->add_control('ngo_fundraiser_slider_content_layout',array(
        'type' => 'radio',
        'label' => esc_html__('Slider Content Layout','ngo-fundraiser'),
        'choices' => array(
            'Left' => __('Left','ngo-fundraiser'),
            'Center' => __('Center','ngo-fundraiser'),
            'Right' => __('Right','ngo-fundraiser'),
        ),
        'section'=> 'ngo_fundraiser_top_slider',
    ));

    $wp_customize->add_setting('ngo_fundraiser_slider_excerpt_length',array(
        'sanitize_callback' => 'ngo_fundraiser_sanitize_number_range',
        'default'  => 20,
    ));
    $wp_customize->add_control('ngo_fundraiser_slider_excerpt_length',array(
        'label'       => esc_html__('Slider Excerpt Length', 'ngo-fundraiser'),
        'section'     => 'ngo_fundraiser_top_slider',
        'type'        => 'range',
        'input_attrs' => array(
            'step' => 1,
            'min'  => 1,
            'max'  => 50,
        ),
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_slider_setting', array(
        'sanitize_callback' => 'Ngo_Fundraiser_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Ngo_Fundraiser_Customize_Pro_Version ( $wp_customize,'pro_version_slider_setting', array(
        'section'     => 'ngo_fundraiser_top_slider',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'ngo-fundraiser' ),
        'description' => esc_url( NGO_FUNDRAISER_URL ),
        'priority'    => 100
    )));

    // Popular Causes
    $wp_customize->add_section('ngo_fundraiser_popular_causes_section',array(
        'title' => esc_html__('Popular Causes Option','ngo-fundraiser'),
    ));

    $wp_customize->add_setting('ngo_fundraiser_about_us_heading',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_about_us_heading',array(
        'label' => esc_html__('Popular Causes Heading','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_popular_causes_section',
        'setting' => 'ngo_fundraiser_about_us_heading',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('ngo_fundraiser_about_us_content',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ngo_fundraiser_about_us_content',array(
        'label' => esc_html__('Popular Causes Content','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_popular_causes_section',
        'setting' => 'ngo_fundraiser_about_us_content',
        'type'  => 'text'
    ));

    $categories = get_categories();
    $cat_post = array();
    $cat_post[]= 'select';
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_post[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('ngo_fundraiser_popular_causes_category',array(
        'default'   => 'services',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_select',
    ));
    $wp_customize->add_control('ngo_fundraiser_popular_causes_category',array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select Category to display Popular Causes','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_popular_causes_section',
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_popular_causes_setting', array(
        'sanitize_callback' => 'Ngo_Fundraiser_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Ngo_Fundraiser_Customize_Pro_Version ( $wp_customize,'pro_version_popular_causes_setting', array(
        'section'     => 'ngo_fundraiser_popular_causes_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'ngo-fundraiser' ),
        'description' => esc_url( NGO_FUNDRAISER_URL ),
        'priority'    => 100
    )));

    // Post Settings
     $wp_customize->add_section('ngo_fundraiser_post_settings',array(
        'title' => esc_html__('Post Settings','ngo-fundraiser'),
        'priority'   =>40,
    ));

    $wp_customize->add_setting('ngo_fundraiser_post_page_title',array(
        'sanitize_callback' => 'ngo_fundraiser_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('ngo_fundraiser_post_page_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Title', 'ngo-fundraiser'),
        'section'     => 'ngo_fundraiser_post_settings',
        'description' => esc_html__('Check this box to enable title on post page.', 'ngo-fundraiser'),
    ));

    $wp_customize->add_setting('ngo_fundraiser_post_page_content',array(
        'sanitize_callback' => 'ngo_fundraiser_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('ngo_fundraiser_post_page_content',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Content', 'ngo-fundraiser'),
        'section'     => 'ngo_fundraiser_post_settings',
        'description' => esc_html__('Check this box to enable content on post page.', 'ngo-fundraiser'),
    ));

    $wp_customize->add_setting('ngo_fundraiser_post_page_excerpt_length',array(
        'sanitize_callback' => 'ngo_fundraiser_sanitize_number_range',
        'default'           => 30,
    ));
    $wp_customize->add_control('ngo_fundraiser_post_page_excerpt_length',array(
        'label'       => esc_html__('Post Page Excerpt Length', 'ngo-fundraiser'),
        'section'     => 'ngo_fundraiser_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ));

    $wp_customize->add_setting('ngo_fundraiser_post_page_excerpt_suffix',array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '[...]',
    ));
    $wp_customize->add_control('ngo_fundraiser_post_page_excerpt_suffix',array(
        'type'        => 'text',
        'label'       => esc_html__('Post Page Excerpt Suffix', 'ngo-fundraiser'),
        'section'     => 'ngo_fundraiser_post_settings',
        'description' => esc_html__('For Ex. [...], etc', 'ngo-fundraiser'),
    ));

    $wp_customize->add_setting( 'ngo_fundraiser_blog_post_columns', array(
        'default'  => 'Two',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices'
    ));
    $wp_customize->add_control( 'ngo_fundraiser_blog_post_columns', array(
        'section' => 'ngo_fundraiser_post_settings',
        'type' => 'select',
        'label' => __( 'No. of Posts per row', 'ngo-fundraiser' ),
        'choices' => array(
            'One'  => __( 'One', 'ngo-fundraiser' ),
            'Two' => __( 'Two', 'ngo-fundraiser' ),
            'Three' => __( 'Three', 'ngo-fundraiser' ),
        )
    ));

    $wp_customize->add_setting('ngo_fundraiser_post_page_pagination',array(
        'sanitize_callback' => 'ngo_fundraiser_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('ngo_fundraiser_post_page_pagination',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Pagination', 'ngo-fundraiser'),
        'section'     => 'ngo_fundraiser_post_settings',
        'description' => esc_html__('Check this box to enable pagination on post page.', 'ngo-fundraiser'),
    ));

    $wp_customize->add_setting( 'ngo_fundraiser_blog_pagination_type', array(
        'default'           => 'blog-nav-numbers',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices'
    ));
    $wp_customize->add_control( 'ngo_fundraiser_blog_pagination_type', array(
        'section' => 'ngo_fundraiser_post_settings',
        'type' => 'select',
        'label' => __( 'Post Pagination Type', 'ngo-fundraiser' ),
        'choices' => array(
            'blog-nav-numbers'  => __( 'Numeric', 'ngo-fundraiser' ),
            'next-prev' => __( 'Older/Newer Posts', 'ngo-fundraiser' ),
        )
    ));

    $wp_customize->add_setting( 'ngo_fundraiser_blog_sidebar_position', array(
        'default'           => 'Right Side',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices'
    ));
    $wp_customize->add_control( 'ngo_fundraiser_blog_sidebar_position', array(
        'section' => 'ngo_fundraiser_post_settings',
        'type' => 'select',
        'label' => __( 'Post Page Sidebar Position', 'ngo-fundraiser' ),
        'choices' => array(
            'Right Side' => __( 'Right Side', 'ngo-fundraiser' ),
            'Left Side' => __( 'Left Side', 'ngo-fundraiser' ),
        )
    ));

    // Single Post Page Settings
    $wp_customize->add_setting( 'ngo_fundraiser_single_post_page_image_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'ngo_fundraiser_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'ngo_fundraiser_single_post_page_image_border_radius', array(
        'label'       => esc_html__( 'Single Post Page Image Border Radius','ngo-fundraiser' ),
        'section'     => 'ngo_fundraiser_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting( 'ngo_fundraiser_single_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'ngo_fundraiser_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'ngo_fundraiser_single_post_page_image_box_shadow', array(
        'label'       => esc_html__( 'Single Post Page Image Box Shadow','ngo-fundraiser' ),
        'section'     => 'ngo_fundraiser_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting('ngo_fundraiser_single_post_page_content',array(
        'sanitize_callback' => 'ngo_fundraiser_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('ngo_fundraiser_single_post_page_content',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Page Content', 'ngo-fundraiser'),
        'section'     => 'ngo_fundraiser_post_settings',
        'description' => esc_html__('Check this box to enable content on single post page.', 'ngo-fundraiser'),
    ));

    $wp_customize->add_setting('ngo_fundraiser_single_post_page_tag',array(
        'sanitize_callback' => 'ngo_fundraiser_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('ngo_fundraiser_single_post_page_tag',array(
        'type'  => 'checkbox',
        'label' => esc_html__('Enable Single Post Page Tag', 'ngo-fundraiser'),
        'section' => 'ngo_fundraiser_post_settings',
        'description' => esc_html__('Check this box to enable content on single post page.', 'ngo-fundraiser'),
    ));

    $wp_customize->add_setting( 'ngo_fundraiser_single_post_sidebar_position', array(
        'default'           => 'Right Side',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices'
    ));
    $wp_customize->add_control( 'ngo_fundraiser_single_post_sidebar_position', array(
        'section' => 'ngo_fundraiser_post_settings',
        'type' => 'select',
        'label' => __( 'Single Post Sidebar Position', 'ngo-fundraiser' ),
        'choices' => array(
            'Right Side' => __( 'Right Side', 'ngo-fundraiser' ),
            'Left Side' => __( 'Left Side', 'ngo-fundraiser' ),
        )
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_post_settings', array(
        'sanitize_callback' => 'Ngo_Fundraiser_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Ngo_Fundraiser_Customize_Pro_Version ( $wp_customize,'pro_version_post_settings', array(
        'section'     => 'ngo_fundraiser_post_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'ngo-fundraiser' ),
        'description' => esc_url( NGO_FUNDRAISER_URL ),
        'priority'    => 100
    )));

    // Page Settings
    $wp_customize->add_section('ngo_fundraiser_page_settings',array(
        'title' => esc_html__('Page Settings','ngo-fundraiser'),
        'priority' => 40,
    ));

    $wp_customize->add_setting( 'ngo_fundraiser_single_page_sidebar_layout', array(
        'default'           => 'No Sidebar',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices'
    ));
    $wp_customize->add_control( 'ngo_fundraiser_single_page_sidebar_layout', array(
        'section' => 'ngo_fundraiser_page_settings',
        'type' => 'select',
        'label' => __( 'Single Page Sidebar Position', 'ngo-fundraiser' ),
        'choices' => array(
            'No Sidebar' => __( 'No Sidebar', 'ngo-fundraiser' ),
            'Right Side' => __( 'Right Side', 'ngo-fundraiser' ),
            'Left Side' => __( 'Left Side', 'ngo-fundraiser' ),
        )
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_page_settings', array(
        'sanitize_callback' => 'Ngo_Fundraiser_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Ngo_Fundraiser_Customize_Pro_Version ( $wp_customize,'pro_version_page_settings', array(
        'section'     => 'ngo_fundraiser_page_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'ngo-fundraiser' ),
        'description' => esc_url( NGO_FUNDRAISER_URL ),
        'priority'    => 100
    )));
    
    // Footer
    $wp_customize->add_section('ngo_fundraiser_site_footer_section', array(
        'title' => esc_html__('Footer', 'ngo-fundraiser'),
    ));

    $wp_customize->add_setting('ngo_fundraiser_footer_bg_image',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'ngo_fundraiser_footer_bg_image',array(
        'label' => __('Footer Background Image','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_site_footer_section',
        'priority' => 1,
    )));

    $wp_customize->add_setting('ngo_fundraiser_footer_bg_image_position',array(
        'default'=> 'scroll',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices'
    ));
    $wp_customize->add_control('ngo_fundraiser_footer_bg_image_position',array(
        'type' => 'select',
        'label' => __('Footer Background Image Position','ngo-fundraiser'),
        'choices' => array(
            'fixed' => __('fixed','ngo-fundraiser'),
            'scroll' => __('scroll','ngo-fundraiser'),
        ),
        'section'=> 'ngo_fundraiser_site_footer_section',
    ));

    $wp_customize->add_setting( 'ngo_fundraiser_footer_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ngo_fundraiser_footer_bg_color', array(
        'label' => __('Footer Background Color', 'ngo-fundraiser'),
        'section' => 'ngo_fundraiser_site_footer_section',
        'settings' => 'ngo_fundraiser_footer_bg_color',
    )));

    $wp_customize->add_setting( 'ngo_fundraiser_footer_content_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ngo_fundraiser_footer_content_color', array(
        'label' => __('Footer Content Color', 'ngo-fundraiser'),
        'section' => 'ngo_fundraiser_site_footer_section',
        'settings' => 'ngo_fundraiser_footer_content_color',
    )));

    $wp_customize->add_setting('ngo_fundraiser_footer_widget_heading_alignment',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices'
    ));
    $wp_customize->add_control('ngo_fundraiser_footer_widget_heading_alignment',array(
        'type' => 'select',
        'label' => __('Footer Widget Heading Alignment','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_site_footer_section',
        'choices' => array(
            'Left' => __('Left','ngo-fundraiser'),
            'Center' => __('Center','ngo-fundraiser'),
            'Right' => __('Right','ngo-fundraiser')
        ),
    ) );

    $wp_customize->add_setting('ngo_fundraiser_footer_widget_content_alignment',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices'
    ));
    $wp_customize->add_control('ngo_fundraiser_footer_widget_content_alignment',array(
        'type' => 'select',
        'label' => __('Footer Widget Content Alignment','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_site_footer_section',
        'choices' => array(
            'Left' => __('Left','ngo-fundraiser'),
            'Center' => __('Center','ngo-fundraiser'),
            'Right' => __('Right','ngo-fundraiser')
        ),
    ) );

    $wp_customize->add_setting('ngo_fundraiser_show_hide_copyright',array(
        'default' => true,
        'sanitize_callback' => 'ngo_fundraiser_sanitize_checkbox'
    ));
    $wp_customize->add_control('ngo_fundraiser_show_hide_copyright',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Copyright','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_site_footer_section',
    ));

    $wp_customize->add_setting('ngo_fundraiser_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('ngo_fundraiser_footer_text_setting', array(
        'label' => __('Replace the footer text', 'ngo-fundraiser'),
        'section' => 'ngo_fundraiser_site_footer_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('ngo_fundraiser_copyright_content_alignment',array(
        'default' => 'Center',
        'transport' => 'refresh',
        'sanitize_callback' => 'ngo_fundraiser_sanitize_choices'
    ));
    $wp_customize->add_control('ngo_fundraiser_copyright_content_alignment',array(
        'type' => 'select',
        'label' => __('Copyright Content Alignment','ngo-fundraiser'),
        'section' => 'ngo_fundraiser_site_footer_section',
        'choices' => array(
            'Left' => __('Left','ngo-fundraiser'),
            'Center' => __('Center','ngo-fundraiser'),
            'Right' => __('Right','ngo-fundraiser')
        ),
    ) );

    $wp_customize->add_setting( 'ngo_fundraiser_copyright_text_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ngo_fundraiser_copyright_text_color', array(
        'label' => __('Copyright Text Color', 'ngo-fundraiser'),
        'section' => 'ngo_fundraiser_site_footer_section',
        'settings' => 'ngo_fundraiser_copyright_text_color',
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_footer_setting', array(
        'sanitize_callback' => 'Ngo_Fundraiser_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Ngo_Fundraiser_Customize_Pro_Version ( $wp_customize,'pro_version_footer_setting', array(
        'section'     => 'ngo_fundraiser_site_footer_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'ngo-fundraiser' ),
        'description' => esc_url( NGO_FUNDRAISER_URL ),
        'priority'    => 100
    )));
}
add_action('customize_register', 'ngo_fundraiser_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ngo_fundraiser_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ngo_fundraiser_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ngo_fundraiser_customize_preview_js(){
    wp_enqueue_script('ngo-fundraiser-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'ngo_fundraiser_customize_preview_js');

/*
** Load dynamic logic for the customizer controls area.
*/
function ngo_fundraiser_panels_js() {
    wp_enqueue_style( 'ngo-fundraiser-customizer-layout-css', get_theme_file_uri( '/assets/css/customizer-layout.css' ) );
    wp_enqueue_script( 'ngo-fundraiser-customize-layout', get_theme_file_uri( '/assets/js/customize-layout.js' ), array(), '1.2', true );
}
add_action( 'customize_controls_enqueue_scripts', 'ngo_fundraiser_panels_js' );