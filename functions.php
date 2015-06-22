<?php
   define ("THEMENAME", "laporte");

function init_theme_scripts() {
	add_filter('show_admin_bar', '__return_false');
}
add_action('init', 'init_theme_scripts');


/**
 * Slightly Modified Options Framework
 */

require_once ('admin/index.php');



/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/includes/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'my_theme_register_js_composer_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_js_composer_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // This is an example of how to include a plugin pre-packaged with a theme
        array(
            'name'          => 'WPBakery Visual Composer', // The plugin name
            'slug'          => 'js_composer', // The plugin slug (typically the folder name)
            'source'            => get_stylesheet_directory() . '/includes/js_composer.zip', // The plugin source
            'required'          => true, // If false, the plugin is only 'recommended' instead of required
            'version'           => '3.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'      => '', // If set, overrides default API URL and points to an external URL
        )
    );
  
    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'tgmpa';
  
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'        => $theme_text_domain, // Text domain - likely want to be the same as your theme.
        'default_path'      => '', // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php', // Default parent menu slug
        'parent_url_slug'   => 'themes.php', // Default parent URL slug
        'menu'          => 'install-required-plugins', // Menu slug
        'has_notices'       => true, // Show admin notices or not
        'is_automatic'      => false, // Automatically activate plugins after installation or not
        'message'       => '', // Message to output right before the plugins table
        'strings'       => array(
            'page_title'            => __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'            => __( 'Install Plugins', $theme_text_domain ),
            'installing'            => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            'oops'              => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install_required'   => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'    => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'  => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'   => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'        => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'          => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'         => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                => __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'          => __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'              => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
            'nag_type'              => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );
    tgmpa( $plugins, $config );
}
  
/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'your_prefix_vcSetAsTheme' );
function your_prefix_vcSetAsTheme() {
    vc_set_as_theme();
}

$current_path= dirname(__FILE__);
// Adding thumbnail into admin's column
require_once($current_path. '/includes/thumbnail.php');	// Thumbnails columns


/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */

function twentyfourteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'twentyfourteen_wp_title', 10, 2 );




/********** Sets up the content width value based on the theme's design and stylesheet. ***********/
if ( ! isset( $content_width ) )
$content_width = 1030;



/********** Register bootstrap javascript ***********/

function wpbootstrap_scripts_with_jquery(){
	wp_register_script( 'custom-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.js', array( 'jquery' ) ); // Updated 2.3.2
	wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );


/********** Register google fonts ***********/

function load_fonts() {
            wp_register_style('oswald', 'http://fonts.googleapis.com/css?family=Oswald:400, 300, 700');
            wp_enqueue_style( 'oswald');
            wp_register_style('droid-sans', 'http://fonts.googleapis.com/css?family=Droid+Sans:400, 700');
            wp_enqueue_style( 'droid-sans');
}
 
add_action('wp_print_styles', 'load_fonts');


/********** Register themes Stylesheet ***********/
function default_theme_styles() {
	global $wp_styles;
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// responsiveslider
	wp_enqueue_style( 'responsivecss', get_template_directory_uri() . '/css/responsiveslider/responsiveslides.css');
	
	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'default-theme-style', get_stylesheet_uri() );
	
	
	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	
	// Load our IE-only stylesheet for all versions of IE:
	wp_enqueue_style( 'default-theme-ie', get_template_directory_uri() . '/css/ie.css', array( 'default-theme-style' ), '2013');
	$wp_styles->add_data( 'default-theme-ie', 'conditional', 'IE' );
	
	 /**
	* Load our IE version-specific stylesheet:
	* <!--[if IE 7]> ... <![endif]-->
	*/
	wp_enqueue_style( 'default-theme-style-ie7', get_stylesheet_directory_uri() . "/css/ie7.css", array( 'default-theme-style' ), '2013');
	$wp_styles->add_data( 'default-theme-style-ie7', 'conditional', 'IE 7' );
	
	/**
     * Load our IE specific stylesheet for a range of older versions:
     * <!--[if lt IE 9]> ... <![endif]-->
     * <!--[if lte IE 8]> ... <![endif]-->
     * NOTE: You can use the 'less than' or the 'less than or equal to' syntax here interchangeably.
     */
    wp_enqueue_style( 'default-theme-style-old-ie', get_stylesheet_directory_uri() . "/css/old-ie.css", array( 'default-theme-style' ), '2013');
    $wp_styles->add_data( 'default-theme-style-old-ie', 'conditional', 'lt IE 9' );
    
    /**
     * Load our IE specific stylesheet for a range of newer versions:
     * <!--[if gt IE 8]> ... <![endif]-->
     * <!--[if gte IE 9]> ... <![endif]-->
     * NOTE: You can use the 'greater than' or the 'greater than or equal to' syntax here interchangeably.
     */
    wp_enqueue_style( 'default-theme-style-new-ie', get_stylesheet_directory_uri() . "/css/new-ie.css", array( 'default-theme-style' ), '2013');
    $wp_styles->add_data( 'default-theme-style-new-ie', 'conditional', 'gt IE 8' );
	
}
add_action( 'wp_enqueue_scripts', 'default_theme_styles' );






