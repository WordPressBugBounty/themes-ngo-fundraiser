<?php
/**
 * NGO Fundraiser functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package NGO Fundraiser
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/Ngo_Fundraiser_Loader.php' );

$Ngo_Fundraiser_Loader = new \WPTRT\Autoload\Ngo_Fundraiser_Loader();

$Ngo_Fundraiser_Loader->ngo_fundraiser_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$Ngo_Fundraiser_Loader->ngo_fundraiser_register();

if ( ! function_exists( 'ngo_fundraiser_setup' ) ) :

	function ngo_fundraiser_setup() {

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		*/
		add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

		load_theme_textdomain( 'ngo-fundraiser', get_template_directory() . '/languages' );
		add_theme_support( 'woocommerce' );
		add_theme_support( "responsive-embeds" );
		add_theme_support( "align-wide" );
		add_theme_support( "wp-block-styles" );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
        add_image_size('ngo-fundraiser-featured-header-image', 2000, 660, true);

        register_nav_menus( array(
            'primary' => esc_html__( 'Primary','ngo-fundraiser' ),
	        'footer'=> esc_html__( 'Footer Menu','ngo-fundraiser' ),
        ) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'ngo_fundraiser_custom_background_args', array(
			'default-color' => 'f7ebe5',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo', array(
			'height'      => 80,
			'width'       => 80,
			'flex-width'  => true,
		) );

		add_editor_style( array( '/editor-style.css' ) );
		add_action('wp_ajax_ngo_fundraiser_dismissable_notice', 'ngo_fundraiser_dismissable_notice');
	}
endif;
add_action( 'after_setup_theme', 'ngo_fundraiser_setup' );


