<?php
/**
 * Odin functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Odin
 * @since 2.2.0
 */

/**
 * Sets content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
require_once get_template_directory() . '/core/classes/class-shortcodes.php';
//require_once get_template_directory() . '/core/classes/class-shortcodes-menu.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
// require_once get_template_directory() . '/core/classes/class-theme-options.php';
// require_once get_template_directory() . '/core/classes/class-options-helper.php';
// require_once get_template_directory() . '/core/classes/class-post-type.php';
// require_once get_template_directory() . '/core/classes/class-taxonomy.php';
// require_once get_template_directory() . '/core/classes/class-metabox.php';
// require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
// require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';
// require_once get_template_directory() . '/core/classes/class-post-status.php';
//require_once get_template_directory() . '/core/classes/class-term-meta.php';

/**
 * Odin Widgets.
 */
require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';

if ( ! function_exists( 'odin_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since 2.2.0
	 */
	function odin_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'odin' )
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

		add_theme_support( 'custom-header', $default );

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
		);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Support Custom Editor Style.
		 */
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
			)
		);

		/**
		 * Add support for Post Formats.
		 */
		// add_theme_support( 'post-formats', array(
		//     'aside',
		//     'gallery',
		//     'link',
		//     'image',
		//     'quote',
		//     'status',
		//     'video',
		//     'audio',
		//     'chat'
		// ) );

		/**
		 * Support The Excerpt on pages.
		 */
		// add_post_type_support( 'page', 'excerpt' );

		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for custom logo.
		 *
		 *  @since Odin 2.2.10
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 240,
			'width'       => 240,
			'flex-height' => true,
		) );
	}
}

add_action( 'after_setup_theme', 'odin_setup_features' );

/**
 * Register widget areas.
 *
 * @since 2.2.0
 */
function odin_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'odin' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'odin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'odin_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since 2.2.0
 */
function odin_flush_rewrite() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'odin_flush_rewrite' );

/**
 * Load site scripts.
 *
 * @since 2.2.0
 */
function odin_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads Odin main stylesheet.
	wp_enqueue_style( 'odin-style', get_stylesheet_uri(), array(), null, 'all' );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// Html5Shiv
	wp_enqueue_script( 'html5shiv', $template_url . '/assets/js/html5.js' );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	// General scripts.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		// Bootstrap.
		wp_enqueue_script( 'bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true );

		// FitVids.
		wp_enqueue_script( 'fitvids', $template_url . '/assets/js/libs/jquery.fitvids.js', array(), null, true );

		// Main jQuery.
		wp_enqueue_script( 'odin-main', $template_url . '/assets/js/main.js', array(), null, true );
	} else {
		// Grunt main file with Bootstrap, FitVids and others libs.
		wp_enqueue_script( 'odin-main-min', $template_url . '/assets/js/main.min.js', array(), null, true );
	}

	// Grunt watch livereload in the browser.
	// wp_enqueue_script( 'odin-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/style.css';
}

add_filter( 'stylesheet_uri', 'odin_stylesheet_uri', 10, 2 );

/**
 * Query WooCommerce activation
 *
 * @since  2.2.6
 *
 * @return boolean
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * WooCommerce compatibility files.
 */
if ( is_woocommerce_activated() ) {
	add_theme_support( 'woocommerce' );
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';
	require get_template_directory() . '/inc/woocommerce/template-tags.php';
}
/* menus */
function menu_shortcode() {
   

            echo '<nav role="navigation">

  <div id="menuToggle">
      <div class="menu-circle">
    	
    </div>
    <input type="checkbox" />
    <span></span>
    <span></span>
    <span></span>

    <ul id="menu">';
    wp_nav_menu(
							array(
								'theme_location' => 'main-menu',
								'depth'          => 2,
								'container'      => false,
								'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
								'walker'         => new Odin_Bootstrap_Nav_Walker()
							)
						);
     
    echo'</ul>
  </div>
</nav>';
  
}

add_shortcode( 'menu', 'menu_shortcode' );

/* banner */
function banner_home_shortcode() {
   

            echo '<div class="banner-home">
            <div class="col-banner-50" id="sociais" style="background:url(';
            if( get_field('banner_social') ):;
            the_field('banner_social');
            endif;
            echo')">
          
<h2><a href="#" >Eventos<br>
sociais</a></h2>';

 wp_nav_menu(
							array(
								'theme_location' => 'social-menu'
							)
						);

echo ' </div>
             <div class="col-banner-50" id="corporativos" style="background:url(';
              if( get_field('banner_corporativo') ):;
            the_field('banner_corporativo');
            endif;
            echo')">
          
<h2 class="text-right"><a href="#" >Eventos<br>
corporativos</a></h2>';
echo '<ul id="menu-corporativo">';
 wp_nav_menu(
							array(
								'theme_location' => 'corporativo-menu'
							)
						);

echo '</ul>



            </div>

</div>';

  
}

add_shortcode( 'banner-home', 'banner_home_shortcode' );



/* box home */
function destaques_shortcode() {
   
            echo '<div style="width:100%;float:left">';
            echo ' <div class="col-md-4">
            		<div class="box-destaque">
            		<img src="http://sh-pro84.teste.website/~grupot86/novo-site/wp-content/uploads/2021/04/Componente-10-–-1.png" alt="">
            			<div class="box-conteudo">
            	<div class="vertical-align">
            	<h3></h3>
            	<p></p>
            	</div>
            	</div>
            	<div class="box-title">
            		<h4>Localização privilegiada</h4>
            	</div>
            	

            </div>
            </div>


<div class="col-md-4">
            		<div class="box-destaque">
            		<img src="http://sh-pro84.teste.website/~grupot86/novo-site/wp-content/uploads/2021/05/destaque-02.png" alt="">
                      		<div class="box-conteudo">
            	<div class="vertical-align">
            	<h3></h3>
            	<p></p>
            	</div>
            	</div>
            	<div class="box-title">
            		<h4>Infraestrutura completa</h4>
            	</div>
            	

            </div>
            </div>


            <div class="col-md-4">
            		<div class="box-destaque">
            		<img src="http://sh-pro84.teste.website/~grupot86/novo-site/wp-content/uploads/2021/05/destaque-03.png" alt="">
            		<div class="box-conteudo">
            	<div class="vertical-align">
            	<h3></h3>
            	<p></p>
            	</div>
            	</div>
            	<div class="box-title">
            		<h4>Espaços sustentáveis</h4>
            	</div>
            	

            </div>
            </div>
            </div>
            ';

  
}

add_shortcode( 'destaques', 'destaques_shortcode' );

function add_my_script() {
    wp_enqueue_script(
      'custom-script', get_template_directory_uri() . '/assets/js/banner-home.js', 
        array('jquery') 
    );
}
add_action( 'wp_enqueue_scripts', 'add_my_script' );

/*menu social*/
function register_additional_menu() {
register_nav_menu( 'social-menu' ,__( 'Menu Social' )); 
}
add_action( 'init', 'register_additional_menu' );

/*menu social*/
function register_additional_menu2() {
register_nav_menu( 'corporativo-menu' ,__( 'Menu Corporativo' )); 
}
add_action( 'init', 'register_additional_menu2' );







function my_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyAV1ny0t_wo6tnn4od-q29pNYrQKG70XKE');
}

add_action('acf/init', 'my_acf_init');


add_action( 'elementor_pro/posts/query/locais-relalcionados', function ( $query ) { $postid = get_the_ID(); $ids = get_post_meta($postid, 'relacao-posts', true); if ( $ids ) { $query->set( 'post__in', $ids ); } } );