/********** Register themes javascript ***********/

add_action( 'wp_enqueue_scripts', 'load_javascript_files' );
function load_javascript_files(){
	 
	 wp_register_script( 'responsiveslider', get_template_directory_uri() . '/js/responsiveslider/responsiveslides.min.js','', 0, true );
	 
	 wp_register_script( 'custom', get_template_directory_uri() . '/js/custom.js', '', 0 , true );
	
	// use wp native jquery library
	
	wp_enqueue_script( 'jquery' ); // use wp native jquery
//	wp_enqueue_script( 'jquery-ui-core' ); // use wp native jquery UI
//	wp_enqueue_script( 'jquery-ui-accordion' ); // use wp native jquery jquery-ui-accordion
//	wp_enqueue_script( 'jquery-ui-tabs' ); // use wp native jquery jquery-ui-tabs
//	wp_enqueue_script( 'jquery-ui-tooltips' ); // use wp native jquery jquery-ui-tabs
//	wp_enqueue_script( 'thickbox' ); // use wp native jquery thickbox
	
	
	// ----------- Enable as your theme demands --------------// 
	// -------------------------------------------------------//
	
	
	wp_enqueue_script( 'responsiveslider' );
	wp_enqueue_script( 'custom' );
		 
}





/********** Custom Images ***********/

if ( function_exists('add_theme_support') ) {
	add_theme_support('post-thumbnails');
	//set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions 
	add_theme_support( 'automatic-feed-links' );
}
if ( function_exists( 'add_image_size' ) ) { 
	//Set the image size by resizing the image proportionally (that is, without distorting it): 
	//add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
	
	//Set the default Post Thumnail size by resizing the image proportionally (that is, without distorting it): 
	//set_post_thumbnail_size( 50, 50 ); // 50 pixels wide by 50 pixels tall, resize mode
	
	//Set the image size by cropping the image (either from the sides, or from the top and bottom)
	//(220 pixels wide by 180 pixels tall, hard crop modecropped)
	//add_image_size( 'homepage-thumb', 220, 180, true ); 
}

//add_filter('image_size_names_choose', 'my_image_sizes');
function my_image_sizes($sizes) {
    $addsizes = array(
         "category-thumb" => __( "Category Thumb",''),
         "homepage-thumb" => __( "Homepage-Thumb", '')
         // Add more
    );
    $newsizes = array_merge($sizes, $addsizes);
    return $newsizes;
}



/********** Force Perfect JPG Images ***********/

add_filter( 'jpeg_quality', 'smashing_jpeg_quality' );
function smashing_jpeg_quality() {
	return 100;
}



/********** Allow SVG through WordPress Media Uploader ***********/

function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );



/********** Custom editor stylesheet ***********/

function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );




/********** Remove WP default sizes ***********/

function sgr_filter_image_sizes( $sizes) {
		
	unset( $sizes['thumbnail']);
	unset( $sizes['medium']);
	unset( $sizes['large']);
	
	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'sgr_filter_image_sizes');



/*********** Add class to links generated by next_posts_link and previous_posts_link ***********/

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="styled-button"';
}



/*********** Displays navigation to next/previous pages when applicable. INDEX page ***********/

if ( ! function_exists( 'defaulttheme_content_nav' ) ) :

function defaulttheme_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );
	
	
	// Styled hired from twitter bootstrap
	
	
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<ul id="<?php echo $html_id; ?>" class="pager" role="navigation">
			<h3 class="assistive-text"><?//php _e( 'Post Pagination', THEMENAME ); ?></h3>
			
			<li class="previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', THEMENAME ) ); ?></li>
			<li class="next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', THEMENAME ) ); ?></li>
		</ul><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;