function ngo_fundraiser_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ngo_fundraiser_content_width', 1170 );
}
add_action( 'after_setup_theme', 'ngo_fundraiser_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ngo_fundraiser_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ngo-fundraiser' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'ngo-fundraiser' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'ngo-fundraiser' ),
		'id'            => 'ngo-fundraiser-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'ngo-fundraiser' ),
		'id'            => 'ngo-fundraiser-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'ngo-fundraiser' ),
		'id'            => 'ngo-fundraiser-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'ngo-fundraiser' ),
		'id'            => 'ngo-fundraiser-footer4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'ngo_fundraiser_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ngo_fundraiser_scripts() {

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'mulish',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet"' ),
		array(),
		'1.0'
	);

	wp_enqueue_style(
		'quicksand',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet' ),
		array(),
		'1.0'
	);

	wp_enqueue_style( 'ngo-fundraiser-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

	// load bootstrap css
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css');

    wp_enqueue_style( 'owl.carousel-css', get_template_directory_uri() . '/assets/css/owl.carousel.css');

	wp_enqueue_style( 'ngo-fundraiser-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/custom-option.php' );
	wp_add_inline_style( 'ngo-fundraiser-style',$ngo_fundraiser_theme_css );

	// fontawesome
	wp_enqueue_style( 'fontawesome-style', get_template_directory_uri() .'/assets/css/fontawesome/css/all.css' );

    wp_enqueue_script('ngo-fundraiser-theme-js', get_template_directory_uri() . '/assets/js/theme-script.js', array('jquery'), '', true );

    wp_enqueue_script('owl.carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ngo_fundraiser_scripts' );

/**
 * Enqueue Preloader.
 */
function ngo_fundraiser_preloader() {

  $ngo_fundraiser_theme_color_css = '';
  $ngo_fundraiser_preloader_bg_color = get_theme_mod('ngo_fundraiser_preloader_bg_color');
  $ngo_fundraiser_preloader_dot_1_color = get_theme_mod('ngo_fundraiser_preloader_dot_1_color');
  $ngo_fundraiser_preloader_dot_2_color = get_theme_mod('ngo_fundraiser_preloader_dot_2_color');
  $ngo_fundraiser_scroll_bg_color = get_theme_mod('ngo_fundraiser_scroll_bg_color');
  $ngo_fundraiser_scroll_color = get_theme_mod('ngo_fundraiser_scroll_color');
  $ngo_fundraiser_scroll_font_size = get_theme_mod('ngo_fundraiser_scroll_font_size');
  $ngo_fundraiser_scroll_border_radius = get_theme_mod('ngo_fundraiser_scroll_border_radius');

	if(get_theme_mod('ngo_fundraiser_preloader_bg_color') == '') {
		$ngo_fundraiser_preloader_bg_color = '#FF9F0D';
	}
	if(get_theme_mod('ngo_fundraiser_preloader_dot_1_color') == '') {
		$ngo_fundraiser_preloader_dot_1_color = '#ffffff';
	}
	if(get_theme_mod('ngo_fundraiser_preloader_dot_2_color') == '') {
		$ngo_fundraiser_preloader_dot_2_color = '#000000';
	}
	$ngo_fundraiser_theme_color_css = '
		.loading{
			background-color: '.esc_attr($ngo_fundraiser_preloader_bg_color).';
		}
		@keyframes loading {
		  0%,
		  100% {
		  	transform: translatey(-2.5rem);
		    background-color: '.esc_attr($ngo_fundraiser_preloader_dot_1_color).';
		  }
		  50% {
		  	transform: translatey(2.5rem);
		    background-color: '.esc_attr($ngo_fundraiser_preloader_dot_2_color).';
		  }
		}
		a#button{
			background-color: '.esc_attr($ngo_fundraiser_scroll_bg_color).';
			color: '.esc_attr($ngo_fundraiser_scroll_color).' !important;
			font-size: '.esc_attr($ngo_fundraiser_scroll_font_size).'px;
			border-radius: '.esc_attr($ngo_fundraiser_scroll_border_radius).'%;
		}
	';
    wp_add_inline_style( 'ngo-fundraiser-style',$ngo_fundraiser_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'ngo_fundraiser_preloader' );

function ngo_fundraiser_files_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/inc/template-tags.php';

	/**
	 * Implement the Custom Header feature.
	 */
	require get_template_directory() . '/inc/custom-header.php';

	/**
	 * Functions which enhance the theme by hooking into WordPress.
	 */
	require get_template_directory() . '/inc/template-functions.php';

	/**
	 * Customizer additions.
	 */
	require get_template_directory() . '/inc/customizer.php';

	/**
	 * Meta Feild
	 */
	require get_stylesheet_directory() . '/inc/feature-meta.php';

	/* TGM. */
	require get_parent_theme_file_path( '/inc/tgm.php' );

	if ( ! defined( 'NGO_FUNDRAISER_CONTACT_SUPPORT' ) ) {
		define('NGO_FUNDRAISER_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/ngo-fundraiser/','ngo-fundraiser'));
	}
	if ( ! defined( 'NGO_FUNDRAISER_REVIEW' ) ) {
		define('NGO_FUNDRAISER_REVIEW',__('https://wordpress.org/support/theme/ngo-fundraiser/reviews/','ngo-fundraiser'));
	}
	if ( ! defined( 'NGO_FUNDRAISER_LIVE_DEMO' ) ) {
		define('NGO_FUNDRAISER_LIVE_DEMO',__('https://demo.themagnifico.net/ngo-fundraiser/','ngo-fundraiser'));
	}
	if ( ! defined( 'NGO_FUNDRAISER_GET_PREMIUM_PRO' ) ) {
		define('NGO_FUNDRAISER_GET_PREMIUM_PRO',__('https://www.themagnifico.net/products/ngo-fundraiser-wordpress-theme','ngo-fundraiser'));
	}
	if ( ! defined( 'NGO_FUNDRAISER_PRO_DOC' ) ) {
		define('NGO_FUNDRAISER_PRO_DOC',__('https://demo.themagnifico.net/eard/wathiqa/ngo-fundraiser-pro-doc/','ngo-fundraiser'));
	}
	if ( ! defined( 'NGO_FUNDRAISER_FREE_DOC' ) ) {
		define('NGO_FUNDRAISER_FREE_DOC',__('https://demo.themagnifico.net/eard/wathiqa/ngo-fundraiser-free-doc/','ngo-fundraiser'));
	}

}

