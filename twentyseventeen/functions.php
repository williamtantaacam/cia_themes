<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentyseventeen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyseventeen' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enables custom line height for blocks
	 */
	add_theme_support( 'custom-line-height' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'twentyseventeen-featured-image', 2000, 1200, true );

	add_image_size( 'twentyseventeen-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'top'    => __( 'Top Menu', 'twentyseventeen' ),
			'social' => __( 'Social Links Menu', 'twentyseventeen' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
			'navigation-widgets',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://wordpress.org/support/article/post-formats/
	 */
	add_theme_support(
		'post-formats',
		array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);

	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo',
		array(
			'width'      => 250,
			'height'     => 250,
			'flex-width' => true,
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
	  */
	add_editor_style( array( 'assets/css/editor-style.css', twentyseventeen_fonts_url() ) );

	// Load regular editor styles into the new block-based editor.
	add_theme_support( 'editor-styles' );

	// Load default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets'     => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts'       => array(
			'home',
			'about'            => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact'          => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog'             => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'twentyseventeen' ),
				'file'       => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'twentyseventeen' ),
				'file'       => 'assets/images/sandwich.jpg',
			),
			'image-coffee'   => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'twentyseventeen' ),
				'file'       => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options'     => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods'  => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus'   => array(
			// Assign a menu to the "top" location.
			'top'    => array(
				'name'  => __( 'Top Menu', 'twentyseventeen' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name'  => __( 'Social Links Menu', 'twentyseventeen' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'twentyseventeen_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'twentyseventeen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twentyseventeen_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( twentyseventeen_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filters Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'twentyseventeen_content_width', $content_width );
}
add_action( 'template_redirect', 'twentyseventeen_content_width', 0 );

/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url() {
	$fonts_url = '';

	/*
	 * translators: If there are characters in your language that are not supported
	 * by Libre Franklin, translate this to 'off'. Do not translate into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'twentyseventeen' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family'  => urlencode( implode( '|', $font_families ) ),
			'subset'  => urlencode( 'latin,latin-ext' ),
			'display' => urlencode( 'fallback' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function twentyseventeen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyseventeen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyseventeen_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'twentyseventeen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'twentyseventeen' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'twentyseventeen' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twentyseventeen_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Post title. */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyseventeen_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'twentyseventeen_pingback_header' );

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );

	$customize_preview_data_hue = '';
	if ( is_customize_preview() ) {
		$customize_preview_data_hue = 'data-hue="' . $hue . '"';
	}
	?>
	<style type="text/css" id="custom-theme-colors" <?php echo $customize_preview_data_hue; ?>>
		<?php echo twentyseventeen_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'twentyseventeen_colors_css_wrap' );

/**
 * Enqueues scripts and styles.
 */