/*********** Displays navigation to next/previous pages when applicable. in SINGLE page***********/

if ( ! function_exists( 'content_nav' ) ) :

function content_nav() {?>
		
		<div class="row-fluid">
			<ul class="pager">
				<li class="previous">
					<?php previous_post_link('%link', '&larr; Previous post');?> 
				</li>
				
				<li class="next">				
					<?php next_post_link('%link', 'Next post &rarr;'); ?>
				</li>
			</ul>
		</div>
		
	<?php
}
endif;



/********** Register Custom Menus ***********/

add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(
		array(
			'Primary' => __( 'Primary Menu', THEMENAME)
		)
	);
}




/********** Create Default home page while theme initiates ***********/


// Create Home page
$name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name='Home'");
if ($name != '') {
	//
} else { 
	global $user_ID;
	$post = array();
	$post['post_type']    = 'page'; //could be 'post' for example
	$post['post_content'] = esc_attr('hello world!!');
	$post['post_author']  = null;
	$post['post_status']  = 'publish'; //draft
	$post['post_title']   = 'Home';
	$postid = wp_insert_post ($post);
	if ($postid == 0)
	    echo 'Screwed';
	else
	    echo 'Cool';
} 


/********** Register sidebar(s) ***********/

add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
	
		/*General Sidebar*/
		$general_sidebar=array(
			'id' => 'general_sidebar',
			'name' => __( 'General Sidebar' , THEMENAME),
			'description' => __( 'Add your message' , THEMENAME),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>'
		);
		
		/*Calendar Sidebar*/
		$mini_calendar_sidebar=array(
			'id' => 'mini_calendar_sidebar',
			'name' => __( 'Mini Calendar Sidebar' , THEMENAME),
			'description' => __( 'Drag Mini Calendar here' , THEMENAME),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>'
		);
		
		/*Home Footer sidebar */
		
		$f_h_sidebar=array(
			'id' => 'f_h_sidebar',
			'name' => __( 'Home Footer Sidebar One', THEMENAME),
			'description' => __( 'This sidebar is designed for displaying widgets in footer.', THEMENAME),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>'
		);
		
		$f_h_sidebar_one=array(
			'id' => 'f_h_sidebar_one',
			'name' => __( 'Home Footer Sidebar Two', THEMENAME),
			'description' => __( 'This sidebar is designed for displaying widgets in footer.', THEMENAME),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>'
		);
		
		/*Home Footer sidebar */
		$f_h_sidebar_two=array(
			'id' => 'f_h_sidebar_two',
			'name' => __( 'Home Footer Sidebar Three', THEMENAME),
			'description' => __( 'This sidebar is designed for displaying deals in footer.', THEMENAME),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>'
		);
		
		/*other Page Footer sidebar */
		$f_p_sidebar_one=array(
			'id' => 'f_p_sidebar_one',
			'name' => __( 'Other Page Footer Sidebar One', THEMENAME),
			'description' => __( 'This sidebar is designed for displaying widgets in footer.', THEMENAME),
			'before_widget' => '<div id="%1$s" class="get-in-touch widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>'
		);
		
		/*other Page Footer sidebar */
		$f_p_sidebar_two=array(
			'id' => 'f_p_sidebar_two',
			'name' => __( 'Other Page Footer Sidebar Two', THEMENAME),
			'description' => __( 'This sidebar is designed for displaying widgets in footer.', THEMENAME),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>'
		);
		
		/*other Page Footer sidebar */
		$f_p_sidebar_three=array(
			'id' => 'f_p_sidebar_three',
			'name' => __( 'Other Page Footer Sidebar Three', THEMENAME),
			'description' => __( 'This sidebar is designed for displaying widgets in footer.', THEMENAME),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>'
		);
		
		

		
		/* Register the sidebars. */
		register_sidebar( $general_sidebar );
		
		register_sidebar( $mini_calendar_sidebar );
		
		register_sidebar( $f_h_sidebar);
		
		register_sidebar( $f_h_sidebar_one );
		register_sidebar( $f_h_sidebar_two );
		
		register_sidebar( $f_p_sidebar_one );
		register_sidebar( $f_p_sidebar_two );
		register_sidebar( $f_p_sidebar_three );
}








/********** change upload label ***********/