add_action( 'after_setup_theme', 'ngo_fundraiser_files_setup' );

/** * Posts pagination. */
if ( ! function_exists( 'ngo_fundraiser_blog_posts_pagination' ) ) {
	function ngo_fundraiser_blog_posts_pagination() {
		$pagination_type = get_theme_mod( 'ngo_fundraiser_blog_pagination_type', 'blog-nav-numbers' );
		if ( $pagination_type == 'blog-nav-numbers' ) {
			the_posts_pagination();
		} else {
			the_posts_navigation();
		}
	}
}

function ngo_fundraiser_sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/*dropdown page sanitization*/
function ngo_fundraiser_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function ngo_fundraiser_sanitize_checkbox( $input ) {
  // Boolean check
  return ( ( isset( $input ) && true == $input ) ? true : false );
}

function ngo_fundraiser_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

/*radio button sanitization*/
function ngo_fundraiser_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function ngo_fundraiser_sanitize_number_range( $number, $setting ) {
	
	// Ensure input is an absolute integer.
	$number = absint( $number );
	
	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;
	
	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
	
	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
	
	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
	
	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'ngo_fundraiser_loop_columns');
if (!function_exists('ngo_fundraiser_loop_columns')) {
	function ngo_fundraiser_loop_columns() {
		$ngo_fundraiser_columns = get_theme_mod( 'ngo_fundraiser_products_per_row', 3 );
		return $ngo_fundraiser_columns; // 3 products per row
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'ngo_fundraiser_shop_per_page', 9 );
function ngo_fundraiser_shop_per_page( $cols ) {
  	$cols = get_theme_mod( 'ngo_fundraiser_product_per_page', 9 );
	return $cols;
}

function ngo_fundraiser_remove_customize_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'pro_version_footer' );
    $wp_customize->remove_control( 'pro_version_footer' );

}
add_action( 'customize_register', 'ngo_fundraiser_remove_customize_register', 11 );