function twentyseventeen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'twentyseventeen-style', get_stylesheet_uri(), array(), '20201208' );

	// Theme block stylesheet.
	wp_enqueue_style( 'twentyseventeen-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'twentyseventeen-style' ), '20190105' );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'twentyseventeen-style' ), '20190408' );
	}

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'twentyseventeen-style' ), '20161202' );
		wp_style_add_data( 'twentyseventeen-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentyseventeen-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'twentyseventeen-style' ), '20161202' );
	wp_style_add_data( 'twentyseventeen-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '20161020' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentyseventeen-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '20161114', true );

	$twentyseventeen_l10n = array(
		'quote' => twentyseventeen_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'twentyseventeen-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '20161203', true );
		$twentyseventeen_l10n['expand']   = __( 'Expand child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['collapse'] = __( 'Collapse child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['icon']     = twentyseventeen_get_svg(
			array(
				'icon'     => 'angle-down',
				'fallback' => true,
			)
		);
	}

	wp_enqueue_script( 'twentyseventeen-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '20190121', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_scripts' );

/**
 * Enqueues styles for the block-based editor.
 *
 * @since Twenty Seventeen 1.8
 */
function twentyseventeen_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'twentyseventeen-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks.css' ), array(), '20201208' );
	// Add custom fonts.
	wp_enqueue_style( 'twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'twentyseventeen_block_editor_styles' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentyseventeen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			$sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2 );

/**
 * Filters the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function twentyseventeen_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'twentyseventeen_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentyseventeen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 * @return string The template to be used: blank if is_home() is true (defaults to index.php),
 *                otherwise $template.
 */
function twentyseventeen_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'twentyseventeen_front_page_template' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Seventeen 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentyseventeen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentyseventeen_widget_tag_cloud_args' );

/**
 * Gets unique ID.
 *
 * This is a PHP implementation of Underscore's uniqueId method. A static variable
 * contains an integer that is incremented with each call. This number is returned
 * with the optional prefix. As such the returned value is not universally unique,
 * but it is unique across the life of the PHP process.
 *
 * @since Twenty Seventeen 2.0
 *
 * @see wp_unique_id() Themes requiring WordPress 5.0.3 and greater should use this instead.
 *
 * @param string $prefix Prefix for the returned ID.
 * @return string Unique ID.
 */
function twentyseventeen_unique_id( $prefix = '' ) {
	static $id_counter = 0;
	if ( function_exists( 'wp_unique_id' ) ) {
		return wp_unique_id( $prefix );
	}
	return $prefix . (string) ++$id_counter;
}

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Block Patterns.
 */
require get_template_directory() . '/inc/block-patterns.php';

/**
 * Add more member roles.
 */

add_role('regular_member', ( 'Regular Member' ), array('read' => true,  // true allows this capability
'edit_posts'   => false,));

add_role('premium_member', ( 'Premium Member' ), array('read' => true,  // true allows this capability
'edit_posts'   => false,));

add_role('vip_member', ( 'VIP Member' ), array('read' => true,  // true allows this capability
'edit_posts'   => false,));

add_role('unpaid_business_member', ( 'Business Member Unpaid' ), array('read' => true,  // true allows this capability
'edit_posts'   => false,));

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    <h3><?php _e("Extra profile information", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="discount"><?php _e("discount"); ?></label></th>
        <td>
            <input type="text" name="discount" id="discount" value="<?php echo esc_attr( get_the_author_meta( 'discount', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please put down the discount amount. for exp. 10% off is 10"); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="Email Sent"><?php _e("City"); ?></label></th>
        <td>
            <input type="text" name="approved" id="approved" value="<?php echo esc_attr( get_the_author_meta( 'approved', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter the email status."); ?></span>
        </td>
    </tr>
    
    </table>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
        return;
    }
    
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'discount', $_POST['discount'] );
    update_user_meta( $user_id, 'approved', $_POST['approved'] );
}

function sfold(String $s, int $M) {
	$sum = 0;
	$mul = 1;
	for ($i = 0; $i < strlen($s); $i++) {
		if($i % 4 == 0){
			$mul = 1;
		}else{
			$mul = $mul * 256;
		}
		$sum = $sum + base_convert(substr($s, $i, 1), 36, 10) * $mul;
	}
	$final = $sum % $M;
	if(strlen($final) < 3){
		$final = '0' . $final;
	}
	if(strlen($final) < 3){
		$final = '0' . $final;
	}
	return $final;
}

function combine_nums($num1, $num2, $num3){
	$final = '';
	$num1 = $num1 .  '000000000';
	$num2 = $num2 .  '000000000';
	$num3 = $num3 .  '000000000';
	for ($i = 0; $i < 9; $i++) {
		$add = (substr($num1, $i, 1) + substr($num2, $i, 1) +substr($num3, $i, 1)) % 10;
		$final = $final . $add;
	}
	return $final;
}