add_filter("attribute_escape", "myfunction", 10, 2);
function myfunction($safe_text, $text) {
    return str_replace(__('Insert into Post', THEMENAME), __('Use this image', THEMENAME), $text);
}





/********** Set excerpt link ***********/

function new_excerpt_more($more) {
	global $post;
	return ' <br/><a class="btn btn-info" href="'. get_permalink($post->ID) . '">Read More</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/********** Set excerpt length***********/

function custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );





/********** Remove editor ***********/

function wpr_remove_editor_menu() {
  remove_action('admin_menu', '_add_themes_utility_last', 101);
}
global $remove_submenu_page, $current_user;
get_currentuserinfo();
if($current_user->user_login == 'admin') { //Specify admin name here
    add_action('admin_menu', 'wpr_remove_editor_menu', 1);
}



/**
 * Change the post type labels
 */
function change_post_type_labels() {
  global $wp_post_types;
  // Get the post labels
  $labels = &$wp_post_types['post']->labels;
  $labels->name = 'Articles';
  $labels->singular_name = 'Articles';
  $labels->add_new = 'Add Articles';
  $labels->add_new_item = 'Add Articles';
  $labels->edit_item = 'Edit Articles';
  $labels->new_item = 'Articles';
  $labels->view_item = 'View Articles';
  $labels->search_items = 'Search Articles';
  $labels->not_found = 'No Articles found';
  $labels->not_found_in_trash = 'No Articles found in Trash';
}
add_action( 'init', 'change_post_type_labels' );


/**
 * Change the post menu to article
 */
function change_post_menu_text() {
  global $menu;
  global $submenu;
  // Change menu item
  $menu[5][0] = 'Articles';
  // Change post submenu
  $submenu['edit.php'][5][0] = 'Articles';
  $submenu['edit.php'][10][0] = 'Add Articles';
  $submenu['edit.php'][16][0] = 'Articles Tags';
}
add_action( 'admin_menu', 'change_post_menu_text' );



// unregister all widgets
 function remove_default_widgets() {
     unregister_widget('WP_Widget_Pages');
     unregister_widget('WP_Widget_Calendar');
     unregister_widget('WP_Widget_Archives');
     unregister_widget('WP_Widget_Links');
     unregister_widget('WP_Widget_Meta');
     unregister_widget('WP_Widget_Search');
     unregister_widget('WP_Widget_Text');
     unregister_widget('WP_Widget_Categories');
     unregister_widget('WP_Widget_Recent_Posts');
     unregister_widget('WP_Widget_Recent_Comments');
     unregister_widget('WP_Widget_RSS');
     unregister_widget('WP_Widget_Tag_Cloud');
     unregister_widget('WP_Nav_Menu_Widget');
 }
// add_action('widgets_init', 'remove_default_widgets', 11);




//Add Missing Alt Tags To WordPress Images
function add_alt_tags($content)
{
        global $post;
        preg_match_all('/<img (.*?)\/>/', $content, $images);
        if(!is_null($images))
        {
                foreach($images[1] as $index => $value)
                {
                        if(!preg_match('/alt=/', $value))
                        {
                                $new_img = str_replace('<img', '<img alt="'.$post->post_title.'"', $images[0][$index]);
                                $content = str_replace($images[0][$index], $new_img, $content);
                        }
                }
        }
        return $content;
}
add_filter('the_content', 'add_alt_tags', 99999);


//filter the <p> tags from the images and iFrame
function filter_ptags_on_images($content)
{
$content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}
add_filter('the_content', 'filter_ptags_on_images');



/********** Remove yim, aim and jabber field and add fb and twitter to User Profiles ***********/

add_filter('user_contactmethods', 'user_contactmethods');  
function user_contactmethods($user_contactmethods){  
  
  unset($user_contactmethods['yim']);  
  unset($user_contactmethods['aim']);  
  unset($user_contactmethods['jabber']);  
  
  $user_contactmethods['twitter'] = 'Twitter Username';  
  $user_contactmethods['facebook'] = 'Facebook Username';  
  
  return $user_contactmethods;  
}  




/********** Icons for your Custom Post Types in the Admin Menu ***********/


function add_menu_icons_styles(){
?>
<!-- http://melchoyce.github.io/dashicons/ -->
<style>
/*Custom post type Events*/
#adminmenu .menu-icon-events div.wp-menu-image:before {
content: '\f145';
}

/*Custom post type News*/
#adminmenu .menu-icon-news div.wp-menu-image:before {
content: "\f163";
}