/**
 * Get CSS
 */

 function ngo_fundraiser_getpage_css($hook) {
	wp_register_script( 'admin-notice-script', get_template_directory_uri() . '/inc/admin/js/admin-notice-script.js', array( 'jquery' ) );
    wp_localize_script('admin-notice-script','ngo_fundraiser_',
		array('admin_ajax'	=>	admin_url('admin-ajax.php'),'wpnonce'  =>	wp_create_nonce('ngo_fundraiser_dismissed_notice_nonce')
		)
	);
	wp_enqueue_script('admin-notice-script');

    wp_localize_script( 'admin-notice-script', 'ngo_fundraiser_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
	if ( 'appearance_page_ngo-fundraiser-info' != $hook ) {
		return;
	}
}
add_action( 'admin_enqueue_scripts', 'ngo_fundraiser_getpage_css' );

//Admin Notice For Getstart
function ngo_fundraiser_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function ngo_fundraiser_deprecated_hook_admin_notice() {

     // Check if the notice has been dismissed by the user
    $dismissed = get_user_meta(get_current_user_id(), 'ngo_fundraiser_dismissable_notice', true);

    // Exclude the notice from being shown on the "Theme Importer" page
    $current_screen = get_current_screen();
    if ($current_screen && $current_screen->id === 'appearance_page_theme-importer') {
        return; // Don't show the notice on this page
    }

    if (!$dismissed) {  
    	?>
        <div class="updated notice notice-success is-dismissible notice-get-started-class" data-notice="get_started" style="background: #f7f9f9; padding: 20px 10px; display: flex;">
	    	<div class="tm-admin-image">
	    		<img style="width: 100%;max-width: 320px;line-height: 40px;display: inline-block;vertical-align: top;border: 2px solid #ddd;border-radius: 4px;" src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
	    	</div>
	    	<div class="tm-admin-content" style="padding-left: 30px; align-self: center">
	    		<h2 style="font-weight: 600;line-height: 1.3; margin: 0px;"><?php esc_html_e('Thank You For Choosing ', 'ngo-fundraiser'); ?><?php echo wp_get_theme(); ?><h2>
	    		<p style="color: #3c434a; font-weight: 400; margin-bottom: 30px;"><?php _e('Get Started With Theme By Clicking On Getting Started.', 'ngo-fundraiser'); ?><p>
	    		<a class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( admin_url( 'admin.php?page=theme-importer' )); ?>"><?php esc_html_e( 'Start Demo Import', 'ngo-fundraiser' ) ?></a>
	        	<a class="admin-notice-btn button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=ngo-fundraiser-info.php' )); ?>"><?php esc_html_e( 'Get started', 'ngo-fundraiser' ) ?></a>
	        	<a class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( NGO_FUNDRAISER_FREE_DOC ); ?>"><?php esc_html_e( 'Documentation', 'ngo-fundraiser' ) ?></a>
	        	<span style="padding-top: 15px; display: inline-block; padding-left: 8px;">
	        	<span class="dashicons dashicons-admin-links"></span>
	        	<a class="admin-notice-btn"	 target="_blank" href="<?php echo esc_url( NGO_FUNDRAISER_LIVE_DEMO ); ?>"><?php esc_html_e( 'View Demo', 'ngo-fundraiser' ) ?></a>
	        	</span>
	    	</div>
        </div>
    <?php }
}

add_action( 'admin_notices', 'ngo_fundraiser_deprecated_hook_admin_notice' );

function ngo_fundraiser_switch_theme() {
    delete_user_meta(get_current_user_id(), 'ngo_fundraiser_dismissable_notice');
}
add_action('after_switch_theme', 'ngo_fundraiser_switch_theme');
function ngo_fundraiser_dismissable_notice() {
    update_user_meta(get_current_user_id(), 'ngo_fundraiser_dismissable_notice', true);
    die();
}

// Demo Content Code

// Ensure WordPress is loaded
if (!defined('ABSPATH')) {
    exit;
}

// Add admin menu page to trigger theme import
add_action('admin_menu', 'demo_importer_admin_page');

function demo_importer_admin_page() {
    add_theme_page(
        'Demo Theme Importer',     // Page title
        'Theme Importer',          // Menu title
        'manage_options',          // Capability
        'theme-importer',          // Menu slug
        'demo_importer_page',      // Callback function
    );
}

// Display the page content with the button
function demo_importer_page() {
    ?>
    <div class="wrap-main-box">
        <div class="main-box">
            <h2><?php echo esc_html('Welcome to NGO Fundraiser','ngo-fundraiser'); ?></h2>
            <h3><?php echo esc_html('Create your website in just one click','ngo-fundraiser'); ?></h3>
            <hr>
            <p><?php echo esc_html('The "Begin Installation" helps you quickly set up your website by importing sample content that mirrors the demo version of the theme. This tool provides you with a ready-made layout and structure, so you can easily see how your site will look and start customizing it right away. It\'s a straightforward way to get your site up and running with minimal effort.','ngo-fundraiser'); ?></p>
            <p><?php echo esc_html('Click the button below to install the demo content.','ngo-fundraiser'); ?></p>
            <hr>
            <button id="import-theme-mods" class="button button-primary"><?php echo esc_html('Begin Installation','ngo-fundraiser'); ?></button>
            <div id="import-response"></div>
        </div>
    </div>
    <?php
}

// Add the AJAX action to trigger theme mods import
add_action('wp_ajax_import_theme_mods', 'demo_importer_ajax_handler');

// Handle the AJAX request
function demo_importer_ajax_handler() {
    // Sample data to import
    $theme_mods_data = array(
        'header_textcolor' => '000000',  // Example: change header text color
        'background_color' => 'ffffff',  // Example: change background color
        'custom_logo'      => 123,       // Example: set a custom logo by attachment ID
        'footer_text'      => 'Custom Footer Text', // Example: custom footer text
    );

    // Call the function to import theme mods
    if (demo_theme_importer($theme_mods_data)) {
        // After importing theme mods, create the menu
        create_demo_menu();
        wp_send_json_success(array(
        	'msg' => 'Theme mods imported successfully.',
        	'redirect' => home_url()
        ));
    } else {
        wp_send_json_error('Failed to import theme mods.');
    }

    wp_die();
}

// Function to set theme mods
function demo_theme_importer($import_data) {
    if (is_array($import_data)) {
        foreach ($import_data as $mod_name => $mod_value) {
            set_theme_mod($mod_name, $mod_value);
        }
        return true;
    } else {
        return false;
    }
}

// Function to create demo menu
function create_demo_menu() {

    // Page import process
    $pages_to_create = array(
        array(
            'title'    => 'Home',
            'slug'     => 'home',
            'template' => 'page-template/home-template.php',
        ),
        array(
            'title'    => 'About Us',
            'slug'     => 'about',
            'template' => '',
        ),
        array(
            'title'    => 'Causes',
            'slug'     => 'causes',
            'template' => '',
        ),
        array(
            'title'    => 'Pages',
            'slug'     => 'pages',
            'template' => '',
        ),
        array(
            'title'    => 'Blogs',
            'slug'     => 'blogs',
            'template' => '',
		),
        array(
            'title'    => 'Contact Us',
            'slug'     => 'contact-us',
            'template' => '',
        ),
    );

    // Loop through each page data to create pages
    foreach ($pages_to_create as $page_data) {
        $page_check = get_page_by_title($page_data['title']);
        
        // Check if the page doesn't exist already
        if (!$page_check) {
            $page = array(
                'post_type'    => 'page',
                'post_title'   => $page_data['title'],
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_slug'    => $page_data['slug'],
            );
            
            // Insert the page and get the inserted page ID
            $page_id = wp_insert_post($page);
            
            // Set the page template
            if ($page_id) {
                add_post_meta($page_id, '_wp_page_template', $page_data['template']);
            }
        }
    }

    // Set 'Home' as the front page
    $home_page = get_page_by_title('Home');
    if ($home_page) {
        update_option('page_on_front', $home_page->ID);
        update_option('show_on_front', 'page');
    }

    // Set 'Blog' as the posts page
    $blog_page = get_page_by_title('Blog');
    if ($blog_page) {
        update_option('page_for_posts', $blog_page->ID);
    }
    // ------- Create Main Menu --------
    $menuname =  'Primary Menu';
    $bpmenulocation = 'primary';
    $menu_exists = wp_get_nav_menu_object($menuname);
    
    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menuname);
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Home','ngo-fundraiser'),
            'menu-item-classes' => 'home',
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish'));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('About Us','ngo-fundraiser'),
            'menu-item-classes' => 'about',
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish',
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Causes','ngo-fundraiser'),
            'menu-item-classes' => 'causes',
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Pages','ngo-fundraiser'),
            'menu-item-classes' => 'pages',
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish'
        ));

		wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Blog','ngo-fundraiser'),
            'menu-item-classes' => 'blog',
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Contact Us','ngo-fundraiser'),
            'menu-item-classes' => 'contact-us',
            'menu-item-url' => home_url( '/' ),
            'menu-item-status' => 'publish'
        ));

        // Assign the menu to the location
        if (!has_nav_menu($bpmenulocation)) {
            $locations = get_theme_mod('nav_menu_locations');
            $locations[$bpmenulocation] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
    }
    
    //Header	

	set_theme_mod( 'ngo_fundraiser_header_button_text', 'Donate Now' );
    set_theme_mod( 'ngo_fundraiser_header_button_url', '#' );

    // Slider Section

	set_theme_mod( 'ngo_fundraiser_facebook_icon', 'fab fa-facebook-f' );
    set_theme_mod( 'ngo_fundraiser_facebook_url', '#' );

	set_theme_mod( 'ngo_fundraiser_twitter_icon', 'fab fa-twitter' );
    set_theme_mod( 'ngo_fundraiser_twitter_url', '#' );

	set_theme_mod( 'ngo_fundraiser_instagram_icon', 'fab fa-instagram' );
    set_theme_mod( 'ngo_fundraiser_intagram_url', '#' );
	
	set_theme_mod( 'ngo_fundraiser_linkedin_icon', 'fab fa-linkedin-in' );
    set_theme_mod( 'ngo_fundraiser_linkedin_url', '#' );
	
	set_theme_mod( 'ngo_fundraiser_pinterest_icon', 'fab fa-pinterest-p' );
    set_theme_mod( 'ngo_fundraiser_pintrest_url', '#' );

    set_theme_mod( 'ngo_fundraiser_slider_mail_text', 'support@expamle.com' );

	set_theme_mod( 'ngo_fundraiser_slider_short_heading', 'Welcome To Charity' );

	for($i=1;$i<=3;$i++){
		$title = 'Make The Difference Today With Charity';
		$content = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at 1500s.';
		   // Create post object
		$my_post = array(
		'post_title'    => wp_strip_all_tags( $title ),
		'post_content'  => $content,
		'post_status'   => 'publish',
		'post_type'     => 'page',
		);

		// Insert the post into the database
		$post_id = wp_insert_post( $my_post );

		if ($post_id) {
		   // Set the theme mod for the slider page
		   set_theme_mod('ngo_fundraiser_top_slider_page' . $i, $post_id);

		   $image_url = get_template_directory_uri().'/assets/img/slider.png';

		   $image_id = media_sideload_image($image_url, $post_id, null, 'id');

			   if (!is_wp_error($image_id)) {
				   // Set the downloaded image as the post's featured image
				   set_post_thumbnail($post_id, $image_id);
			   }
		 }
    }

	// Services

	set_theme_mod( 'ngo_fundraiser_about_us_heading', 'Popular Causes' );

	set_theme_mod( 'ngo_fundraiser_about_us_content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.' );

	$post_heading = array('We Provide Best medical Facility','Your Help Can Heal Their Helps','We encourage their education');
    for($i=1;$i<=3;$i++){


         $title = $post_heading[$i-1];
         $content = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at';
            // Create post object
         $my_post = array(
         'post_title'    => wp_strip_all_tags( $title ),
         'post_content'  => $content,
         'post_status'   => 'publish',
         'post_type'     => 'post',
         );

         // Insert the post into the database
         $post_id = wp_insert_post( $my_post );

         wp_set_object_terms( $post_id, 'Services', 'category' );

         if ($post_id) {

            $image_url_course = get_stylesheet_directory_uri().'/assets/images/causes'.$i.'.jpg';

            $image_id = media_sideload_image($image_url_course, $post_id, null, 'id');

                if (!is_wp_error($image_id)) {
                    // Set the downloaded image as the post's featured image
                    set_post_thumbnail($post_id, $image_id);
                }
        }
    }
}
// Enqueue necessary scripts
add_action('admin_enqueue_scripts', 'demo_importer_enqueue_scripts');

function demo_importer_enqueue_scripts() {
    wp_enqueue_script(
        'demo-theme-importer',
        get_template_directory_uri() . '/assets/js/theme-importer.js', // Path to your JS file
        array('jquery'),
        null,
        true
    );

    wp_enqueue_style('demo-importer-style', get_template_directory_uri() . '/assets/css/importer.css', array(), '');

    // Localize script to pass AJAX URL to JS
    wp_localize_script(
        'demo-theme-importer',
        'demoImporter',
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('theme_importer_nonce')
        )
    );
}

/**
 * Theme Info.
 */
function ngo_fundraiser_theme_info_load() {
	require get_theme_file_path( '/inc/theme-installation/theme-installation.php' );
}
add_action( 'init', 'ngo_fundraiser_theme_info_load' );