if(function_exists('get_field') and function_exists('um_fetch_user') and function_exists('update_field') and function_exists('UM') and function_exists('get_users')){
$users = get_users( array( 'fields' => array( 'ID' ) ) );
foreach($users as $user){
	$inst =  get_field('first_name', 'user_' . $user -> ID);
	$first_num = sfold($inst, 1000000000);
	$inst2 =  get_field('last_name', 'user_' . $user -> ID);
	$last_num = sfold($inst2, 1000000000);
	$user_info = get_userdata($user -> ID);
	$inst3 = $user_info->user_email;

	
	$email_num = sfold($inst3, 1000000000);
	um_fetch_user($user -> ID );
	$user_roles = get_userdata($user -> ID ) -> roles;
	
	// this chunk updates the current role of the user simotaniously
	if(in_array('administrator', $user_roles)){
		$toupdate = array('curr_role' => 'Admin');
	}
	elseif(in_array('vip_member', $user_roles) ){
		$toupdate = array('curr_role' => 'ACI VIP Membership $1799 / year + HST');
	}
	elseif(in_array('regular_member', $user_roles)){
		$toupdate = array('curr_role' => 'Regular Membership $48.99 / year + HST');
	}
	elseif(in_array('premium_member', $user_roles)){
		$toupdate = array('curr_role' => 'Premium Membership $149.99 / year + HST');
	}
	elseif(in_array('pms_subscription_plan_886', $user_roles)){
		$toupdate = array('curr_role' => 'Business Membership $149.99 / year + HST');
	}
	elseif(in_array('pms_subscription_plan_890', $user_roles)){
		$toupdate = array('curr_role' => 'Business Membership $149.99 / year + HST');
	}
	elseif(in_array('pms_subscription_plan_694', $user_roles)){
		$toupdate = array('curr_role' => 'Approved - pending for payment');
	}
	elseif(in_array('unpaid_business_member', $user_roles)){
		$toupdate = array('curr_role' => 'Not A Member');
	}
	elseif(in_array('subscriber', $user_roles)){
		$toupdate = array('curr_role' => 'Not A Member');
	}
	
	
	um_fetch_user($user -> ID );
	UM()->user()->update_profile($toupdate);

	$display_name = um_user('testtt'); 

	if(in_array('unpaid_business_member', $user_roles) and count($user_roles) >= 2){
		$u = new WP_User( $user -> ID  ); //pick a past user Role	
		$u ->remove_role( 'unpaid_business_member' );
	}
	$app_status = um_user('app_status');
	if(($display_name == 'Regular Membership - $48.99 / year + HST' or $display_name == 'Premium Membership $149.99 / year + HST' or $display_name == 'ACI VIP Membership $1799 / year + HST') and $app_status == 'Approved' ){
		update_field('nickname', 'A' . combine_nums($first_num , $last_num , $email_num) ,  'user_' . $user -> ID);
		$toupdate = array('nickname' => 'A' . combine_nums($first_num , $last_num , $email_num));
		UM()->user()->update_profile($toupdate);
	} // updated2
	elseif(in_array('vip_member', $user_roles) or in_array('regular_member', $user_roles) or in_array('premium_member', $user_roles)){
		update_field('nickname', 'A' . combine_nums($first_num , $last_num , $email_num) ,  'user_' . $user -> ID);
		$toupdate = array('nickname' => 'A' . combine_nums($first_num , $last_num , $email_num));
		UM()->user()->update_profile($toupdate);
	}
	elseif(in_array('pms_subscription_plan_694', $user_roles)){
		update_field('nickname', 'B' . combine_nums($first_num , $last_num , $email_num) ,  'user_' . $user -> ID);
		$toupdate = array('nickname' => 'B' . combine_nums($first_num , $last_num , $email_num));
		UM()->user()->update_profile($toupdate);
	}
	elseif($display_name == 'Business Membership $149.99 / year + HST'){
		update_field('nickname', 'B' . combine_nums($first_num , $last_num , $email_num) ,  'user_' . $user -> ID);
		$toupdate = array('nickname' => 'B' . combine_nums($first_num , $last_num , $email_num));
		UM()->user()->update_profile($toupdate);
	}
	elseif(in_array('unpaid_business_member', $user_roles) or in_array('pms_subscription_plan_890', $user_roles)){
		update_field('nickname', 'B' . combine_nums($first_num , $last_num , $email_num) ,  'user_' . $user -> ID);
		$toupdate = array('nickname' => 'B' . combine_nums($first_num , $last_num , $email_num));
		UM()->user()->update_profile($toupdate);
	}
	elseif($user_roles[0] == 'subscriber' and count($user_roles) == 1){
		update_field('nickname', ' ' ,  'user_' . $user -> ID);
		$toupdate = array('nickname' => ' ');
		UM()->user()->update_profile($toupdate);
	}
	wp_update_user($user);
    }

}



// send email button
// 
//add_filter( 'the_content', 'report_a_bug_form' );
//function report_a_bug_form( $content ) {

    // Display the form only on posts.