</style>
 
<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );



/********** Comments ***********/

function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <?php if($comment->user_id>0) { ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-authorby vcard">
         <div class="avatar">
         	<?php echo get_avatar( $comment->comment_author_email, 52 ); ?>
		 </div>
         
      </div> <!-- End comment-author -->
      
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.', THEMENAME) ?></em>
         <br />
      <?php endif; ?>
		
					
      <div class="comment-metaby commentmetadata"><?php edit_comment_link(__('(Edit)', THEMENAME),'  ','') ?></div>
	<div class="comment-databy">
	
		<div class="authornameby">
         <?php printf(__('<cite class="fn">%s</cite> <span class="says"></span>'), get_comment_author_link()) ?>
         <a class="comment-date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s', THEMENAME), comment_date('F j, Y \a\t g:i a')) ?></a>
         </div>	
      <?php comment_text() ?>
	
     </div> <!-- End comment-data -->
     
     <div class="replyby">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>

    <div class="clear"></div>
     </div>
     
     
     <?php } else { ?>
     
     
     <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
         <div class="avatar">
         	<?php echo get_avatar( $comment->comment_author_email, 52 ); ?>
		 </div>
         
      </div> <!-- End comment-author -->
      
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.', THEMENAME) ?></em>
         <br />
      <?php endif; ?>
		
					
      <div class="comment-meta commentmetadata"><?php edit_comment_link(__('(Edit)', THEMENAME),'  ','') ?></div>
	<div class="comment-data">
	
		<div class="authorname">
         <?php printf(__('<cite class="fn">%s</cite> <span class="says"></span>'), get_comment_author_link()) ?>
         <a class="comment-date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s', THEMENAME), comment_date('F j, Y \a\t g:i a')) ?></a>
         </div>	
      <?php comment_text() ?>
    </div> <!-- End comment-data -->
    
    <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
     </div>
    
    <div class="clear"></div>
     </div>

     <?php }}

function dox_get_submit_auto_page() {
	global $dox_options;
	return get_permalink( 'Add Post' );
}

add_shortcode('awos', 'laporte_awos', 7);
function laporte_awos ( $atts ) {
	$awos = get_awos_data();
	$arr = explode( ' RMK ', $awos[1] );
	$awos_text = $arr[0];
	//wp_enqueue_script( 'tipton-home', get_template_directory_uri() . '/js/home.js', array('jquery'), '20120206', true );
	global $post;
	//$sfra = apply_filters ( 'the_content' , get_post_meta($post->ID, 'sidebar_content', true) );
	$output = $awos_text;
	return $output;
}
function get_awos_data() {
	$myfile = get_template_directory() . '/AWOS.txt';
	$myfile_data = file( $myfile );
	$now = time();
	$last_update = (int)trim($myfile_data[0]);
	$diff = ( $now - $last_update );
	
	if ( $diff < 1200 ) {
		foreach ( $myfile_data as $k => $v) {
			$myfile_data[$k] = trim($v);
		}
		return $myfile_data;
	} else {
		$url = "http://aviationweather.gov/adds/metars/?station_ids=KPPO&std_trans=standard&chk_metars=on&hoursStr=most+recent+only&submitmet=Submit";
		
		
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$output = curl_exec($curl);
		curl_close($curl);
		$pattern = '|<FONT FACE="Monospace,Courier">(.*)?</FONT>|s';
		preg_match($pattern, $output, $matches);
		$awos_text = str_replace( array( "\n","\r" ), "", $matches[1] );
		$parts = explode( ' ', $awos_text );
		if ( $parts[0] != 'KPPO' ) { return $myfile_data; }
		$wind_dir = $wind_speed = '';
		foreach( $parts as $part ){
			if ( substr($part, -2) == 'KT' ) {
				$wind_dir = substr($part, 0, 3);
				$wind_speed = substr($part, 3, 2);
			}
		}
		if ( empty($wind_dir) || empty($wind_speed) ) { return $myfile_data; }
		$newdata = array( $now, $awos_text, $wind_dir, $wind_speed );
		$file_out = implode( "\n", $newdata );
		$h = fopen( $myfile, 'w+' );
		fwrite( $h, $file_out );
		fclose( $h );
		return $newdata;
	}
	
	$h = fopen( $myfile, 'w+' );
	fwrite( $h, $now . "\n" );
	fclose( $h );
}

?>