//    if ( get_permalink(get_the_ID()) != 'https://canadianinventorsassociation.com/user/' ) {
//        return $content; 
//    }
//
    // Add the form to the bottom of the content.
//  $content .= '<form action="' . admin_url( 'admin-post.php' ) . '" method="POST">
//      <input type="hidden" name="post_id" value="' . get_the_ID() . '">
//	<input type="hidden" name="url" value= "' . wp_get_current_user() -> user_email  . '" >
//      <input type="hidden" name="action" value="report_a_bug">
//      <button>' . __( 'Apply', 'reportabug' ) . '</button>
//  </div>';

//  return $content;

//


//add_action( 'admin_post_report_a_bug', 'report_a_bug_handler' );
//add_action( 'admin_post_nopriv_report_a_bug', 'report_a_bug_handler' );
//

if(function_exists('get_transient') and function_exists('get_userdata') and function_exists('um_fetch_user') and function_exists('UM') and function_exists('um_user') and function_exists('UM')){
function report_a_bug_handler() {

    do_action( 'report_a_bug', $_POST['post_id'], $_POST['url'] );

    // Redirect back to the article.
    wp_safe_redirect( get_permalink( $_POST['post_id'] ) );
    exit;

}

// If User Profile updated
function sr_user_profile_update_phone( $user_id, $old_user_data ) {
 
  $old_user_data = get_transient( 'sr_old_user_data_' . $user_id );
  $user = get_userdata( $user_id );
  $admin_email = "wtan@bigtan.com, rzhang@taacam.com, info@cainventors.org, sale@cainventors.org"; 
  $headers = "From:info@cainventors.org \r\n Bcc: " . $admin_email;
 


	um_fetch_user($user -> ID );
	
    $account_status = um_user('account_status'); 
	if($account_status == 'awaiting_email_confirmation' or $account_status == 'checkmail'){
		return none;
	}
	$email_sent =  get_field('approved', 'user_' . $user -> ID);
	$display_name = um_user('testtt'); 
	$app_status = um_user('app_status'); 
	$user_roles = $user->roles;
	if(in_array('premium_member', $user_roles) or in_array('vip_member', $user_roles) or in_array('regular_member', $user_roles) or in_array('pms_subscription_plan_890', $user_roles) or 
	   in_array('pms_subscription_plan_694', $user_roles)){
		$user_hightest_role = 'inventor';
	}elseif(in_array('pms_subscription_plan_886', $user_roles) or in_array('unpaid_business_member', $user_roles)){
		$user_hightest_role = 'business';
	}
	$expre1 = ($display_name ==  'Business Membership $149.99 / year + HST');
	$expre2 = ($display_name ==  'Not A Member');
	$expre3 = ($display_name ==  '');
	if($expre1 or $expre2 or $expre3){
		// do nothing
	}
	elseif($user_hightest_role == 'business' and $app_status == 'Disapproved' ){
		um_fetch_user($user -> ID );
		//UM()->user()->update_profile($toupdate);

		$first_name = um_user('first_name'); 
		$last_name = um_user('last_name'); 
		$message = sprintf( __( 'Hello %s' ), $first_name . ' ' . $last_name ). "\r\n\r\n";
		$message .= sprintf( __( 'Thank you for your interest in our membership.' ) ) . "\r\n\r\n";
		$message .= sprintf( __( 'We have carefully reviewed your application. Unfortunately we decided that you are not eligible at this moment. ' ) ) . "\r\n\r\n";
		$message .= sprintf( __( 'If you believe this is a mistake or you have additional information to provide, you can please login to your account and reapply.' ) ) . "\r\n\r\n";
		$message .= sprintf( __( 'Looking forward to hearing from you again soon.' ) ) . "\r\n\r\n";		
		$message .= sprintf( __( 'Canadian Inventors Association' ) ) . "\r\n\r\n";		

		wp_mail( $user->user_email , sprintf( __( 'Thank You for Your Application' ), get_option('blogname') ), $message, $headers);
	}
	elseif($user_hightest_role == 'business' and $app_status == 'Approved' and  $email_sent != 'Y'){
		um_fetch_user($user -> ID );
		//UM()->user()->update_profile($toupdate);

		$first_name = um_user('first_name'); 
		$last_name = um_user('last_name'); 
		$nickname = um_user('nickname'); 
		
		$message = sprintf( __( 'Hello %s' ), $first_name . ' ' . $last_name ). "\r\n\r\n";
		$message .= sprintf( __( 'Thank you for your interest in our membership.' ) ) . "\r\n\r\n";
		$message .= sprintf( __( 'Your membership is now approved.' ) ) . "\r\n\r\n";
		$message .= sprintf( __( 'Your membership ID is: %s' ), str_replace("B", "A", $nickname) ). "\r\n\r\n";
		$message .= sprintf( __( 'Please make the payment.' ) ) . "\r\n\r\n";
		$message .= sprintf( __( 'https://canadianinventorsassociation.com/registration-page/' ) ) . "\r\n\r\n";		
		$message .= sprintf( __( 'Canadian Inventors Association' ) ) . "\r\n\r\n";	

		update_field('approved', 'Y' ,  'user_' . $user -> ID);
		wp_mail( $user->user_email , sprintf( __( 'Your Membership is Now Approved' ), get_option('blogname') ), $message, $headers);
	}
	elseif($user_hightest_role == 'business' and ( $app_status == 'Disapproved') ){
		
		um_fetch_user($user -> ID );
//		UM()->user()->update_profile($toupdate);
		$add_txt = um_user('add_txt'); 
		$num_pat = um_user('num_pat'); 
		$pat_nums = um_user('pat_nums'); 
		$pat_name = um_user('pat_name'); 
		$com_ad = um_user('com_ad'); 
		$comp_name = um_user('comp_name'); 
		$home_ad = um_user('home_ad'); 
		$phone_number = um_user('phone_number'); 
		$desire_role = um_user('testtt'); 
		$ID = um_user('nickname'); 
		$first_name = um_user('first_name'); 
		$last_name = um_user('last_name'); 
		$message = sprintf( __( 'This user has updated their profile on the canadianinventorsassociation Member site.' ) ) . "\r\n\r\n";
		$message .= sprintf( __( 'User Full Name: %s' ), $first_name . $last_name ). "\r\n\r\n";
		$message .= sprintf( __( 'User ID: %s' ), $ID  ). "\r\n\r\n";
		$message .= sprintf( __( 'Email: %s' ), $user->user_email ). "\r\n\r\n";
		$message .= sprintf( __( 'Current User Role: %s' ), $current_role). "\r\n\r\n";
		$message .= sprintf( __( 'User Desired Role: %s' ), $desire_role  ). "\r\n\r\n";
		$message .= sprintf( __( 'Phone Number: %s' ), $phone_number  ). "\r\n\r\n";
		$message .= sprintf( __( 'Home Adress: %s' ), $home_ad  ). "\r\n\r\n";
		$message .= sprintf( __( 'Company Name: %s' ), $comp_name  ). "\r\n\r\n";
		$message .= sprintf( __( 'Company Adress: %s' ), $com_ad  ). "\r\n\r\n";
		$message .= sprintf( __( 'Number of Patent: %s' ), $num_pat  ). "\r\n\r\n";
		$message .= sprintf( __( 'Patent Numbers: %s' ), $pat_nums  ). "\r\n\r\n";
		$message .= sprintf( __( 'Name on Patents: %s' ), $pat_name  ). "\r\n\r\n";
		$message .= sprintf( __( 'Additional info: %s' ), $add_txt  ). "\r\n\r\n";
		$message .= sprintf( __( 'Account Stutus: %s' ), $account_status  ). "\r\n\r\n";
		$link1 = 'https://canadianinventorsassociation.com/wp-content/uploads/ultimatemember/' . $user -> ID . '/' .  um_user('stuff1');
		$link2 = 'https://canadianinventorsassociation.com/wp-content/uploads/ultimatemember/' . $user -> ID . '/' .  um_user('file2');
		$link3 = 'https://canadianinventorsassociation.com/wp-content/uploads/ultimatemember/' . $user -> ID . '/' .  um_user('file3');
		$link4 = 'https://canadianinventorsassociation.com/wp-content/uploads/ultimatemember/' . $user -> ID . '/' .  um_user('file4');
		if(um_user('stuff1') != ''){
		$message .= sprintf( __( 'attach: %s' ), $link1   ). "\r\n\r\n";
			if(um_user('file2') != ''){
				$message .= sprintf( __( 'attach: %s' ), $link2  ). "\r\n\r\n";
				if(um_user('file3') != ''){
					$message .= sprintf( __( 'attach: %s' ), $link3  ). "\r\n\r\n";
					if(um_user('file4') != ''){
						$message .= sprintf( __( 'attach: %s' ), $link4  ). "\r\n\r\n";
					}
				}
			}
		}
		wp_mail( $admin_email, sprintf( __( 'User Applied a New Membership via Profile Update; Require Approval' ), get_option('blogname') ), $message);
		$toupdate = array('$app_status' => 'Pending');
		UM()->user()->update_profile($toupdate);
	}
    
}
 
add_action( 'profile_update', 'sr_user_profile_update_phone', 10, 2 );
}


if(function_exists('get_userdata') and function_exists('um_fetch_user') and function_exists('UM') and function_exists('um_user') and function_exists('UM')){
add_filter( 'the_content', 'add_a_button' );
function add_a_button( $content ) {

    // Display the form only on posts.
    if ( get_permalink(get_the_ID()) != 'https://canadianinventorsassociation.com/user/' ) {
        return $content; 
    }
	
	// if the user is Not A Member, pay button
	$user_roles = wp_get_current_user() -> roles;
	um_fetch_user(wp_get_current_user() -> ID );
	$desired_role = um_user('testtt'); 
	$app_status = um_user('app_status'); 
	if(in_array('premium_member', $user_roles) and $desired_role != 'Premium Membership $149.99 / year + HST'){
			$content .= '<form action="https://canadianinventorsassociation.com/registration-page/" method="POST">
        <button>' . __( 'Pay Membership'  ) . '</button>    </div>';
	}
	elseif(in_array('vip_member', $user_roles) and $desired_role != 'ACI VIP Membership $1799 / year + HST'){
			$content .= '<form action="https://canadianinventorsassociation.com/registration-page/" method="POST">
        <button>' . __( 'Pay Membership'  ) . '</button>    </div>';
	}
	elseif(in_array('regular_member', $user_roles) and $desired_role != 'Regular Membership $48.99 / year + HST'){
			$content .= '<form action="https://canadianinventorsassociation.com/registration-page/" method="POST">
        <button>' . __( 'Pay Membership3'  ) . '</button> </div>';
	}
	// Inventor-Business
	elseif(in_array('pms_subscription_plan_890', $user_roles) and $desired_role != 'Business Membership $149.99 / year + HST'){
		$content .= '<form action="https://canadianinventorsassociation.com/registration-page/" method="POST">
        <button>' . __( 'Pay Membership'  ) . '</button> </div>';	
	}
	// Non Inventor Business
	elseif(in_array('pms_subscription_plan_886', $user_roles) and $desired_role != 'Business Membership $149.99 / year + HST'){
		if($app_status == 'Approved' ){
			$content .= '<form action="https://canadianinventorsassociation.com/registration-page/" method="POST">
        <button>' . __( 'Change Membership'  ) . '</button> </div>';	
		}
		elseif($app_status == 'Disapproved'){
			$content .= 'Thank you for your interest in our membership. We have carefully reviewed your application. Unfortunately we decided that you are not eligible at this moment. If you beleive this is a mistake or you have additional information to provide, you can reapply. looking forward to hearing from you again soon.';	
		}
		elseif($app_status == 'Pending'){
			$content .= 'Your Application for ' .  $desired_role . ' has been recieved. It usually takes no longer than 1-2 business day for us to review you application. We will email you once your membership is approved.';	
		}
		else{
			$toupdate = array('app_status' => 'Pending');
			UM()->user()->update_profile($toupdate);
			$content .= 'Your Application for ' .  $desired_role . ' has been recieved. It usually takes no longer than 1-2 business day for us to review you application. We will email you once your membership is approved.';
		}
			
	}
	// Initial Un-approved Member
	elseif($user_roles[0] == 'unpaid_business_member' and count($user_roles) == 1){
		if( ($desired_role == 'Business Membership $149.99 / year + HST')  or $app_status == 'Approved'  ){
			$content .= '<form action="https://canadianinventorsassociation.com/registration-page/" method="POST">
        <button>' . __( 'Pay Membership'  ) . '</button> </div>';	
		}
		elseif($desired_role == 'Not A Member'){
			$content .= '<form action="https://canadianinventorsassociation.com/registration-page/" method="POST">
        <button>' . __( 'Change Membership'  ) . '</button> </div>';	
		}
		elseif($app_status == 'Disapproved'){
			$content .= 'Thank you for your interest in our membership. We have carefully reviewed your application. Unfortunately we decided that you are not eligible at this moment. If you beleive this is a mistake or you have additional information to provide, you can reapply. looking forward to hearing from you again soon.';	
		}
		elseif($app_status == 'Pending'){
			$content .= 'Your Application for ' .  $desired_role . ' has been recieved. It usually takes no longer than 1-2 business day for us to review you application. We will email you once your membership is approved.';	
		}
		else{
			$toupdate = array('app_status' => 'Pending');
			UM()->user()->update_profile($toupdate);
			$content .= 'Your Application for ' .  $desired_role . ' has been recieved. It usually takes no longer than 1-2 business day for us to review you application. We will email you once your membership is approved.';	
		}
	}
	// Approved Member
	elseif($user_roles[0] == 'pms_subscription_plan_694' and count($user_roles) == 1){ 
		$content .= '<form action="https://canadianinventorsassociation.com/registration-page/" method="POST">
        <button>' . __( 'Pay Membership'  ) . '</button>    </div>';
	}
	else{
		$content .= '<form action="https://canadianinventorsassociation.com/registration-page/" method="POST">
        <button>' . __( 'Change Membership'  ) . '</button>    </div>';
	}

    return $content;
    
}
}// test2

add_filter( 'wp_mail_from_name', 'custom_wpse_mail_from_name' );
function custom_wpse_mail_from_name( $original_email_from ) {
    return 'Canadian Inventors Association';
}
  
add_action( 'um_after_user_status_is_changed_hook', 'my_after_user_status_is_changed', 10 );
function my_after_user_status_is_changed($user_id) {
			      // your code here
    $user = get_userdata( $user_id );
    $headers = "From:info@cainventors.org";
 

    $admin_email = "wtan@bigtan.com, rzhang@taacam.com, info@cainventors.org, sale@cainventors.org"; //
	um_fetch_user($user -> ID );
	$email_sent =  get_field('approved', 'user_' . $user -> ID);
	$display_name = um_user('testtt'); 
	$app_status = um_user('app_status'); 
	
	$account_status = um_user('account_status');
	if($account_status != 'approved'){
		return none;
	}
	$user_roles = $user->roles;
	if(in_array('premium_member', $user_roles) or in_array('vip_member', $user_roles) or in_array('regular_member', $user_roles) or in_array('pms_subscription_plan_890', $user_roles) or 
	   in_array('pms_subscription_plan_694', $user_roles)){
		$user_hightest_role = 'inventor';
	}elseif(in_array('pms_subscription_plan_886', $user_roles) or in_array('unpaid_business_member', $user_roles)){
		$user_hightest_role = 'business';
	}
	$expre1 = ($display_name ==  'Business Membership $149.99 / year + HST');
	$expre2 = ($display_name ==  'Not A Member');
	$expre3 = ($display_name ==  '');
	if($expre1 or $expre2 or $expre3){
		// do nothing
	}

	elseif($user_hightest_role == 'business' and $app_status != 'Pending' ){
		
		um_fetch_user($user -> ID );
//		UM()->user()->update_profile($toupdate);
		$add_txt = um_user('add_txt'); 
		$num_pat = um_user('num_pat'); 
		$pat_nums = um_user('pat_nums'); 
		$pat_name = um_user('pat_name'); 
		$com_ad = um_user('com_ad'); 
		$comp_name = um_user('comp_name'); 
		$home_ad = um_user('home_ad'); 
		$phone_number = um_user('phone_number'); 
		$desire_role = um_user('testtt'); 
		$ID = um_user('nickname'); 
		$first_name = um_user('first_name'); 
		$last_name = um_user('last_name'); 
		$message = sprintf( __( 'This user has updated their profile on the canadianinventorsassociation Member site.' ) ) . "\r\n\r\n";
		$message .= sprintf( __( 'User Full Name: %s' ), $first_name . $last_name ). "\r\n\r\n";
		$message .= sprintf( __( 'User ID: %s' ), $ID  ). "\r\n\r\n";
		$message .= sprintf( __( 'Email: %s' ), $user->user_email ). "\r\n\r\n";
		$message .= sprintf( __( 'Current User Role: %s' ), $current_role). "\r\n\r\n";
		$message .= sprintf( __( 'User Desired Role: %s' ), $desire_role  ). "\r\n\r\n";
		$message .= sprintf( __( 'Phone Number: %s' ), $phone_number  ). "\r\n\r\n";
		$message .= sprintf( __( 'Home Adress: %s' ), $home_ad  ). "\r\n\r\n";
		$message .= sprintf( __( 'Company Name: %s' ), $comp_name  ). "\r\n\r\n";
		$message .= sprintf( __( 'Company Adress: %s' ), $com_ad  ). "\r\n\r\n";
		$message .= sprintf( __( 'Number of Patent: %s' ), $num_pat  ). "\r\n\r\n";
		$message .= sprintf( __( 'Patent Numbers: %s' ), $pat_nums  ). "\r\n\r\n";
		$message .= sprintf( __( 'Name on Patents: %s' ), $pat_name  ). "\r\n\r\n";
		$message .= sprintf( __( 'Additional info: %s' ), $add_txt  ). "\r\n\r\n";
		$link1 = 'https://canadianinventorsassociation.com/wp-content/uploads/ultimatemember/' . $user -> ID . '/' .  um_user('stuff1');
		$link2 = 'https://canadianinventorsassociation.com/wp-content/uploads/ultimatemember/' . $user -> ID . '/' .  um_user('file2');
		$link3 = 'https://canadianinventorsassociation.com/wp-content/uploads/ultimatemember/' . $user -> ID . '/' .  um_user('file3');
		$link4 = 'https://canadianinventorsassociation.com/wp-content/uploads/ultimatemember/' . $user -> ID . '/' .  um_user('file4');
		if(um_user('stuff1') != ''){
		$message .= sprintf( __( 'attach: %s' ), $link1   ). "\r\n\r\n";
			if(um_user('file2') != ''){
				$message .= sprintf( __( 'attach: %s' ), $link2  ). "\r\n\r\n";
				if(um_user('file3') != ''){
					$message .= sprintf( __( 'attach: %s' ), $link3  ). "\r\n\r\n";
					if(um_user('file4') != ''){
						$message .= sprintf( __( 'attach: %s' ), $link4  ). "\r\n\r\n";
					}
				}
			}
		}
		wp_mail( $admin_email, sprintf( __( 'User Applied a New Membership via Profile Update; Require Approval' ), get_option('blogname') ), $message);
		$toupdate = array('$app_status' => 'Pending');
		UM()->user()->update_profile($toupdate);
	}
}


add_action('my_hourly_event', 'do_this_hourly');

// The action will trigger when someone visits your WordPress site
function my_activation() {
    if ( !wp_next_scheduled( 'my_hourly_event' ) ) {
        wp_schedule_event( current_time( 'timestamp' ), 'hourly', 'my_hourly_event');
    }
}
add_action('wp', 'my_activation');

function do_this_hourly() {
	$users = get_users( array( 'fields' => array( 'ID' ) ) );
    foreach($users as $user){
	    um_fetch_user($user -> ID);

	    $account_status = um_user('account_status');
	    if($account_status == 'awaiting_email_confirmation' or $account_status == 'checkmail'){
		    $today_date  = strtotime( current_time('Y-m-d H:i:s') );
            $register_date  =  get_userdata($user -> ID)->user_registered;
            $registered =  strtotime( $register_date );
            $interval_date = ( $registered - $today_date) /(60 * 60 * 24);
	    	if($interval_date >= 3){
                require_once(ABSPATH.'wp-admin/includes/user.php' );
				$success = wp_delete_user($user -> ID);

	    	}
    	}
    }
	

}


 
add_filter( 'the_content', 'add_popular_bar' );
function add_popular_bar($content) {
	
  if(is_single()) {
	  
	  $content .= "<div>[post-views]</div><h3><b>Other Popular News</b></h3> [wpp range='custom' time_quantity=12 time_unit='month' limit=5 thumbnail_width=30 thumbnail_height=30]" ;

  } 
	
	    return $content;
}
   
	
