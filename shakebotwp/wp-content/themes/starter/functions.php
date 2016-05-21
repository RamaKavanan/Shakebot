<?php
ini_set('max_execution_time', 600);
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );
add_filter('show_admin_bar', '__return_false');

define('THEMEUMNAME', wp_get_theme()->get( 'Name' ));

define('THMCSS', get_template_directory_uri().'/css/');

define('THMJS', get_template_directory_uri().'/js/');

// Re-define meta box path and URL

define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/lib/meta-box' ) );
define( 'RWMB_DIR', trailingslashit(  get_stylesheet_directory() . '/lib/meta-box' ) );

// Include the meta box script
require_once RWMB_DIR . 'meta-box.php';

require_once (get_template_directory().'/lib/metabox.php');



/*-------------------------------------------------------
 *				SMOF Theme Options Added
 *-------------------------------------------------------*/

require_once( get_template_directory()  . '/admin/index.php');

/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/

register_nav_menu( 'primary','Primary Menu' );
register_nav_menu( 'secondary','Secondary Menu' );




function getContrast50($hexcolor){
    return (hexdec($hexcolor) > 0xffffff/2) ? 'light-bg':'dark-bg';
}


/*-------------------------------------------*
 *				Themeum setup
 *------------------------------------------*/

if(!function_exists('thmtheme_setup')):

	function thmtheme_setup()
	{
		// load textdomain
    	load_theme_textdomain('themeum', get_template_directory() . '/languages');

		add_theme_support( 'post-thumbnails' );

		add_image_size( 'blog-thumb', 750, 350, true );

		add_theme_support( 'post-formats', array( 'aside','audio','chat','gallery','image','link','quote','status','video' ) );

		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );

		add_theme_support( 'automatic-feed-links' );

		add_editor_style('');

		if ( ! isset( $content_width ) )
		$content_width = 660;
	}

	add_action('after_setup_theme','thmtheme_setup');

endif;


/*-------------------------------------------*
 *		Themeum Widget Registration
 *------------------------------------------*/

if(!function_exists('thmtheme_widdget_init')):

	function thmtheme_widdget_init()
	{

		register_sidebar(array( 'name' 			=> __( 'Sidebar', 'themeum' ),
							  	'id' 			=> 'sidebar',
							  	'description' 	=> __( 'Widgets in this area will be shown on Sidebar.', 'themeum' ),
							  	'before_title' 	=> '<h3  class="widget_title">',
							  	'after_title' 	=> '</h3>',
							  	'before_widget' => '<div id="%1$s" class="widget %2$s" >',
							  	'after_widget' 	=> '</div>'
					)
		);

		register_sidebar(array( 'name' 			=> __( 'Bottom', 'themeum' ),
							  	'id' 			=> 'bottom',
							  	'description' 	=> __( 'Widgets in this area will be shown before Footer.' , 'themeum'),
							  	'before_title' 	=> '<h3 class="widget_title">',
							  	'after_title' 	=> '</h3>',
							  	'before_widget' => '<div class="col-sm-3 col-xs-6 bottom-widget"><div id="%1$s" class="widget %2$s" >',
							  	'after_widget' 	=> '</div></div>'
				)
		);
	}
	
	add_action('widgets_init','thmtheme_widdget_init');

endif;


/*-------------------------------------------*
 *		Themeum Style
 *------------------------------------------*/

if(!function_exists('themeum_style')):

    function themeum_style(){

    	global $themeum;

        wp_enqueue_style('thm-style',get_stylesheet_uri());
        wp_enqueue_style('font-awesome',THMCSS.'font-awesome.min.css');

        if(isset($themeum['g_select'])):
			wp_enqueue_style(themeum_slug($themeum['g_select']).'_one','http://fonts.googleapis.com/css?family='.$themeum['g_select'].':100,200,300,400,500,600,700,800,900',array(),false,'all');
		endif;

		if(isset($themeum['head_font'])):
			wp_enqueue_style(themeum_slug($themeum['head_font']).'_two','http://fonts.googleapis.com/css?family='.$themeum['head_font'].':100,200,300,400,500,600,700,800,900',array(),false,'all');
		endif;

		if(isset($themeum['nav_font'])):
			wp_enqueue_style(themeum_slug($themeum['nav_font']).'_three','http://fonts.googleapis.com/css?family='.$themeum['nav_font'].':100,200,300,400,500,600,700,800,900',array(),false,'all');
		endif;

        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap',THMJS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('SmoothScroll',THMJS.'SmoothScroll.js',array(),false,true);
        wp_enqueue_script('scrollTo',THMJS.'jquery.scrollTo.js',array(),false,true);
        wp_enqueue_script('nav',THMJS.'jquery.nav.js',array(),false,true);
        wp_enqueue_script('parallax',THMJS.'jquery.parallax.js',array(),false,true);
        wp_enqueue_script('main',THMJS.'main.js',array(),false,true);
        wp_enqueue_style('quick-style',get_template_directory_uri().'/quick-style.php',array(),false,'all');


		if(isset($themeum['presets'])):
			if(!empty($themeum['presets'])):
				$style_name = $themeum['presets'];
			else:
				$style_name = 'preset1';
			endif;
		else:
			$style_name 	= 'preset1';
		endif;

		wp_enqueue_style('sportson_'.$style_name,get_template_directory_uri().'/css/presets/'.$style_name.'.css');

    }

    add_action('wp_enqueue_scripts','themeum_style');

endif;


if(!function_exists('themeum_admin_style')):

	function themeum_admin_style()
	{
		if(is_admin())
		{
			wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/zee-post-meta.js');
			wp_enqueue_script('thmpostmeta');
		}
	}

	add_action('admin_enqueue_scripts','themeum_admin_style');

endif;

/*-------------------------------------------*
 *				Excerpt Length
 *------------------------------------------*/

if(!function_exists('new_excerpt_more')):

	function new_excerpt_more( $more )
	{
		//return '&nbsp;<br /><br /><a class="btn btn-success btn-lg" href="'. get_permalink( get_the_ID() ) . '">'.__('Continue Reading','themeum').' &rarr;</a>';
		return '&nbsp;<br /><br /><a class="btn btn-lg" href="'. get_permalink( get_the_ID() ) . '" style="background-color:#cc9900; color:#fff; font-weight:bold;">'.__('Continue Reading','themeum').' &rarr;</a>';
	}
	add_filter( 'excerpt_more', 'new_excerpt_more' );

endif;



if(!function_exists('themeum_slug')):

	function themeum_slug($text)
{
	return preg_replace('/[^a-z0-9_]/i','-', strtolower($text));
}

endif;



/*-------------------------------------------------------
*			Include the TGM Plugin Activation class
*-------------------------------------------------------*/

require_once( get_template_directory()  . '/lib/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'themeum_plugins_include');

if(!function_exists('themeum_plugins_include')):

	function themeum_plugins_include()
	{
		$plugins = array(
				array(
					'name'                  => 'Starter Client', // The plugin name
					'slug'                  => 'starter-client', // The plugin slug (typically the folder name)
					'source'                => get_stylesheet_directory() . '/lib/plugins/starter-client.zip', // The plugin source
					'required'              => true, // If false, the plugin is only 'recommended' instead of required
					'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation'    => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url'          => '', // If set, overrides default API URL and points to an external URL
				),

				array(
					'name'                  => 'Starter Slider', // The plugin name
					'slug'                  => 'starter-slider', // The plugin slug (typically the folder name)
					'source'                => get_stylesheet_directory() . '/lib/plugins/starter-slider.zip', // The plugin source
					'required'              => true, // If false, the plugin is only 'recommended' instead of required
					'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation'    => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url'          => '', // If set, overrides default API URL and points to an external URL
				),

				array(
					'name'                  => 'Starter Team', // The plugin name
					'slug'                  => 'starter-team', // The plugin slug (typically the folder name)
					'source'                => get_stylesheet_directory() . '/lib/plugins/starter-team.zip', // The plugin source
					'required'              => true, // If false, the plugin is only 'recommended' instead of required
					'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation'    => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url'          => '', // If set, overrides default API URL and points to an external URL
				),



				array(
					'name'                  => 'Themeum Project', // The plugin name
					'slug'                  => 'themeum-project', // The plugin slug (typically the folder name)
					'source'                => get_stylesheet_directory() . '/lib/plugins/themeum-project.zip', // The plugin source
					'required'              => true, // If false, the plugin is only 'recommended' instead of required
					'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation'    => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url'          => '', // If set, overrides default API URL and points to an external URL
				)
			);

	$theme_text_domain = 'themeum';

	/**
	* Array of configuration settings. Amend each line as needed.
	* If you want the default strings to be available under your own theme domain,
	* leave the strings uncommented.
	* Some of the strings are added into a sprintf, so see the comments at the
	* end of each line for what each argument will be.
	*/
	$config = array(
			'domain'            => $theme_text_domain,           // Text domain - likely want to be the same as your theme.
			'default_path'      => '',                           // Default absolute path to pre-packaged plugins
			'parent_menu_slug'  => 'themes.php',         		 // Default parent menu slug
			'parent_url_slug'   => 'themes.php',         		 // Default parent URL slug
			'menu'              => 'install-required-plugins',   // Menu slug
			'has_notices'       => true,                         // Show admin notices or not
			'is_automatic'      => false,            			 // Automatically activate plugins after installation or not
			'message'           => '',               			 // Message to output right before the plugins table
			'strings'           => array(
						'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
						'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
						'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
						'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
						'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
						'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
						'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
						'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
						'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
						'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
						'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
						'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
						'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
						'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
						'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
						'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
						'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
				)
	);

	tgmpa( $plugins, $config );

	}

endif;



/*-------------------------------------------------------
 *			Themeum Pagination
 *-------------------------------------------------------*/

if(!function_exists('thm_pagination')):

	function thm_pagination($pages = '', $range = 2)
	{  
	     $showitems = ($range * 1)+1;  

	     global $paged;

	     if(empty($paged)) $paged = 1;

	     if($pages == '')
	     {
	         global $wp_query;
	        // $wp_query->max_num_pages = 3; //Added	         
	         $pages = $wp_query->max_num_pages;
	         

	         if(!$pages)
	         {
	             $pages = 1;
	         }
	     }   

	     if(1 != $pages)
	     {
			echo "<ul class='pagination'>";

			if($paged > 2 && $paged > $range+1 && $showitems < $pages){
				echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
			}

			if($paged > 1 && $showitems < $pages){ 
				echo '<li>';
				previous_posts_link("Previous");
				echo '</li>';
			}

			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<li class='active'><a href='#'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
				}
			}

			if ($paged < $pages && $showitems < $pages){
				echo '<li>';
				next_posts_link("Next");
				echo '</li>';
			}

			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
				echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
			}
			
			echo "</ul>";
	     }
	}

endif;


/*-------------------------------------------------------
 *				Themeum Comment
 *-------------------------------------------------------*/

if(!function_exists('themeum_comment')):

	function themeum_comment($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'themeum' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
			
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>" class="comment-body media">
				
					<div class="comment-avartar pull-left">
						<?php
							echo get_avatar( $comment, $args['avatar_size'] );
						?>
					</div>
					<div class="comment-context media-body">
						<div class="comment-head">
							<?php
								printf( '<span class="comment-author">%1$s</span>',
									get_comment_author_link());
							?>
							<span class="comment-date"><?php echo get_comment_date() ?></span><span class="comment-time"> at <?php echo get_comment_time()?></span>

							<?php edit_comment_link( __( 'Edit', 'themeum' ), '<span class="edit-link">', '</span>' ); ?>
							<span class="comment-reply">
								<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'themeum' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
							</span>
						</div>

						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'themeum' ); ?></p>
						<?php endif; ?>

						<div class="comment-content">
							<?php comment_text(); ?>
						</div>
					</div>
				
			</div>
		<?php
			break;
		endswitch; 
	}

endif;

/*--------------------------------------------------------------
 *			Theme Shortcode
 *-------------------------------------------------------------*/

// service shortcode

add_shortcode('service','service_shortcode');

/*function service_shortcode($atts,$content = null)
{
	extract(shortcode_atts(array( 'icon' => '', 'title' => ''),$atts));
	
	$output = '';

	$output .= '<div class="service-box col-md-4 col-sm-6 col-xs-12">';
	$output .= '<div class="service-box-1 pull-left">';
	//$output .= '<span><i class="fa fa-'.$icon.' icon-custom-style"></i></span>';
	$output .= '<span><img src="'.$icon.'" class="icon-custom-style" width="30px" height="30px"></span>';
	$output .= '</div>';
	$output .= '<div class="service-box-2">';
	$output .= '<h3>'.$title.'</h3>';
	$output .= '<p>'.$content.'</p>';
	$output .= '</div>';
	$output .= '</div>';
	
	return $output;
}*/

function service_shortcode($atts,$content = null)
{
	extract(shortcode_atts(array( 'icon' => '', 'title' => '', 'more' => ''),$atts));
	static $stst = 1;
	
	$output = '';

	$output .= '<div class="service-box col-md-4 col-sm-6 col-xs-12" style="float:right">';
	$output .= '<div class="service-box-1 pull-left">';
	//$output .= '<span><i class="fa fa-'.$icon.' icon-custom-style"></i></span>';
	$output .= '<span><img src="'.$icon.'" class="icon-custom-style" width="30px" height="30px"></span>';
	$output .= '</div>';
	$output .= '<div class="service-box-2">';
	$output .= '<h3>'.$title.'</h3>';
	$output .= '<p>'.$content.'</p>';
	$output .= '<p><a href="#terminal" style="color:#fff;" onclick=showmore('.$stst.'); id="'.$stst.'morelink">Read More...</a><p style="display:none; margin-top:-5px;" id="'.$stst.'more">'.$more.'<br /><span style="line-height:3;"><a href="#terminal" style="color:#fff;" onclick=hidemore('.$stst.'); id="'.$stst.'morelink">Read Less...</a></span></p></p>';
	$output .= '</div>';
	$output .= '</div>';
	
	$stst++;
	
	return $output;
}

// feature shortcode

add_shortcode('feature','feature_shortcode');

function feature_shortcode($atts,$content = null)
{
	static $j=1;
	extract(shortcode_atts(array( 'icon' => '', 'title' => '', 'color' => '1'),$atts));

	$s='';
	//if($icon != "http://shakebot.biz/shakebotwp/wp-content/uploads/2015/09/bottle-icon.png"){
        
        if($icon != site_url() ."/wp-content/uploads/2015/09/bottle-icon.png"){
		$s = 'width="40px" height="40px"';
	}else{
		$s = 'width="20px" height="40px"';
	}

	$output = '';
	$output .= '<div class="feature-box col-md-4 col-sm-6 col-xs-12" id="feature-box'.$j.'">';
	$output .= '<div class="feature-box-1 pull-left color-'.$color.'">';
	//$output .= '<span><i class="fa fa-'.$icon.' icon-custom-style"></i></span>';
	$output .= '<span><img src="'.$icon.'" class="icon-custom-style" '.$s.'  style="margin-top:10px"></span>';
	$output .= '</div>';
	$output .= '<div class="feature-box-2">';
	$output .= '<h3>'.$title.'</h3>';
	$output .= '<p>'.$content.'</p>';
	$output .= '</div>';
	$output .= '</div>';

	$j++;
	return $output;
}

// feature shortcode

add_shortcode('action','call_to_action_shortcode');

function call_to_action_shortcode($atts,$content = null)
{
	extract(shortcode_atts(array( 'title' => '', 'link' => '#', 'button' => 'Purchase Now'),$atts));

	$output = '';
	$output .= '<div id="call-to-action">';
	$output .= '<div class="container">';
	$output .= '<div class="row">';
	$output .= '<div class="col-xs-12 col-sm-7 col-md-9">';
	$output .= '<h2>'.$content.'</h2>';
	$output .= '</div>';
	$output .= '<div class="col-xs-12 col-sm-5 col-md-3">';
	$output .= '<a class="btn btn-success btn-lg pull-right" href="'.$link.'">'.$button.'</a>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}


/*--------------------------------------------------------------
 * Get All Terms of Taxonomy 
 * @author : Themeum
 *-------------------------------------------------------------*/


function get_all_term_names( $post_id, $taxonomy = 'post_tag' )
{
	$terms = get_the_terms( $post_id, $taxonomy );

	$term_names = '';
    if ( $terms && ! is_wp_error( $terms ) )
    { 
        $term_name = array();

        foreach ( $terms as $term ) {
            $term_name[] = $term->name;
        }

        $term_names = join( ", ", $term_name );
    }

    return $term_names;
}


/*--------------------------------------------------------------
 *				One-Page Nav Walker
 *-------------------------------------------------------------*/

class Onepage_Walker extends Walker_Nav_menu{

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0){

		global $wp_query;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join(' ', $classes);

       	$class_names = ' class="'. esc_attr( $class_names ) . '"';

       
		$attributes 	= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes 	.= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';


		if($item->object == 'page')
		{
		    $post_object = get_post($item->object_id);

		    $separate_page = get_post_meta($item->object_id, "thm_no_hash", true);

		    $disable_item = get_post_meta($item->object_id, "thm_disable_menu", true);

			$current_page_id = get_option('page_on_front');

		    if ( ( $disable_item != true ) && ( $post_object->ID != $current_page_id ) ) {

		    	$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names.'>';

		    	if ( $separate_page == true ){
		        //	if($item->url == "http://shakebot.biz/shakebotwp/index.php/login/"){					
                            	if($item->url == site_url(). "/index.php/login/"){					
						$attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'" class="simplemodal-login"' : '';
					}else{
						$attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'" class="no-scroll"' : '';
					}		        	
		        }else{
		        	if (is_front_page()) 
		        		$attributes .= ' href="#' . $post_object->post_name . '"'; 
		        	else 
		        		$attributes .= ' href="' . home_url() . '#' . $post_object->post_name . '" class="no-scroll"';
		        }	

		        $item_output = $args->before;
		        $item_output .= '<a'. $attributes .'>';
		        $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
		        $item_output .= $args->link_after;
		        $item_output .= '</a>';
		        $item_output .= $args->after;

		        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );            	              	
		    }
		                             
		}
		else
		{

			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names.'>';

			//if($item->url == "http://shakebot.biz/shakebotwp/wp-login.php?redirect_to=index.php"){
                        
                        if($item->url == site_url()."/wp-login.php?redirect_to=index.php"){
				$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'" class="simplemodal-login"' : '';
			}else{
				$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'" class="no-scroll"' : '';
			}

		    $item_output = $args->before;
	        $item_output .= '<a'. $attributes .'>';
	        $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
	        $item_output .= $args->link_after;
	        $item_output .= '</a>';
	        $item_output .= $args->after;

		    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}


function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );

add_filter( 'the_content_more_link', 'modify_read_more_link' );
function modify_read_more_link() {
return '<a class="more-link" href="' . get_permalink() . '">Read More...</a>';
}

add_action ('init' , 'prevent_profile_access');
 
function prevent_profile_access(){
   		//if (current_user_can('manage_options')) return '';
   		
   		$usr = wp_get_current_user();
		
   		if (strpos ($_SERVER ['REQUEST_URI'] , 'wp-admin/' ) &&  ($usr->roles[0] == "subscriber")){
      		//wp_redirect ("http://shakebot.biz/shakebotwp/#aboutus-2");
      		//wp_redirect ("http://shakebot.biz/shakebotwp/index.php/my-profile/?login5=1");  
                wp_redirect (site_url() ."/index.php/my-profile/?login5=1");  
      		    		
 		 }
 
}

function my_wp_nav_menu_args( $args = '' ) {

if( is_user_logged_in() ) { 
	$args['menu'] = 'Main menu';
} else { 
	$args['menu'] = 'Main menu logged in';
} 
	return $args;
}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );



function give_profile_name($atts){
    $user=wp_get_current_user();
    $name=$user->display_name; 
    return $name; 
}
add_shortcode('profile_name', 'give_profile_name');

add_filter( 'wp_nav_menu_objects', 'my_dynamic_menu_items' );
function my_dynamic_menu_items( $menu_items ) {
    
    foreach ( $menu_items as $menu_item ) {
        
        //if ( '#profile_link#' == $menu_item->title && (is_user_logged_in()) ) {
        if ( 'Log In' == $menu_item->title && (is_user_logged_in()) ) {
            global $shortcode_tags;
    
            if ( isset( $shortcode_tags['profile_name'] ) ) {
                // Or do_shortcode(), if you must.
                $menu_item->title = call_user_func( $shortcode_tags['profile_name'] );
                $menu_item->url = "#";
                //echo "<pre>"; print_r($menu_item);
            } 
        } else if ( '#profile_link#' == $menu_item->title && (!is_user_logged_in()) ) {
            $menu_item->title = 'Login';
        }
    }
    return $menu_items;
}




/*********************************************************************/
define("GENDER_MALE",    "male");
define("GENDER_FEMALE",    "female");
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );
add_action( 'user_new_form', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { $usr = wp_get_current_user();

$sportArr = array("American Football"=>"American Football",
	"Softball"=>"Softball",										
	"Baseball"=>"Baseball",
	"Basketball"=>"Basketball",
	"Bodybuilding"=>"Bodybuilding",
	"Bowling"=>"Bowling",
	"Combat Sports"=>"Combat Sports",
	"Cricket"=>"Cricket",
	"Cross Country"=>"Cross Country",
	"Cardio Training"=>"Cardio Training",
	"CrossFit"=>"CrossFit",
	"Swimming"=>"Swimming",
	"Running"=>"Running",
	"Field Hockey"=>"Field Hockey",
	"Golf"=>"Golf",
	"Gymnastics"=>"Gymnastics",
	"Ice Hockey"=>"Ice Hockey",
	"Lacrosse"=>"Lacrosse",
	"Rowing"=>"Rowing",
	"Rugby"=>"Rugby",
	"Snow Sports"=>"Snow Sports",
	"Soccer"=>"Soccer",
	"Tennis"=>"Tennis",
	"Track and Field"=>"Track and Field",
	"Long Distance Event"=>"Long Distance Event",
	"Volleyball"=>"Volleyball",
	"Resistance Training"=>"Resistance Training");

$posArrTemp = array(

"American Football"=>array("Wide Receiver"=>"Wide Receiver","Running Back"=>"Running Back","Special Teams"=>"Special Teams","Quarterback"=>"Quarterback","Tight End"=>"Tight End","Linebacker"=>"Linebacker","Lineman"=>"Lineman","Defensive Back"=>"Defensive Back"),

"Softball"=>array("Infielder"=>"Infielder","Outfielder"=>"Outfielder","Designated Hitter"=>"Designated Hitter","Catcher"=>"Catcher","Pitcher"=>"Pitcher"),

"Baseball"=>array("Infielder"=>"Infielder","Outfielder"=>"Outfielder","Designated Hitter"=>"Designated Hitter","Catcher"=>"Catcher","Pitcher"=>"Pitcher"),

"Basketball"=>array("Forward"=>"Forward","Guard"=>"Guard","Center"=>"Center"),

"Cardio Training"=>array("High Intensity Bouts"=>"High Intensity Bouts","Moderate Intensity"=>"Moderate Intensity","Low Intensity"=>"Low Intensity","Intervals"=>"Intervals","Tabatas"=>"Tabatas","Moderate Pace and Intensity"=>"Moderate Pace and Intensity","Fat Loss"=>"Fat Loss"),

"Swimming"=>array("Short Distance (&lt; 200m)"=>"Short Distance (&lt; 200m)","Middle Distance (200m - 500m)"=>"Middle Distance (200m - 500m)","Long Distance (&gt;500m)"=>"Long Distance (&gt;500m)"),

"Running"=>array("Long Distance (&gt; 800m)"=>"Long Distance (&gt; 800m)","Middle Distance (150m - 800m)"=>"Middle Distance (150m - 800m)","Sprints (30m - 100m)"=>"Sprints (30m - 100m)"),

"Field Hockey"=>array("Goalie"=>"Goalie","Defense"=>"Defense","Midfielder"=>"Midfielder","Striker"=>"Striker"),

"Gymnastics"=>array("Floor Exercise"=>"Floor Exercise","Balance Beam"=>"Balance Beam","Uneven Bars"=>"Uneven Bars","Vault"=>"Vault"),

"Ice Hockey"=>array("Goalie"=>"Goalie","Defense"=>"Defense","Forward"=>"Forward"),

"Lacrosse"=>array("Forward"=>"Forward","Defenseman"=>"Defenseman","Midfielder"=>"Midfielder","Goalie"=>"Goalie"),

"Snow Sports"=>array("Skiing - Cross Country"=>"Skiing - Cross Country","Skiing - Alpine"=>"Skiing - Alpine","Skiing - Ski Jumping"=>"Skiing - Ski Jumping"),

"Soccer"=>array("Forward"=>"Forward","Defenseman"=>"Defenseman","Midfielder"=>"Midfielder","Goalie"=>"Goalie"),

"Track and Field"=>array("Sprints (&lt; 400m)"=>"Sprints (&lt; 400m)","Middle Distance (400m - 30000m)"=>"Middle Distance (400m - 30000m)","Long Distance (&gt; 3000m)"=>"Long Distance (&gt; 3000m)","Jumping - High Jump"=>"Jumping - High Jump","Jumping - Triple Jump"=>"Jumping - Triple Jump","Jumping - Long Jump"=>"Jumping - Long Jump","Jumping - Pole Vault"=>"Jumping - Pole Vault","Throwing - Shotput"=>"Throwing - Shotput","Throwing - Javelin"=>"Throwing - Javelin","Throwing - Hammer"=>"Throwing - Hammer","Throwing - Discus"=>"Throwing - Discus"),

"Long Distance Event"=>array("Triathalon"=>"Triathalon","Marathon"=>"Marathon","Ultramarathon"=>"Ultramarathon","Iron Man"=>"Iron Man"),

"Volleyball"=>array("Outside Hitter"=>"Outside Hitter","Middle Blocker"=>"Middle Blocker","Setter"=>"Setter","Libero/Defensive Specialist"=>"Libero/Defensive Specialist"),

"Resistance Training"=>array("High Intensity"=>"High Intensity","Moderate Intensity"=>"Moderate Intensity","Low Intensity"=>"Low Intensity","Fat Loss"=>"Fat Loss","Circuit Training"=>"Circuit Training")

);

$posArr = array("No Position"=>"No Position");
$goal = array("Lose Weight"=>"Lose Weight","Maintain Weight"=>"Maintain Weight","Gain Weight"=>"Gain Weight");
$activityFactor = array("Very Heavy"=>"Very Heavy","Heavy"=>"Heavy","Moderate"=>"Moderate","Light"=>"Light","Sedentary"=>"Sedentary");
$myact = array(  
                "No Activity"=>"No Activity",
                "Bowling"=>"Bowling",
                "Boxing"=>"Boxing", 
                "CrossFit"=>"CrossFit",
                "Bodybuilding"=>"Bodybuilding",
                "Figure Skating"=>"Figure Skating",
                "Golf"=>"Golf",
                "Gymnastics"=>"Gymnastics",
                "Mixed Martial Arts"=>"Mixed Martial Arts",
                "Skiing - Downhill"=>"Skiing - Downhill",
                "Skiing - Cross Country"=>"Skiing - Cross Country",
                "Snowboarding"=>"Snowboarding",
                "Tennis"=>"Tennis",
                "Track and Field - Jumping Events"=>"Track and Field - Jumping Events",
                "Track and Field - Throwing Events"=>"Track and Field - Throwing Events",
                "Track and Field - Sprinting"=>"Track and Field - Sprinting",
                "Weightlifting"=>"Weightlifting",
                "Wrestling"=>"Wrestling",
                "American Football"=>"American Football",
                "Baseball"=>"Baseball",
                "Basketball"=>"Basketball",
                "Ice Hockey"=>"Ice Hockey",
                "Lacrosse"=>"Lacrosse",
                "Rugby"=>"Rugby",
                "Soccer"=>"Soccer",
                "Softball"=>"Softball",
                "Volleyball"=>"Volleyball",
                "Circuits"=>"Circuits",
                "Tempo"=>"Tempo",
                "Speed Training"=>"Speed Training",
                "Skateboarding" => "Skateboarding",
                "Yoga" => "Yoga",
                "Racquetball" => "Racquetball",
                "Badminton" => "Badminton",
                "Calisthetics" => "Calisthetics",
                "Frisbee" => "Frisbee",
                "Running" => "Running",
                "Rowing" => "Rowing",
                "Swimming" => "Swimming",
                "Biking" => "Biking",
                "Jogging" => "Jogging",
                "Weight Training for Performance"=>"Weight Training for Performance");

if($posArrTemp[esc_attr( get_the_author_meta( 'sports', $user->ID ))] != ''){
	$posArr = $posArrTemp[esc_attr( get_the_author_meta( 'sports', $user->ID ))];
}

?>

<!--*******************For Administrator**************-->

<?php if(($usr->roles[0] == "administrator" || $usr->roles[0] == "editor") && ($_SERVER['PATH_INFO'] != '/my-profile/')){?>

<table class="form-table">
<tbody>
<?php $value ?>
<tr>
	<th><label>Date of Birth</label></th>
	<td>
		<input id="datepicker" name="datepicker"  class="regular-text code" type="text" value="<?php if(esc_attr( get_the_author_meta( 'dob', $user->ID )) != ''){echo esc_attr( get_the_author_meta( 'dob', $user->ID ) );}else{ echo $_POST['datepicker'];} ?>" >
	</td>
</tr>
<tr>
    <th><label>Gender</label></th>
    <td>
        <input type="radio" name="gendertyp" id="gendertyp" value="Male" <?php if(esc_attr( get_the_author_meta( 'gendertyp', $user->ID ) ) == "Male"){echo "checked=checked";}elseif($_POST['gendertyp']=='Male'){echo "checked=checked";} ?>>&nbsp;Male
        <input type="radio" name="gendertyp" id="gendertyp" value="Female" <?php if(esc_attr( get_the_author_meta( 'gendertyp', $user->ID ) ) == "Female"){echo "checked=checked";}elseif($_POST['gendertyp']=='Female'){echo "checked=checked";}?>>&nbsp;Female                        
    </td>
</tr>        
<tr>
        <th><label>Activity</label></th>																
        <td><select id="myact" name="myact" <?php if($usr->roles[0] == "subscriber" || $usr->roles[0] == "editor"){?>class="small" <?php }else{?> class="regular-text code" <?php }?>>      
                    <?php foreach($myact as $k=>$v){?>
                            <option value="<?php echo $k;?>" <?php if(esc_attr( get_the_author_meta( 'myact', $user->ID ) ) == $k){echo "selected=selected";} ?>><?php echo $v;?></option>
                    <?php }?>					
            </select>
        </td>
</tr>
			
<tr>
        <th><label>My Goal</label></th>																
        <td>													  
            <select id="goal" name="goal" <?php if($usr->roles[0] == "subscriber" || $usr->roles[0] == "editor"){?>class="small" <?php }else{?> class="regular-text code" <?php }?>>
                <option value="">-Select-</option>
                <?php foreach($goal as $k=>$v){?>
                        <option value="<?php echo $k;?>" <?php if(esc_attr( get_the_author_meta( 'goal', $user->ID ) ) == $k){echo "selected=selected";} ?>><?php echo $v;?></option>
                <?php }?>					
            </select>
        </td>
</tr>
                     			
<tr>
        <th><label>General Activity Level</label></th>																
        <td>													
            <select id="activityFactor" name="activityFactor" <?php if($usr->roles[0] == "subscriber" || $usr->roles[0] == "editor"){?>class="small" <?php }else{?> class="regular-text code" <?php }?>>
                <option value="">-Select-</option>
                <?php foreach($activityFactor as $k=>$v){?>
                        <option value="<?php echo $k;?>" <?php if(esc_attr( get_the_author_meta( 'activityFactor', $user->ID ) ) == $k){echo "selected=selected";} ?>><?php echo $v;?></option>
                <?php }?>					
            </select>
            </td>
</tr>
<tr>
	<th><label>Height</label></th>
	<td>
            <input type="text" name="height" id="height" value="<?php if(esc_attr( get_the_author_meta( 'Height', $user->ID ) ) != ''){ echo esc_attr( get_the_author_meta( 'Height', $user->ID ) );}else{echo $_POST['height'];} ?>"  class="regular-text code"  maxlength="5" />
            <input type="radio" name="heighttyp" id="heighttyp" value="in" <?php if(esc_attr( get_the_author_meta( 'heighttyp', $user->ID ) ) == "in"){echo "checked=checked";}elseif($_POST['weighttyp']=='in'){echo "checked=checked";} ?>>&nbsp;in
            <input type="radio" name="heighttyp" id="heighttyp" value="cm" <?php if(esc_attr( get_the_author_meta( 'heighttyp', $user->ID ) ) == "cm"){echo "checked=checked";}elseif($_POST['weighttyp']=='cm'){echo "checked=checked";} ?>>&nbsp;cm
	</td>
</tr>
<tr>
	<th><label>Weight</label></th>
	<td>
	<input type="text" name="weight" id="weight" value="<?php if(esc_attr( get_the_author_meta( 'Weight', $user->ID ) ) != ''){ echo esc_attr( get_the_author_meta( 'Weight', $user->ID ) );}else{echo $_POST['weight'];} ?>" class="regular-text code" maxlength="5"  />
	
	<input type="radio" name="weighttyp" id="weighttyp" value="P" <?php if(esc_attr( get_the_author_meta( 'weighttyp', $user->ID ) ) == "P"){echo "checked=checked";}elseif($_POST['weighttyp']=="P"){echo "checked=checked";} ?>>&nbsp;lbs
        <input type="radio" name="weighttyp" id="weighttyp" value="K" <?php if(esc_attr( get_the_author_meta( 'weighttyp', $user->ID ) ) == "K"){echo "checked=checked";}elseif($_POST['weighttyp']=="P"){echo "checked=checked";} ?>>&nbsp;kgs
	</td>
</tr>

<tr>
	<th><label>Sports</label></th>

	<td>
	<select id="sports" name="sports" classif($posArrTemp[esc_attr( get_the_author_meta( 'sports', $user->ID ))] != ''){
="regular-text code">
                    <option value="">-Select-</option>
                    <?php foreach($sportArr as $k=>$v){?>
                            <option value="<?php echo $k;?>" <?php if(esc_attr( get_the_author_meta( 'sports', $user->ID ) ) == $k){echo "selected=selected";} ?>><?php echo $v;?></option>
<?php }?>					
        </select>
        </td>
</tr>

<tr>
	<th><label>Upload Avatar</label></th>
	<td>
	<input type="file" id="avtar" name="avtar" class="filestyle" data-buttonName="btn-primary" data-icon="false" data-buttonText="Browse" data-placeholder="Upload Avatar...">
	</td>
</tr>

<tr>
	<th><label>Position</label></th>
	<td>
	<select id="position" name="position" <?php if($usr->roles[0] == "subscriber" || $usr->roles[0] == "editor"){?>class="small" <?php }else{?> class="regular-text code" <?php }?>>				
				<option value="">-Select-</option>
					<?php foreach($posArr as $k=>$v){?>
						<option value="<?php echo $k;?>" <?php if(esc_attr( get_the_author_meta( 'position', $user->ID ) ) == $k){echo "selected=selected";}elseif($_POST['position'] == $k){echo "selected=selected";} ?>><?php echo $v;?></option>
					<?php }?>									
			</select>
	</td>
</tr>

</tbody>
</table>

<?php }else{?>

<!--*******************For user**************-->

<div class="row">															
        <div class="dfield1 col-md-6 col-sm-9 col-xs-18">
		<label>Name<span style="color:red;">*</span></label>
		<input type="text" name="nickname" id="nickname" value="<?php echo esc_attr( get_the_author_meta( 'nickname', $user->ID ) ); ?>" class="medium" maxlength="50" />		
	</div>	
    <div class="dfield2 col-md-6 col-sm-9 col-xs-18">
        <div>
			<label>Gender</label>					
		</div>	
        <input type="radio" name="gendertyp" id="gendertyp" value="Male" <?php if(esc_attr( get_the_author_meta( 'gendertyp', $user->ID ) ) == "Male"){echo "checked=checked";}elseif($_POST['gendertyp']=='Male'){echo "checked=checked";} ?>>&nbsp;Male
        <input type="radio" name="gendertyp" id="gendertyp" value="Female" <?php if(esc_attr( get_the_author_meta( 'gendertyp', $user->ID ) ) == "Female"){echo "checked=checked";}elseif($_POST['gendertyp']=='Female'){echo "checked=checked";}?>>&nbsp;Female                        
    </div>
    
</div>


<div class="row">
	
	<div class="dfield1 col-md-6 col-sm-9 col-xs-18">
		<div><label>Email<span style="color:red;">*</span></label></div>
		<div>
			<input type="email" name="email" id="email" value="<?php echo esc_attr( get_the_author_meta( 'user_email', $user->ID ) ); ?>" <?php if($usr->roles[0] == "subscriber" || $usr->roles[0] == "editor"){?>class="medium" <?php }else{?> class="regular-text code" <?php }?> maxlength="150" />
		</div>
	</div>
	
															
	<div class="dfield2 col-md-6 col-sm-9 col-xs-18">
		<div>
			<label>Date of Birth</label>						
		</div>														
		<div>
			<input id="datepicker" name="datepicker" <?php if($usr->roles[0] == "subscriber" || $usr->roles[0] == "editor"){?>class="small" <?php }else{?> class="regular-text code" <?php }?> type="text" value="<?php echo esc_attr( get_the_author_meta( 'dob', $user->ID ) ); ?>" >
		</div>
	</div>														
</div>

<div class="row">
	<div class="dfield1 col-md-6 col-sm-9 col-xs-18">
		<div><label>Password</label></div>														
		<div><input id="pass1" name="pass1" class="small" type="password" value="" maxlength="10"></div>
	</div>
															
	<div class="dfield2 col-md-6 col-sm-9 col-xs-18">
		<div><label>Repeat Password</label></div>														
		<div><input id="pass2" name="pass2" class="small" type="password" value="" maxlength="10"></div>
	</div>														
</div>

<div class="row">
	<div class="dfield1 col-md-6 col-sm-9 col-xs-18">
		<div>
			<label>Activity</label>			
		</div>														
			
			<div><select id="myact" name="myact" <?php if($usr->roles[0] == "subscriber" || $usr->roles[0] == "editor"){?>class="small" <?php }else{?> class="regular-text code" <?php }?>>					
					<?php foreach($myact as $k=>$v){?>
						<option value="<?php echo $k;?>" <?php if(esc_attr( get_the_author_meta( 'myact', $user->ID ) ) == $k){echo "selected=selected";} ?>><?php echo $v;?></option>
					<?php }?>					
				</select>
			</div>
	</div>
        <div class="dfield1 col-md-6 col-sm-9 col-xs-18">
		<div>
			<label>My Goal</label>			
		</div>																	
                <div style="">
                    <select id="goal" name="goal" <?php if($usr->roles[0] == "subscriber" || $usr->roles[0] == "editor"){?>class="small" <?php }else{?> class="regular-text code" <?php }?>>
                        <option value="">-Select-</option>
                        <?php foreach($goal as $k=>$v){?>
                                <option value="<?php echo $k;?>" <?php if(esc_attr( get_the_author_meta( 'goal', $user->ID ) ) == $k){echo "selected=selected";} ?>><?php echo $v;?></option>
                        <?php }?>					
                    </select>
                     
                </div>               		
	</div>
</div>

<div class="row">
	<div class="dfield1 col-md-6 col-sm-9 col-xs-18">
		<div>
			<label> General Activity Level </label>			
		</div>														
			
			<div><select id="activityFactor" name="activityFactor" <?php if($usr->roles[0] == "subscriber" || $usr->roles[0] == "editor"){?>class="small" <?php }else{?> class="regular-text code" <?php }?>>
					<option value="">-Select-</option>
					<?php foreach($activityFactor as $k=>$v){?>
						<option value="<?php echo $k;?>" <?php if(esc_attr( get_the_author_meta( 'activityFactor', $user->ID ) ) == $k){echo "selected=selected";} ?>><?php echo $v;?></option>
					<?php }?>					
				</select>
			</div>
	</div> 
        															
	<div class="dfield2 col-md-6 col-sm-9 col-xs-18">		
		<label>&nbsp;</label>		
		<div><input type="file" id="avtar" name="avtar" class="filestyle" data-buttonName="btn-primary" data-icon="false" data-buttonText="Browse" data-placeholder="Upload Avatar..."><br></div>
	</div>	
</div>

<div class="row">
	<div class="dfield1 col-md-6 col-sm-9 col-xs-18">
		<div>
			<label>Height</label>					
		</div>			
		<div>			
                        <input type="text" name="height" id="height" value="<?php echo esc_attr( get_the_author_meta( 'Height', $user->ID ) ); ?>" <?php if($usr->roles[0] == "subscriber" || $usr->roles[0] == "editor"){?> style="background-color: #f9f9f9;border: 2px solid #eee;margin-bottom: 12px;padding: 7px 12px; width:50%" <?php }else{?> class="regular-text code" <?php }?> maxlength="5"  />
                        <input type="radio" name="heighttyp" id="heighttyp" value="in" <?php if(esc_attr( get_the_author_meta( 'heighttyp', $user->ID ) ) == "in"){echo "checked=checked";}elseif($_POST['weighttyp']=='in'){echo "checked=checked";} ?>>&nbsp;in
                        <input type="radio" name="heighttyp" id="heighttyp" value="cm" <?php if(esc_attr( get_the_author_meta( 'heighttyp', $user->ID ) ) == "cm"){echo "checked=checked";}elseif($_POST['weighttyp']=='cm'){echo "checked=checked";} ?>>&nbsp;cm
		
		</div>
	</div>
															
	<div class="dfield2 col-md-6 col-sm-9 col-xs-18">
		<div>
			<label>Weight</label>					
		</div>														
		<div>
			<input type="text" name="weight" id="weight" value="<?php echo esc_attr( get_the_author_meta( 'Weight', $user->ID ) ); ?>" <?php if($usr->roles[0] == "subscriber" || $usr->roles[0] == "editor"){?> style="background-color: #f9f9f9;border: 2px solid #eee;margin-bottom: 12px;padding: 7px 12px; width:50%" <?php }else{?> class="regular-text code" <?php }?> maxlength="5"  />
			<input type="radio" name="weighttyp" id="weighttyp" value="P" <?php if(esc_attr( get_the_author_meta( 'weighttyp', $user->ID ) ) == "P"){echo "checked=checked";}elseif($_POST['weighttyp']=='P'){echo "checked=checked";} ?>>&nbsp;lbs
			<input type="radio" name="weighttyp" id="weighttyp" value="K" <?php if(esc_attr( get_the_author_meta( 'weighttyp', $user->ID ) ) == "K"){echo "checked=checked";}elseif($_POST['weighttyp']=='K'){echo "checked=checked";} ?>>&nbsp;kgs
		</div>
	</div>	
</div>

<div class="row">
	<div class="dfield1 col-md-6 col-sm-9 col-xs-18">
		<div>
			<label>Sports</label>			
		</div>														
			
			<div><select id="sports" name="sports" <?php if($usr->roles[0] == "subscriber" || $usr->roles[0] == "editor"){?>class="small" <?php }else{?> class="regular-text code" <?php }?>>
					<option value="">-Select-</option>
					<?php foreach($sportArr as $k=>$v){?>
						<option value="<?php echo $k;?>" <?php if(esc_attr( get_the_author_meta( 'sports', $user->ID ) ) == $k){echo "selected=selected";} ?>><?php echo $v;?></option>
					<?php }?>					
				</select>
			</div>
	</div>
        <div class="dfield2 col-md-6 col-sm-9 col-xs-18">
	<div>
		<label>Position</label>
	</div>														
		<div>
			<select id="position" name="position" <?php if($usr->roles[0] == "subscriber" || $usr->roles[0] == "editor"){?>class="small" <?php }else{?> class="regular-text code" <?php }?>>				
				<option value="">-Select-</option>
					<?php foreach($posArr as $k=>$v){?>
						<option value="<?php echo $k;?>" <?php if(esc_attr( get_the_author_meta( 'position', $user->ID ) ) == $k){echo "selected=selected";} ?>><?php echo $v;?></option>
					<?php }?>									
			</select>
		</div>															
	</div>	
													
</div>

<?php $selectedAf = get_the_author_meta( 'activityFactor', $user->ID);
?>

<?php }}

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
add_action( 'user_register', 'save_extra_user_profile_fields' );



function save_extra_user_profile_fields( $user_id ) {

if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

update_user_meta( $user_id, 'nickname', $_POST['nickname'] );
update_user_meta( $user_id, 'dob', $_POST['datepicker'] );
update_user_meta( $user_id, 'Height', $_POST['height'] );
update_user_meta( $user_id, 'Weight', $_POST['weight'] );
update_user_meta( $user_id, 'weighttyp', $_POST['weighttyp'] );
update_user_meta( $user_id, 'sports', $_POST['sports'] );
update_user_meta( $user_id, 'position', $_POST['position'] );
update_user_meta( $user_id, 'Age', $_POST['age'] );
//added user metadata for goal , activity , height type ,gender and activity factor
update_user_meta( $user_id, 'goal', $_POST['goal'] ); 
//update_user_meta( $user_id, 'goal_type', 1);
update_user_meta( $user_id, 'myact', $_POST['myact'] ); 
update_user_meta( $user_id, 'heighttyp', $_POST['heighttyp'] );
update_user_meta( $user_id, 'gendertyp', $_POST['gendertyp'] );
update_user_meta( $user_id, 'activityFactor', $_POST['activityFactor'] );

require_once( ABSPATH . 'wp-admin/includes/file.php' );


if($_FILES["avtar"]["name"] != ''){
	$uploadedfile = $_FILES["avtar"];
	$upload_overrides = array( 'test_form' => false );
	$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );	
	update_user_meta( $user_id, 'AvatarImg', $movefile['url']);
}

if($_FILES["bannerfl"]["name"] != ''){
	$uploadedfile1 = $_FILES["bannerfl"];
	$upload_overrides1 = array( 'test_form' => false );
	$movefile1 = wp_handle_upload( $uploadedfile1, $upload_overrides1 );
	update_user_meta( $user_id, 'BannerImg', $movefile1['url']);
}

}

/*********************************************************************/

/*For adding the capability*/
function add_capability() {
	global $menu,$submenu;
	
    // gets the author role
    $role = get_role( 'editor' );
    //print_r($role);
    // This only works, because it accesses the class instance.
    $role->add_cap( 'list_users' );
    $role->add_cap( 'edit_users' ); 
    $role->add_cap( 'create_users' ); 
    $role->add_cap( 'delete_users' );     
    $role->add_cap( 'edit_theme_options' ); 
    
    if (!current_user_can('administrator')) { 
		remove_submenu_page( 'themes.php', 'themes.php' ); // hide the theme selection submenu
		remove_submenu_page( 'themes.php', 'widgets.php' ); // hide the widgets submenu
		remove_submenu_page( 'themes.php', 'customize.php' );
		remove_submenu_page( 'themes.php', 'customize.php?return=%2Fshakebotwp%2Fwp-admin%2Fnav-menus.php');            
		remove_submenu_page( 'themes.php', 'customize.php?return=%2Fshakebotwp%2Fwp-admin%2F');        
		remove_submenu_page( 'themes.php', 'customize.php?return=%2Fshakebotwp%2Fwp-admin%2F');	
		remove_submenu_page( 'themes.php', 'customize.php?return=%2Fshakebotwp%2Fwp-admin%2Findex.php');			      	      
		remove_submenu_page( 'themes.php', 'customize.php?return=%2Fshakebotwp%2Fwp-admin%2Fnav-menus.php');	
		remove_submenu_page( 'themes.php', $submenu['themes.php'][6][2]);		      
		remove_submenu_page( 'themes.php', 'optionsframework' );
	}
    
    
}
add_action( 'admin_init', 'add_capability');


/** Hide Administrator From User List **/
function isa_pre_user_query($user_search) {
  $user = wp_get_current_user();
  if (!current_user_can('administrator')) { // Is Not Administrator - Remove Administrator
    global $wpdb;

    $user_search->query_where = 
        str_replace('WHERE 1=1', 
            "WHERE 1=1 AND {$wpdb->users}.ID IN (
                 SELECT {$wpdb->usermeta}.user_id FROM $wpdb->usermeta 
                    WHERE {$wpdb->usermeta}.meta_key = '{$wpdb->prefix}capabilities'
                    AND {$wpdb->usermeta}.meta_value NOT LIKE '%administrator%')", 
            $user_search->query_where
        );
  }
}
add_action('pre_user_query','isa_pre_user_query');

/*********************** Ajax Call Starts **********************************/
// add javascript reference to wp-load.php as ajaxurl
function core_add_ajax_url(){
    ?>
    <script type="text/javascript">var ajaxurl = "<?php echo site_url( 'wp-load.php' ); ?>";</script>
    <?php 
}
add_action('wp_head', 'core_add_ajax_url', 1 );

// process all wp_ajax_* calls
function core_add_ajax_hook() {
    /* Theme only, we already have the wp_ajax_ hook firing in wp-admin */
    if ( !defined( 'WP_ADMIN' ) && isset($_REQUEST['action']) ){
        do_action( 'wp_ajax_' . $_REQUEST['action'] );
    }
}
add_action( 'init', 'core_add_ajax_hook' );

add_filter('manage_posts_columns', 'my_columns');
function my_columns($columns) {
    $columns['views'] = 'Views';
    return $columns;
}

add_action('manage_posts_custom_column',  'my_show_columns');
function my_show_columns($name) {
    global $post;
    switch ($name) {
        case 'views':
            $views = get_post_meta($post->ID, 'views', true);
            echo $views;
    }
}


$GLOBALS['veryheavy'] = 'Very Heavy';
$GLOBALS['heavy'] = 'Heavy';
$GLOBALS['moderate'] = 'Moderate';
$GLOBALS['light'] = 'Light';
$GLOBALS['sedentary'] = 'Sedentary';
$GLOBALS['afactor'] = array($veryheavy=>"1.25",$heavy=>"1.2",$moderate=>"1.15",$light=>"1.1",$sedentary=>"1.05");
$GLOBALS['selectedAf'] = get_the_author_meta( 'activityFactor', $user->ID); 

// Hook your function to the 'wp_ajax_*' for processing
function categoryAjax(){
    
	$category_ids = get_all_category_ids();
	rsort($category_ids);
            
	$categoryArr = array();
	$temp = array();
	$parentCat = $subParentCat = $activity = array();

	foreach($category_ids as $cat_id) {
	  
	  $cat_name = get_cat_name($cat_id);
	  $tem = get_category_parents($cat_id);
	  $temp[$cat_id] = explode('/',$tem);
	  $temp[$cat_id]["CatName"] = $cat_name;
	  $temp[$cat_id]["CatNiceName"] = $yourcat->slug;
	  
	}


	$i = 0;
	foreach($temp as $ky => $vl){
		
		$categoryArr[$i]['categoryId'] = $ky; 
		$categoryArr[$i]['categoryName'] = $temp[$ky]["CatName"];
		$categoryArr[$i]['categoryNiceName'] = $temp[$ky]["CatNiceName"];
		$categoryArr[$i]['parentCat'] = $temp[$ky][0]; 
		$categoryArr[$i]['subParentCat'] = $temp[$ky][1]; 
		$categoryArr[$i]['activity'] = $temp[$ky][2];
		
		if(trim($temp[$ky][1]) == ''){ //For parent
			$categoryArr[$i]['type'] = 1;
		}
                else{
			$categoryArr[$i]['type'] = 3; //For activity
		}
		
		$i++;
	}

	krsort($categoryArr);
        
 	if($_GET['whateveract'] == ''){
		callTheForm($categoryArr, $_GET['nutri']);
	}else{
		callTheFormAct($categoryArr, $_GET['whateveract']);
	}
	
}

function callTheFormAct($categoryArr, $ty){ ?>
		<div class="select2-wrapper">
			<select class="form-control input-lg select2" id="activitiesdif">
				<option></option>
				<?php
                                foreach($categoryArr as $k=>$v){
					if($categoryArr[$k]['type'] == 3 ){?>
					<option value="<?php echo $categoryArr[$k]['categoryId'];?>"><?php echo $categoryArr[$k]['categoryName'];?></option>
					<?php }}?>
			</select>
		</div>
<?php }

function callTheForm($categoryArr,$nutri){ 
    global $wpdb;
    global $current_user, $wp_roles;
    $currentUserId = $current_user->id;
    $selqry = "select id,user_id,duration_type from wp_nutri_calculation WHERE DATE( addedon ) = CURDATE() AND user_id = $currentUserId ORDER BY id DESC LIMIT 1";
    $resultstemp = $wpdb->get_results($selqry);

        $categoryArr = array_values($categoryArr);
	$ind = 0;
	$getValPass = array();
	$getValPass = explode("#@#@#",$_GET['nutri']);
        
        ?>
	
	<div class="container-fluid">
	<div class="row">															
			<?php foreach($categoryArr as $k=>$v){
				if($categoryArr[$k]['type'] == 2 && $ind<5){ $ind++; ?>					
                                        <input id="sub<?php echo $ind;?>" name="sub<?php echo $ind;?>" type="button" value="<?php echo $categoryArr[$k]['categoryName'];?>" <?php if($getValPass[6] == $categoryArr[$k]['categoryName']){echo "class=pbSubmit2";} else {echo "class=pbSubmit1";}?> style=" color:#fff; text-align:center" onmouseup="javascript:$('#sub<?php echo $ind;?>').trigger('click');"><br /><br /><br />
			<?php }} ?>
			<input type="hidden" name="catCountHd" id="catCountHd" value="<?php // echo $ind;?>">
			<input type="hidden" name="catValHd" id="catValHd" value="<?php echo $getValPass[6];?>">
                        
                <div class="dfield1 col-md-6 col-sm-9 col-xs-18"><br /><br />
                    <div class="row" >
                        <div><label>Exercise Intensity<span style="color:red">*</span></label></div>	
                        <input type="radio" name="nutIntensitytyp" id="nutIntensitytyp" value="High" 
                        <?php if($getValPass[10] == 'High'){echo ("checked=checked");} ?>
                         >&nbsp;High
                        <input type="radio" name="nutIntensitytyp" id="nutIntensitytyp" value="Medium" 
                        <?php if($getValPass[10] == 'Medium'){echo ("checked=checked");} ?> 
                        >&nbsp;Medium
                        <input type="radio" name="nutIntensitytyp" id="nutIntensitytyp" value="Low" 
                        <?php if($getValPass[10] == 'Low'){echo ("checked=checked");} ?> 
                        >&nbsp;Low                          
                    </div>          
                    <div class="row" style="margin-top:40px">                    
                        <div>
                            <div><label>Gender<span style="color:red">*</span></label></div>														
                            <div>						
                                    <input type="radio" name="genderTyp" id="genderTyp" value="male" 
                                    <?php if($getValPass[11] == 'male'){echo ("checked=checked");} ?>
                                     >&nbsp;Male
                                    <input type="radio" name="genderTyp" id="genderTyp" value="female" 
                                    <?php if($getValPass[11] == 'female'){echo ("checked=checked");} ?> 
                                    >&nbsp;Female
                            </div>
			</div>                     
                    </div>         
		</div>

		<div class="dfield2 col-md-6 col-sm-9 col-xs-18"><br /><br />
			<div><label>Activity<span style="color:red">*</span></label></div>														
				<div id="activitiesSpan"> 					
					<div class="select2-wrapper">
                                                <select class="form-control input-lg select2" id="activitiesdif">
                                                        <?php 
                                                        foreach($categoryArr as $k=>$v){
								if($getValPass[6] != ''){
								if($categoryArr[$k]['type'] == 3 && $categoryArr[$k]['subParentCat'] == $getValPass[6]){?>
									<option value="<?php echo $categoryArr[$k]['categoryId'];?>" <?php if($getValPass[1] == $categoryArr[$k]['categoryId']||$categoryArr[$k]['categoryName'] == (get_the_author_meta( 'myact', $current_user->ID)) ){ echo ("selected=selected");} ?>><?php echo $categoryArr[$k]['categoryName'];?></option>
							<?php }}else{
								if($categoryArr[$k]['type'] == 3){?>
									<option value="<?php echo $categoryArr[$k]['categoryId'];?>" <?php if($getValPass[1] == $categoryArr[$k]['categoryId']||$categoryArr[$k]['categoryName'] == (get_the_author_meta( 'myact', $current_user->ID)) ){ echo ("selected=selected");} ?>><?php echo $categoryArr[$k]['categoryName'];?></option>
							<?php }}} ?>
						</select>
					</div>
					
				</div>
			</div>														
		</div> 
            
            <div class="row" style="margin-top:20px">                          
                <div class="dfield1 col-md-6 col-sm-9 col-xs-18"><br /><br />
                    <div class="row" >
                        <div><label>General Activity Level<span style="color:red">*</span></label></div>	
                            <div class="select2-wrapper">                                    
                                    <?php if(is_user_logged_in()){?>                                                
                                        <select class="form-control input-lg select2" id="generalActivityLevel">
                                                <option value="Very Heavy" <?php  echo (get_the_author_meta( 'activityFactor', $current_user->ID) == 'Very Heavy') ? "selected=selected" : ''?> >Very Heavy</option>
                                                <option value="Heavy" <?php  echo (get_the_author_meta( 'activityFactor', $current_user->ID) == 'Heavy') ? "selected=selected" : ''?>>Heavy</option>
                                                <option value="Moderate" <?php  echo (get_the_author_meta( 'activityFactor', $current_user->ID) == 'Moderate') ? "selected=selected" : ''?>>Moderate</option>
                                                <option value="Light" <?php  echo (get_the_author_meta( 'activityFactor', $current_user->ID) == 'Light') ? "selected=selected" : ''?>>Light</option>
                                                <option value="Sedentary" <?php  echo (get_the_author_meta( 'activityFactor', $current_user->ID) == 'Sedentary') ? "selected=selected" : ''?> >Sedentary</option>
                                        </select>
                                                
                                    <?php }else{ ?>
                                
                                        <select class="form-control input-lg select2" id="generalActivityLevel">
                                                <option value="Very Heavy">Very Heavy</option>
                                                <option value="Heavy">Heavy</option>
                                                <option value="Moderate" selected>Moderate</option>
                                                <option value="Light">Light</option>
                                                <option value="Sedentary" >Sedentary</option>
                                        </select>
                                     <?php } ?>
                            </div>                     
                    </div> 
                </div>
                <div class="dfield2 col-md-6 col-sm-9 col-xs-18">
                    
                </div>
            </div>

		<div class="row" style="margin-top:60px">
			<div class="dfield1 col-md-6 col-sm-9 col-xs-18">
				<div><label>My Weight<span style="color:red">*</span></label></div>														
					<div>                                                
						<input id="nutWeight" name="nutWeight" class="medium" type="text" value="<?php echo($getValPass[2]);?>" maxlength="5"><br />
                                                <?php if(is_user_logged_in()){?>
                                                <input type="radio" name="nutWeighttyp" id="nutWeighttyp" value="P" 
						<?php if(get_the_author_meta( 'weighttyp', $current_user->ID) == 'P'){echo ("checked=checked");} ?>
						 >&nbsp;lbs
						<input type="radio" name="nutWeighttyp" id="nutWeighttyp" value="K" 
						<?php if(get_the_author_meta( 'weighttyp', $current_user->ID) == '') {echo ("checked=checked");}
                                                else if(get_the_author_meta( 'weighttyp', $current_user->ID) == 'K') {echo ("checked=checked");} 
						?> 
						>&nbsp;kgs
                                                
                                                <?php }else{ ?>
						<input type="radio" name="nutWeighttyp" id="nutWeighttyp" value="P" 
						<?php if($getValPass[3] == 'P'){echo ("checked=checked");} ?>
						 >&nbsp;lbs
						<input type="radio" name="nutWeighttyp" id="nutWeighttyp" value="K" 
						<?php if($getValPass[3] == '') {echo ("checked=checked");} 
						else if($getValPass[3] == 'K'){echo ("checked=checked");} ?> 
						>&nbsp;kgs
                                                <?php } ?>
					</div>
			</div>
															
			<div class="dfield2 col-md-6 col-sm-9 col-xs-18">
				<div><label>Exercise Duration<span style="color:red">*</span></label></div>														
					<div>
                                                <input id="nutDuration" name="nutDuration" class="medium" type="text" value="<?php echo($getValPass[4]);?>" maxlength="5"><br />
                                                <?php if(is_user_logged_in()){?>
                                                <input type="radio" name="nutDurationtyp" id="nutDurationtyp" value="M" 
						<?php if($resultstemp[0]->duration_type == 'M'){echo ("checked=checked");} ?>
						 >&nbsp;mins
						<input type="radio" name="nutDurationtyp" id="nutDurationtyp" value="H"
						<?php if($resultstemp[0]->duration_type == ''){echo ("checked=checked");}
                                                else if($resultstemp[0]->duration_type == 'H') {echo ("checked=checked");} 
						?> 
						>&nbsp;hours
                                                
                                                <?php }else{ ?>
						
						<input type="radio" name="nutDurationtyp" id="nutDurationtyp" value="M" 
						<?php if($getValPass[5] == 'M'){echo ("checked=checked");} ?>
						 >&nbsp;mins
						<input type="radio" name="nutDurationtyp" id="nutDurationtyp" value="H" 
						<?php if($getValPass[5] == '') {echo ("checked=checked");}
						else if($getValPass[5] == 'H'){echo ("checked=checked");} ?> 
						>&nbsp;hours
                                                <?php } ?>
					</div>
			</div>														
		</div>	
            
                <div class="row" style="margin-top:20px">
                        <div class="dfield1 col-md-6 col-sm-9 col-xs-18">
				<div><label>My Age<span style="color:red">*</span></label></div>														
					<div>                                            
                                                <?php 
                                                $dob = get_the_author_meta( 'dob', $current_user->ID);
                                                if(is_user_logged_in()){                                                                                                                                                  
                                                    if (isset($dob) && $dob != ''){
                                                    $arr = explode('/',$dob);
                                                    $var1 = $arr[2]."/".$arr[1]."/".$arr[0]." 00:00:00";
                                                    $var2 = date('Y/m/d 00:00:00');
                                                    $datetime1 = new DateTime($var1);
                                                    $datetime2 = new DateTime($var2);
                                                    $res = $datetime2->diff($datetime1);}
                                                    ?>
                                            <input id="nutAge" name="nutAge" class="medium" type="text" value="<?php echo $res->y;?>" maxlength="5"><br />			
                                              &nbsp;years      
                                               <?php }else{
                                                    ?>
						<input id="nutAge" name="nutAge" class="medium" type="text" value="<?php echo($getValPass[7]);?>" maxlength="5"><br />			
						&nbsp;years
                                                <?php } ?>
					</div>
			</div>
                        <div class="dfield2 col-md-6 col-sm-9 col-xs-18">
				<div><label>My Height<span style="color:red">*</span></label></div>														
					<div>
                                                
                                                <?php if(is_user_logged_in()){?>
                                                <input id="nutHeight" name="nutHeight" class="medium" type="text" value="<?php echo(get_the_author_meta( 'Height', $current_user->ID)) ;?>" maxlength="5"><br />
                                                <input type="radio" name="nutHeighttyp" id="nutHeighttyp" value="in" 
						<?php if(get_the_author_meta( 'heighttyp', $current_user->ID) == 'in'){echo ("checked=checked");} ?>
						 >&nbsp;in
						<input type="radio" name="nutHeighttyp" id="nutHeighttyp" value="cm"
                                                <?php if(get_the_author_meta( 'heighttyp', $current_user->ID) == '') {echo ("checked=checked");} 
                                                else if(get_the_author_meta( 'heighttyp', $current_user->ID) == 'cm') {echo ("checked=checked");}
						?> 
						>&nbsp;cm
                                                                                        
                                                <?php }else{ ?>
                                            
						<input id="nutHeight" name="nutHeight" class="medium" type="text" value="<?php echo($getValPass[8]);?>" maxlength="5"><br />
						<input type="radio" name="nutHeighttyp" id="nutHeighttyp" value="in" 
						<?php if($getValPass[9] == 'in'){echo ("checked=checked");} ?>
						 >&nbsp;in
						<input type="radio" name="nutHeighttyp" id="nutHeighttyp" value="cm" 
						<?php if($getValPass[9] == '') {echo ("checked=checked");}
						else if($getValPass[9] == 'cm'){echo ("checked=checked");} ?> 
						>&nbsp;cm
                                            <?php }?>
					</div>
			</div> 
                </div>            
													
		<div class="row" style="margin-top:20px; border:0px solid green;">														
			<div style="border:0px solid blue; ">                            
                                <div  style="border:0px solid blue;">
                                    <input id="nutCallBtn" name="nutCallBtn" type="button" value="CALCULATE" class="pbSubmit" style="width:20%;" disabled>
                                    </div> 
                                <div style="border:0px solid blue;">
                                    <input id="addToActivityBtn" name="addToActivityBtn" type="button" value="ADD TO MY ACTIVITIES" class="pbSubmit" style="background: none repeat scroll 0 0 #00ADE7; color:#fff;margin-left:15px; width:36%">
                               </div>                                 
                            <div class="col-md-12" style="border:0px solid blue;">    
                                    <?php if ( is_user_logged_in() ) { ?>
                                           <input id="submitCal" name="submitCal" type="button" value="SAVE TO MY PROFILE" class="pbSubmit3" style="" disabled><!-- disabled> -->
                                                 
                                    <?php }else{ ?>
                                             <input id="bfrlogin" name="bfrlogin" type="button" value="SAVE TO MY PROFILE" class="pbSubmit3" style="margin-left: 15px;cursor: not-allowed; width:35%" data-toggle="tooltip" data-placement="top" title="You must log in to save the details.">
                                                  
                                    <?php } ?>
                                </div>     
                                
			</div>                        
		</div><br /><br />
													
	</div>

<?php }

add_action( 'wp_ajax_categoryAjax', 'categoryAjax' );


//Nutrition calculation AJAX starts

//For getting the calculation category type
function getCalculationCat($disCat){
	$catid = $yourcat = $tmp = '';
	$yourcat = get_category($disCat);	  	 
	$tmp = explode("-",$yourcat->slug);

	return $tmp[0];
}

//For getting the post excersice
function getPostEx($calCat, $wgt){ 
	$postExContArr = array(
						"RHI"=>array("fat"=>"0.01","pro"=>"0.3","carb"=>"0.8","bcaa"=>"0.05"),
						"ENDURANCE"=>array("fat"=>"0.01","pro"=>"0.3","carb"=>"1.2","bcaa"=>"0.05"),
						"SKILL"=>array("fat"=>"0.01","pro"=>"0.3","carb"=>"0.3","bcaa"=>"0.05")
					);
	$postExContTotArr = array('4','9','4');
	$tempExContArr = array();
	$returnArr = array();
	
	$tempExContArr = $postExContArr[strtoupper($calCat)];
        $fat = $wgt * $tempExContArr["fat"];
        $pro = $wgt * $tempExContArr["pro"];
        $carb = $wgt * $tempExContArr["carb"];
	
	$returnArr["Fat"] = round($fat);
	$returnArr["Protein"] = round($pro);
	$returnArr["Carbohydrate"] = round($carb);
	$returnArr["BCAA"] = round($wgt * $tempExContArr["bcaa"]);	
	$returnArr["Calories"] = round(( $pro * $postExContTotArr[0] ) + ( $fat * $postExContTotArr[1] ) + ( $carb * $postExContTotArr[2] ));
	//echo"came";print_r($calCat);print_r($wgt);
	return $returnArr;
	
}
//Weight calculation
function wegBaseType($wt,$ty){
	$kl = 0;	
	if($ty == 'P'){
		$kl = $wt / 2.20462;
	}else{
		$kl = $wt;
	}	
	//$kl = round($kl);
	return $kl;
}

//Time calculation
function hrBaseType($h,$ty){
	$hrs = 0;	
	if($ty == 'M'){
		$hrs = $h / 60;
	}else{
		$hrs = $h;
	}	
	//$hrs = round($hrs);
	return $hrs;
}

//Height calculation
function inchBaseType($c,$ty){
	$inch = 0;	
	if($ty == 'in'){
		$inch = $c * 2.54;
	}else{
		$inch = $c;
	}	
	//$inch = round($inch);
	return $inch;
}

//function maintainWeightAlgo($passArr , $activityCategory , $af,$met,$currentDurationInMins,$longerDuration,$postexwt,$postexwtType){ 
function maintainWeightAlgo($passArr , $activityCategory , $af,$met,$currentDurationInMins,$longerDuration,$postexwt){ 
	$callArr = $postEx = $todayNd = array();
	$calCat = '';
        $longestDuration = '';
        
        $age = $passArr->age;
        $intensity = $passArr->intensity_type; 
        $gender = $passArr->gender;    
        
        //Height calculation
	$height = 0;
	$height = inchBaseType($passArr->height,$passArr->height_type);
        
	//Weight calculation
	$kg = 0;
	$kg = wegBaseType($passArr->weight,$passArr->weight_type);
        //$durationBasedKg = wegBaseType($postexwt,$postexwtType);
	
	//hour calculation
	$hr = 0;
	$hr = hrBaseType($passArr->duration,$passArr->duration_type);
	
	
	$calCat = getCalculationCat($passArr->activity); //For getting the calculation category
        $goal = 'maintain weight';
        $nacal = calculateNoActivities($kg ,$height , $age , $af ,$gender);
        $ecal = exerciseCalories($kg, $met , $hr);        
        $tcal = totalCalories($nacal ,$ecal);//1        
        $pcal = proteinCalories($goal, $activityCategory, $kg);//3
        $ccal = carbohydrateCalories($goal,$activityCategory, $tcal, $pcal);//2
        $fcal = fatCalories($goal, $tcal, $pcal, $ccal);//4
        $pgram = $pcal/4;
        $cgram = $ccal/4;
        $fgram = $fcal/9;       

        $todayNd['Calories'] = round($tcal) ;	
	$todayNd['Protein'] = round($pgram);
	$todayNd['Carbohydrate'] = round($cgram);
	$todayNd['Fat'] = round($fgram);       
        
        //For getting the post excersice
        if($currentDurationInMins > $longerDuration){
                $longestDuration = $currentDurationInMins;                 
                $postEx = getPostEx($calCat,$kg); 
            }else{
                $longestDuration = $longerDuration; 
               $postEx = getPostEx($activityCategory,$postexwt);
//               $postEx = getPostEx($activityCategory,$durationBasedKg);
            }        
        $postEx["calCat"] = $calCat;
        
	$callArr['postEx'] = $postEx; //Post Exercise
	$callArr['today_needs'] = $todayNd; //Today Need

	return $callArr;
}

//function lossWeightAlgo($passArr , $activityCategory , $af ,$met,$currentDurationInMins,$longerDuration,$postexwt,$postexwtType){
function lossWeightAlgo($passArr , $activityCategory , $af ,$met,$currentDurationInMins,$longerDuration,$postexwt){
    
	$callArr = $postEx = $todayNd = array();
	$calCat = '';
        $age = $passArr->age;
        $intensity = $passArr->intensity_type; 
        $gender = $passArr->gender;    
        
        //Height calculation
	$height = 0;
	$height = inchBaseType($passArr->height,$passArr->height_type);
        
	//Weight calculation
	$kg = 0;
	$kg = wegBaseType($passArr->weight,$passArr->weight_type);
        //$durationBasedKg = wegBaseType($postexwt,$postexwtType);
	
	//hour calculation
	$hr = 0;
	$hr = hrBaseType($passArr->duration,$passArr->duration_type);
	
	
	$calCat = getCalculationCat($passArr->activity); //For getting the calculation category
        
        //new calc
        $goal = 'lose weight';
        $nacal = calculateNoActivities($kg , $height ,$age,$af , $gender);
        $ecal = exerciseCalories($kg, $met , $hr);       
        $lwnacal2 = noactivityCalories($kg);
        $lwtcal2 = $lwnacal2;
        $lwpcal2 = $lwtcal2 * 0.1;
        $lwccal2 = carbohydrateCalorine($goal, $activityCategory, $lwtcal2);
        $lwfcal2 = fatCalorine($goal, $activityCategory, $lwtcal2);
        $lwpgram2 = $lwpcal2 / 4;
        $lwcgram2 = $lwccal2 / 4;
        $lwfgram2 = $lwfcal2 / 9;  
        $lwnacal = $nacal;
        $lwecal = $ecal;        
        $tcal = totalCalories($nacal ,$ecal);
        $pcal = proteinCalories($goal, $activityCategory, $kg);//3
        $ccal = carbohydrateCalories($goal,$activityCategory, $tcal, $pcal);//2        
        $fcal = fatCalories($goal, $tcal, $pcal, $ccal);//4
        $lwpcal = $pcal - $lwpcal2;
        $lwccal = $ccal - $lwccal2;           
        $lwfcal = $fcal - $lwfcal2;
        $lwpgram = $lwpcal/4;
        $lwcgram = $lwccal/4;
        $lwfgram = $lwfcal/9;    
        
        if($gender == 'male' && $activityCategory == 'rhi'){
            $lwtcal =  ($nacal + $ecal - $lwtcal2);
        }else{
            $lwtcal =  ($nacal + $ecal + $lwtcal2);
        }

        $todayNd['Calories'] = round($lwtcal) ;	
	$todayNd['Protein'] = round($lwpgram);
	$todayNd['Carbohydrate'] = round($lwcgram);
	$todayNd['Fat'] = round($lwfgram);
        
        //For getting the post excersice
        if($currentDurationInMins > $longerDuration){
                $longestDuration = $currentDurationInMins;                 
                $postEx = getPostEx($calCat,$kg); //user input
            }else{
                $longestDuration = $longerDuration;
               //$postEx = getPostEx($activityCategory,$durationBasedKg); //db
                 $postEx = getPostEx($activityCategory,$postexwt);
//               $postEx = getPostEx($activityCategory,$durationBasedKg);
            }        
        $postEx["calCat"] = $calCat;
        
	$callArr['postEx'] = $postEx; //Post Exercise
	$callArr['today_needs'] = $todayNd; //Today Need
	
	return $callArr;
}

//function gainWeightAlgo($passArr , $activityCategory , $af,$met,$currentDurationInMins,$longerDuration,$postexwt,$postexwtType){ 
function gainWeightAlgo($passArr , $activityCategory , $af,$met,$currentDurationInMins,$longerDuration,$postexwt){ 
    
	$callArr = $postEx = $todayNd = array();
	$calCat = '';
        
        $age = $passArr->age;
        $intensity = $passArr->intensity_type; 
        $gender = $passArr->gender;    
        
        //Height calculation
	$height = 0;
	$height = inchBaseType($passArr->height,$passArr->height_type);
        
	//Weight calculation
	$kg = 0;
	$kg = wegBaseType($passArr->weight,$passArr->weight_type);
        //$durationBasedKg = wegBaseType($postexwt,$postexwtType);
	
	//hour calculation
	$hr = 0;
	$hr = hrBaseType($passArr->duration,$passArr->duration_type);
	
	
	$calCat = getCalculationCat($passArr->activity); //For getting the calculation category
        //new calc
        $goal = 'gain weight';
        $nacal = calculateNoActivities($kg, $height,$age ,$af ,$gender);
        $ecal = exerciseCalories($kg, $met , $hr);
        $gwnacal2 = noactivityCalories($kg);        
        $gwtcal2 = $gwnacal2;
        $gwpcal2 = proteinCalorine($goal, $activityCategory, $gwtcal2);
        $gwccal2 = carbohydrateCalorine($goal, $activityCategory, $gwtcal2);
        $gwfcal2 = fatCalorine($goal, $activityCategory, $gwtcal2);
        $gwpgram2 = $gwpcal2/4;
        $gwcgram2 = $gwccal2 / 4;
        $gwfgram2 = $gwfcal2 / 9;
        $gwnacal =  $nacal;
        $gwecal = $ecal;
        $gwtcal = $nacal + $ecal + $gwtcal2;
        $tcal = totalCalories($nacal ,$ecal);
        $pcal = proteinCalories($goal, $activityCategory, $kg);//3
        $ccal = carbohydrateCalories($goal,$activityCategory, $tcal, $pcal);//2        
        $fcal = fatCalories($goal, $tcal, $pcal,  $ccal);//4
        $gwpcal = $pcal + $gwpcal2;
        $gwccal = $ccal + $gwccal2;
        $gwfcal = $fcal + $gwfcal2;
        $gwpgram = $gwpcal / 4;        
        $gwcgram = $gwccal / 4;
        $gwfgram = $gwfcal / 9; 

        $todayNd['Calories'] = round($gwtcal);		
	$todayNd['Protein'] = round($gwpgram);
	$todayNd['Carbohydrate'] = round($gwcgram);
	$todayNd['Fat'] = round($gwfgram);
        
        //For getting the post excersice
        if($currentDurationInMins > $longerDuration){
                $longestDuration = $currentDurationInMins;                 
                $postEx = getPostEx($calCat,$kg);
            }else{
                $longestDuration = $longerDuration;
              $postEx = getPostEx($activityCategory,$postexwt);
          //      $postEx = getPostEx($activityCategory,$durationBasedKg);
            }        
        $postEx["calCat"] = $calCat;
        
	$callArr['postEx'] = $postEx; //Post Exercise
	$callArr['today_needs'] = $todayNd; //Today Need
	
	return $callArr;
}
//calculation for no activities
function calculateNoActivities($weight , $height ,$age, $af , $gender){ //g l m
    if($gender == 'male'){
        return (((10 * $weight) + (6.25 * $height) - (5 * $age) - 5) * $af);
    }else{
        return (((10 * $weight) + (6.25 * $height) - (5 * $age) -161) * $af);
    }
}
function totalCalories($nacal ,$ecal){//g l m
        return ($nacal + $ecal);
}
function proteinCalories($goal, $category ,$weight ){ //g l m  
            if($category == 'rhi'){
                return (1.8 * $weight * 4);
            }else if($category == 'skill'){
                return (1.4 * $weight * 4);
            }else{
                return (1.6 * $weight * 4);            
            }              
}
function carbohydrateCalories($goal ,$category,$tcal ,$pcal ){//g l m     
            if($category == 'rhi'){
                return (($tcal - $pcal) * 0.7);
            }else if($category == 'skill'){
                return (($tcal - $pcal) * 0.6);
            }else{
                return (($tcal - $pcal) * 0.8);            
            }              
}
function fatCalories($goal , $tcal , $pcal , $ccal ){//g l m
           return ($tcal - ($pcal + $ccal));             
}
function exerciseCalories($weight , $met , $duration){//g l m
          return ($met * $weight * $duration);
    
}
function proteinCalorine($goal , $category , $wtcal2){//g
    if($goal == 'gain weight'){
        if($category == 'rhi'){
                return ($wtcal2 * 0.25);
            }else if($category == 'skill'){
                return ($wtcal2 * 0.3);
            }else{
                return ($wtcal2 * 0.2);
            }
    }
}
function carbohydrateCalorine($goal , $category , $wtcal2){//g l
    if($goal == 'gain weight'){
        if($category == 'rhi'){
                return $wtcal2 * 0.6;
            }else if($category == 'skill'){
                return $wtcal2 * 0.5;
            }else{
                return $wtcal2 * 0.7;
            }
    }if($goal == 'lose weight'){
        if($category == 'endurance'){
            return $wtcal2 * 0.6;
        }else{
            return $wtcal2 * 0.5;
        }
    } 
}
function fatCalorine($goal , $category , $wtcal2){//g l
    if($goal == 'gain weight'){
        if($category == 'rhi'){
                return $wtcal2 * 0.15;
            }else if($category == 'skill'){
                return $wtcal2 * 0.2;
            }else{
                return $wtcal2 * 0.1;
            }
    }if($goal == 'lose weight'){
        if($category == 'endurance'){
            return $wtcal2 * 0.3;
        }else{
            return $wtcal2 * 0.4;
        }
    } 
}
function exerciseCaloriesinc(){
    
}
function noactivityCalories( $weight ){//g l
        return (($weight * 0.01 / 7) * 3500); 
}

function todayActAjax(){
        global $wpdb;
        global $current_user;
        $currentUserId = $current_user->id;
        $resultstemp = array();
        if($currentUserId != null && $currentUserId > 0 && !isset($_SESSION['guestUserAcivities'])) {
        $selqry = "select id,user_id,activity_name,duration,duration_type,intensity_type,addedon from wp_nutri_calculation WHERE DATE( addedon ) = CURDATE() AND user_id = $currentUserId";
        $resultstemp = $wpdb->get_results($selqry);
        $_SESSION['guestUserAcivities'] = $resultstemp;
        }else{
        
            $resultstemp = $_SESSION['guestUserAcivities'];
        }
        //var_dump($resultstemp);
        $errArr = '';        
        $i=0;?>
        <table>
            <tr style="background-color:#eee; height:60px;">		
                <td style="border:3px solid #fff; padding-top:15px;"><h4>Activity</h4></td>
                <td style="border:3px solid #fff; padding-top:15px;"><h4>Exercise Intensity</h4></td>
                <td style="border-top:3px solid #fff;border-bottom:3px solid #fff;border-left:3px solid #fff; padding-top:15px;"><h4>Duration</h4></td>
                <td style="border-top:3px solid #fff;border-bottom:3px solid #fff;border-right:3px solid #fff;"></td>
            </tr>
            <?php if(empty($resultstemp)){?>
                <span style="background-color:#eee;text-align:center;vertical-align:middle;"><h6>No activities selected.</h6></span>
            <?php }?>
        </table>
        <?php
           foreach($resultstemp as $key=>$val){ 
        ?>
        <input type="hidden" name="postActivity" Id= "postActivity" value="<?php echo  $resultstemp[$key]->activity_name;?>">
        <input type="hidden" name="postIntensity" Id= "postIntensity" value="<?php echo $resultstemp[$key]->duration;?>">
        <input type="hidden" name="postDuration" Id= "postDuration" value="<?php echo $resultstemp[$key]->intensity_type;?>">
        <input type="hidden" name="postDurationTyp" Id= "postDuration" value="<?php echo $resultstemp[$key]->duration_type;?>">
        <table>
        <tbody id="showActivity" >            
            <tr style="background-color:#eee; height:50px;">                
		<td style="border:3px solid #fff; padding-top:15px; width: 300px;"><?php echo $resultstemp[$key]->activity_name; ?></td>
		<td style="border:3px solid #fff; padding-top:15px; width: 300px;"><?php echo $resultstemp[$key]->intensity_type; ?></td>
		<td style="border:3px solid #fff; padding-top:15px; width: 300px;"><?php echo $resultstemp[$key]->duration;?><?php echo $resultstemp[$key]->duration_type;?></td>                
                <td style="border:3px solid #fff; padding-top:15px; ">                    
                    
                <span><img src="<?php echo site_url();?>/wp-content/themes/starter/images/icon_close_red.png" style="cursor:pointer;margin-bottom: 5px;" type="button" class="clsz" id="<?php echo $resultstemp[$key]->id;?>"></span>               
                </td>
            </tr>
        </tbody>
        </table>        
        <?php }
       
            
   
}
 add_action( 'wp_ajax_todayActAjax', 'todayActAjax' );

 function getTerms($termId){
        global $wpdb;
        
        $selqry = "select * from wp_terms WHERE term_id = $termId";
        $metvalues = $wpdb->get_results($selqry);
        return $metvalues;
 }

 
function nutricallAjax(){
	$getVal = array();
	$getVal = explode("#@#@#",$_GET['nutriVal']);

        $getLongDuration= array();
        $getWeight = array();
        //$getWeightType = array();
        $finalArr = array();
        $postExArr = array("Calories"=>'--',"Carbohydrate"=>'--',"Protein"=>'--',"Fat"=>'--');
	$emptyCalc = array("Calories"=>'--',"Carbohydrate"=>'--',"Protein"=>'--',"Fat"=>'--');
        $todayReqArr = array("Calories"=>0,"Carbohydrate"=>0,"Protein"=>0,"Fat"=>0);
        
        global $wpdb;
        global $current_user;
        $currentUserId = $current_user->id;
        $selqryforExwhilePgLoad = "select * from wp_nutri_calculation WHERE DATE( addedon ) = CURDATE() AND user_id = $currentUserId ORDER BY id DESC LIMIT 1";
        $lastEntry = $wpdb->get_results($selqryforExwhilePgLoad);     
            $activityHolder = $_SESSION['guestUserAcivities'];        
        for($i=0 ; $i< count($activityHolder) ; $i++){ 
                if($activityHolder[$i]->duration_type == 'H'){
                   $getLongDuration[$activityHolder[$i]->id] = ($activityHolder[$i]->duration) * 60;                  
                }else{
                   $getLongDuration[$activityHolder[$i]->id] = $activityHolder[$i]->duration;                
                }   
                $getWeight[$activityHolder[$i]->id] = $activityHolder[$i]->weight;
               // $getWeightType[$activityHolder[$i]->id] = $activityHolder[$i]->weight_type;
        }  
        $longerDuration = max($getLongDuration);
        $key = array_search($longerDuration, $getLongDuration);
        echo "###";
        
        foreach($activityHolder as $index => $currentActivity){
            $selectedAf = $currentActivity->general_activity_level;
            $activityFactor = $GLOBALS['afactor'][$selectedAf];
            $currentDurationInMins = $currentActivity->duration;
            
            $terms = getTerms($currentActivity->activity);
            if($currentActivity->intensity_type == 'Low'){
                $met = $terms[0]->metlow;
            }else if($currentActivity->intensity_type == 'Medium'){
                $met = $terms[0]->metmed;
            }else{
                $met = $terms[0]->methigh;
            }
            $activityCategory = explode("-",$terms[0]->slug)[0];  
            
            if($currentActivity->duration_type  == 'H'){
                $currentDurationInMins = $currentActivity->duration * 60 ;
            }

            if($currentActivity->goal_type == 1){ 
               // $finalArr = lossWeightAlgo($currentActivity ,$activityCategory , $activityFactor ,$met ,$currentDurationInMins,$longerDuration,$getWeight[$key],$getWeightType[$key]);
                $finalArr = lossWeightAlgo($currentActivity ,$activityCategory , $activityFactor ,$met ,$currentDurationInMins,$longerDuration,$getWeight[$key]);
            }elseif($currentActivity->goal_type == 3){ 
               // $finalArr = gainWeightAlgo($currentActivity ,$activityCategory , $activityFactor ,$met ,$currentDurationInMins,$longerDuration,$getWeight[$key],$getWeightType[$key]);
                $finalArr = gainWeightAlgo($currentActivity ,$activityCategory , $activityFactor ,$met ,$currentDurationInMins,$longerDuration,$getWeight[$key]);
            }else{ 
               //  $finalArr = maintainWeightAlgo($currentActivity ,$activityCategory ,$activityFactor ,$met ,$currentDurationInMins,$longerDuration,$getWeight[$key],$getWeightType[$key]);
                 $finalArr = maintainWeightAlgo($currentActivity ,$activityCategory ,$activityFactor ,$met ,$currentDurationInMins,$longerDuration,$getWeight[$key]);
            }
            $todayReqArr['Calories'] += $finalArr['today_needs']['Calories'];
            
            $todayReqArr['Protein'] += $finalArr['today_needs']['Protein'];
            $todayReqArr['Carbohydrate'] += $finalArr['today_needs']['Carbohydrate'];
            $todayReqArr['Fat'] += $finalArr['today_needs']['Fat'];
        }

        $postExArr = $finalArr['postEx'];
        if($todayReqArr['Calories'] === 0){
            $todayReqArr = $emptyCalc;
            $postExArr = $emptyCalc;
        }

        if(isset($finalArr['Calories'])){
            $postExArr = $finalArr['postEx'];
        }
?>
	<input type="hidden" name="postExHdCalories" Id= "postExHdCalories" value="<?php echo $postExArr['Calories'];?>">
	<input type="hidden" name="postExHdCarbohydrate" Id= "postExHdCarbohydrate" value="<?php echo $postExArr['Carbohydrate'];?>">
	<input type="hidden" name="postExHdProtein" Id= "postExHdProtein" value="<?php echo $postExArr['Protein'];?>">
	<input type="hidden" name="postExHdFat" Id= "postExHdFat" value="<?php echo $postExArr['Fat'];?>">
	<input type="hidden" name="postExHdBCAA" Id= "postExHdBCAA" value="<?php echo $postExArr['BCAA'];?>">
	<input type="hidden" name="postExHdCalCat" Id= "postExHdCalCat" value="<?php echo $postExArr['calCat'];?>">
		
	<input type="hidden" name="todayReqHdCalories" Id= "todayReqHdCalories" value="<?php echo $todayReqArr['Calories'];?>">
	<input type="hidden" name="todayReqHdCarbohydrate" Id= "todayReqHdCarbohydrate" value="<?php echo $todayReqArr['Carbohydrate'];?>">
	<input type="hidden" name="todayReqHdProtein" Id= "todayReqHdProtein" value="<?php echo $todayReqArr['Protein'];?>">
	<input type="hidden" name="todayReqHdFat" Id= "todayReqHdFat" value="<?php echo $todayReqArr['Fat'];?>">	
	<input type="hidden" name="todayReqHdBCAA" Id= "todayReqHdBCAA" value="<?php echo $todayReqArr['BCAA'];?>">
	
	<input type="hidden" name="activityhd" Id= "activityhd" value="0">	
	
	<tr style="color:#fff; font-weight:bold; height:50px; font-size:18px;">
		<td style="border:5px solid #fff;  padding-top:15px; width:25%">&nbsp;</td>
		<td style="border:5px solid #fff; background-color:#00ADE7; padding-top:15px; width:37%">Post Exercise</td>
		<td style="border:5px solid #fff; background-color:#00ADE7; padding-top:15px; width:37%">Today Requirement</td>
	</tr>
															
	<tr style="background-color:#eee; height:55px;">											
		<td style="background-color: #CC9900; color:#fff;border:5px solid #fff; padding:11px 0px 0px 30px; font-size:18px; text-align:left; font-weight:bold;">Calories</td>
                <td style="border:5px solid #fff; padding-top:15px;"><?php if(isset($lastEntry[0]->postEx_calories) && $postExArr['Calories']== '--'){echo $lastEntry[0]->postEx_calories;}else{echo ($postExArr['Calories']);} ?>
                <td style="border:5px solid #fff; padding-top:15px;"><?php if(isset($lastEntry[0]->todayReq_calories) && $todayReqArr['Calories']== '--'){echo $lastEntry[0]->todayReq_calories;}else{echo $todayReqArr['Calories'];}?></td>       
	  </tr>	
										  
	<tr style="background-color:#eee; height:55px;">											
		<td style="background-color: #CC9900;color:#fff;border:5px solid #fff; padding:11px 0px 0px 30px; font-size:18px; text-align:left; font-weight:bold;">Carbohydrate&nbsp;</td>
                <td style="border:5px solid #fff; padding-top:15px;"><?php if(isset($lastEntry[0]->postEx_carbohydrate) && $postExArr['Carbohydrate']== '--' ){echo $lastEntry[0]->postEx_carbohydrate;}else{echo ($postExArr['Carbohydrate']);}?></td>
                <td style="border:5px solid #fff; padding-top:15px;"><?php if(isset($lastEntry[0]->todayReq_carbohydrate) && $todayReqArr['Carbohydrate']== '--'){echo $lastEntry[0]->todayReq_carbohydrate;}else{echo $todayReqArr['Carbohydrate'];}?></td>                
	</tr>
										  
	<tr style="background-color:#eee; height:55px;">											
		<td style="background-color: #CC9900;color:#fff;border:5px solid #fff; padding:11px 0px 0px 30px; font-size:18px; text-align:left; font-weight:bold;">Protein</td>
                <td style="border:5px solid #fff; padding-top:15px;"><?php if(isset($lastEntry[0]->postEx_protein) && $postExArr['Protein']== '--'){echo $lastEntry[0]->postEx_protein;}else{echo ($postExArr['Protein']);}?></td>
                <td style="border:5px solid #fff; padding-top:15px;"><?php if(isset($lastEntry[0]->todayReq_protein) && $todayReqArr['Protein']== '--'){echo $lastEntry[0]->todayReq_protein;}else{echo $todayReqArr['Protein'];}?></td>           
	</tr>
										  
	<tr style="background-color:#eee; height:60px;">											
		<td style="background-color: #CC9900;color:#fff;border:5px solid #fff; padding:11px 0px 0px 30px; font-size:18px; text-align:left; font-weight:bold;">Fat</td>
                <td style="border:5px solid #fff; padding-top:15px;"><?php if(isset($lastEntry[0]->postEx_fat) && $postExArr['Fat']== '--'){echo $lastEntry[0]->postEx_fat;}else{echo ($postExArr['Fat']);}?></td>
                <td style="border:5px solid #fff; padding-top:15px;"><?php if(isset($lastEntry[0]->todayReq_fat) && $todayReqArr['Fat']== '--'){echo $lastEntry[0]->todayReq_fat;}else{echo $todayReqArr['Fat'];}?></td>
	</tr>
	
<?php         
	//For showing recommendedproducts
 
        recommendedProducts($postExArr,$todayReqArr,$getVal);
        $_SESSION['postExArr'] = $postExArr;
}

add_action( 'wp_ajax_nutricallAjax', 'nutricallAjax' );

//Recommended product function starts
function recommendedProducts($afArr,$dailArr,$getVal){
  
	global $wpdb;
	echo "###";
	$first = 1;        
	/*if(trim($afArr['Calories']) == '--' && trim($afArr['Carbohydrate']) == '--' && trim($afArr['Protein']) == '--' && trim($afArr['Fat']) == '--' && trim($dailArr['Calories']) == '--' && trim($dailArr['Carbohydrate']) == '--' && trim($dailArr['Protein']) == '--' && trim($dailArr['Fat']) == '--'){
		$first = 2;
	}*/
        if($getVal[0] == 'empty'){$first = 2;}
	

	$totalscore = '';
	$orderArr = array('rhi'=>'RhiTotalScore','skill'=>'SkillTotalScore','endurance'=>'EndTotalScore');
	$serqry1 = " 1 ";
	
	if($first == 1){ //After the calculation
            
		$totalscore = $orderArr[$afArr['calCat']];//print_r($totalscore);
		if(trim($afArr['calCat']) == ''){
			$totalscore = $orderArr['rhi'];
		}			
		$ordqry1 = "order by ".$totalscore." desc limit 3";
		
		$selqry = "select Id,productname,productimage,ratioctop,asin,RhiTotalScore,SkillTotalScore,EndTotalScore,calories,protein,priprotein from wp_recommended_products where ".$serqry1." ".$ordqry1."";
		$results = $wpdb->get_results($selqry);
	}else{ //On the page load
		$i = 0;
                        
		foreach($orderArr as $ky=>$vl){
			$ordqry1 = $selqry = '';
			$ordqry1 = "order by ".$vl." desc limit 1";			
			$resultstemp = array();

			$ids = 0;
			if(count($results)>0){
				for($indf=0;$indf<count($results);$indf++){
					$ids = $ids.",".$results[$indf]->Id; 
				}
			}			
			$serqry1 = " id not in (".$ids.")";
			
			$selqry = "select Id,productname,productimage,ratioctop,servingsize,asin,RhiTotalScore,SkillTotalScore,EndTotalScore,calories,protein,priprotein from wp_recommended_products where ".$serqry1." ".$ordqry1."";
			$resultstemp = $wpdb->get_results($selqry);                        
                        $resultstemp[0]->scoretype = $vl;
			$results[$i] = $resultstemp[0];                        
			$i++;                        
		}
						
	}
		
	$finalResults = $results;
        $totalscore1 = $orderArr[$afArr['calCat']];
        
	$maxLen = 0;
	if(count($finalResults) == 0){
		$maxLen = 0;
	}elseif((count($finalResults) > 0) && (count($finalResults) < 3)){
		$maxLen = count($finalResults);
	}elseif(count($finalResults) >= 3){
		$maxLen = 3;
	}
	        
	$showdIds = '';
	if($maxLen > 0){
            
            
		for($j=0; $j<$maxLen; $j++){        
            
			$asin = '';
			$asin = $finalResults[$j]->asin; 
			$showdIds .= ",".$finalResults[$j]->Id;
                        if($totalscore1){
            
                            $sbRating = round($finalResults[$j]->$totalscore1);
                        }else{                            
            
                            $totalscore1 = '';
                            $totalscore1 = $finalResults[$j]->scoretype;
                            $sbRating = round($finalResults[$j]->$totalscore1);
                        }
                        
                        
?>
       <div id="test-form<?php echo $j;?>"+<?php echo $j;?> class="mfp-hide white-popup-block row-fluid table-responsive simplemodal-data">
                        <table class="table-responsive" style="background-color:transparent;color:black;font-weight:bold;">
                                <h4 style="text-align:center;color:black;"><?php echo strtoupper($finalResults[$j]->productname);?></h4>
                                <tr><td rowspan="7" style="padding-top:50px;"><img class="image-responsive"style=""src="<?php echo $finalResults[$j]->productimage;?>" height="130px" width="100px"></td><td></td></tr>
                                <tr><td colspan="2" style="font-size:14px; text-align: right;color:#00ade7;">NUTRITIONAL CONTENTS</td></tr>                                
                                <tr><td style="font-size:13px; text-align: right;">CALORIES :</td><td><?php if($finalResults[$j]->calories){echo $finalResults[$j]->calories."g";}else{echo "-";}?></td></tr>
                                <tr><td style="font-size:13px; text-align: right;">PROTEIN :</td><td><?php if($finalResults[$j]->protein){echo $finalResults[$j]->protein."g";}else{echo "-";}?></td></tr>                                
                                <tr><td style="font-size:13px; text-align: right;">CARBOHYDRATE :</td><td><?php if($finalResults[$j]->totcarbohydrate){echo $finalResults[$j]->totcarbohydrate."g";}else{echo "-";}?></td></tr>
                                <tr><td style="font-size:13px; text-align: right;">SUGARS :</td><td><?php if($finalResults[$j]->sugars){echo $finalResults[$j]->sugars."g";}else{echo "-";}?></td></tr>
                                <tr><td style="font-size:13px; text-align: right;">FAT :</td><td><?php if($finalResults[$j]->totalfat) {echo $finalResults[$j]->totalfat."g";}else{echo "-";}?>  </td></tr> 
                         </table>
        </div>

        <div id="sb-form<?php echo $j;?>"+<?php echo $j;?>" class="mfp-hide white-popup-block container table-responsive">  
            <div style="margin-top:15px;border:2px solid #fff;padding-top:10px;color:#fff;font-weight:bold;height:50px;font-size:18px; background-color:#ed1c24;text-align:center;">SB RATING</div>
                  <table class="table" style="width:50%;float:left;"> 
                                <th colspan="2" style="padding-top: 15px;border-right:2px solid #fff;border-left:2px solid #fff;color:#fff;font-weight:bold;height:60px;font-size:17px;text-align:center;background-color:#00ADE7;">My Nutritional Needs</th>                        
                                <tr style="color:#fff; font-weight:bold; height:50px; font-size:16px;">                                        
                                        <td colspan="2" style="padding-top: 11px;border:2px solid #fff;text-align:center; background-color:#00ADE7; width:60%">Post Exercise</td>		
                                </tr>

                                <tr style="background-color:#eee; height:55px;">											
                                        <td style="background-color: #CC9900; color:#fff;border:2px solid #fff; font-size:16px; text-align:center; font-weight:bold;">Calories</td>
                                        <td style="border:2px solid #fff; text-align:center;padding-top:15px;"><?php echo $afArr['Calories']; ?></td>		
                                  </tr>	

                                <tr style="background-color:#eee; height:55px;">											
                                        <td style="background-color: #CC9900;color:#fff;border:2px solid #fff; font-size:16px; text-align:center; font-weight:bold;">Carbohydrate&nbsp;</td>
                                        <td style="border:2px solid #fff; text-align:center;padding-top:15px;"><?php echo $afArr['Carbohydrate'];?></td>		
                                </tr>

                                <tr style="background-color:#eee; height:55px;">											
                                        <td style="background-color: #CC9900;color:#fff;border:2px solid #fff; font-size:16px; text-align:center; font-weight:bold;">Protein</td>
                                        <td style="border:2px solid #fff; text-align:center;padding-top:15px;"><?php echo $afArr['Protein'];?></td>		
                                </tr>

                                <tr style="background-color:#eee; height:60px;">											
                                        <td style="background-color: #CC9900;color:#fff;border:2px solid #fff; font-size:16px; text-align:center; font-weight:bold;">Fat</td>
                                        <td style="border:2px solid #fff; text-align:center;padding-top:15px;"><?php echo $afArr['Fat'];?></td>		
                                </tr>
                        </table>

                        <table class="table" style="width:50%;float:left;">
                                <th colspan="2" style="padding-top:30px;border-right:2px solid #fff;border-bottom:2px solid #fff;color:#fff;font-weight:bold;height:110px;width:300px;font-size:17px;text-align:center;background-color:#00ADE7;"><?php echo $finalResults[$j]->productname;?></th>                                                                    
                                <tbody style="border-right:2px solid #fff;border:5px solid #fff;background-color:#CC9900;color:#fff;font-weight:bold;height:233px;padding: 10px 10px 10px 10px">
                                <tr><td style="width:60%;font-size:16px; text-align: right;">Per Serving :</td><td><?php if($finalResults[$j]->servingsize){echo $finalResults[$j]->servingsize;}else{echo "-";}?></td></tr>
                                <tr><td style="width:60%;font-size:16px; text-align: right;">Calories :</td><td><?php if($finalResults[$j]->calories){echo $finalResults[$j]->calories."g";}else{echo "-";}?></td></tr>
                                <tr><td style="width:60%;font-size:16px; text-align: right;">Carbohydrate :</td><td><?php if($finalResults[$j]->totcarbohydrate){echo $finalResults[$j]->totcarbohydrate."g";}else{echo "-";}?></td></tr>                               
                                <tr><td style="width:60%;font-size:16px; text-align: right;">Protein :</td><td><?php if($finalResults[$j]->protein){echo $finalResults[$j]->protein."g";}else{echo "-";}?></td></tr>                                
                                <tr><td style="width:60%;font-size:16px; text-align: right;">Fat :</td><td><?php if($finalResults[$j]->totalfat) {echo $finalResults[$j]->totalfat."g";}else{echo "-";}?>  </td></tr> 
                                </tbody>
                        </table>
                    </div>
        
	<table class="table" style="background-color:#eee;">
		<tbody>                       
                    <tr> 
                        <td rowspan="2" style="padding-top:80px;width:100px;font-weight:bold;background-color:#eee;">  
                            <a class="popup-with-form" style="padding-left:17px;" href="#sb-form<?php echo $j;?>">
                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2015/10/sbscore.png" height=50 width=50></a>
                        <a id="prodrating" class="popup-with-form" style="margin-left:8px;" href="#sb-form<?php echo $j;?>">
                            <?php if($sbRating >=0 && $sbRating<50){echo "<div style='margin-left:7px;' class='red'>".$sbRating."</div>";                            
                            }else if($sbRating >=50 && $sbRating<80){echo "<div style='margin-left:7px;' class='orange'>".$sbRating."</div>";
                            }else{ echo "<div style='margin-left:7px;' class='green'>".$sbRating."</div>";                         
                            } ?>
                        </a>
                         </td>                              
                        <td   id="prodname" style="padding-top:20px;padding-bottom: 20px;text-align: center; color: #fff;font-weight:bold ; background-color:#00ADE7;" colspan="2" onmouseup="javascript:$('#prodname').trigger('click');">
                            <a class="popup-with-form" style="color:#fff" href="#test-form<?php echo $j;?>">
                                <?php echo $finalResults[$j]->productname;?>
                            </a>
                        </td> 
                    </tr>
                    <tr> 
                        <td id="prodimg" style="padding-top:10px;padding-left:30px;background-color:#00ADE7;">
                            <a class="popup-with-form" href="#test-form<?php echo $j;?>">
                                <img src="<?php echo $finalResults[$j]->productimage;?>" width="120px">                                
                            </a>
                        </td>
                    </tr>  
                    <tr>
                        <td colspan="2"style="padding:10px 0px 11px 85px;">
                            <a rel="nofollow" href="http://www.amazon.com/gp/product/<?php echo $asin;?>?ie=UTF8&camp=1789&creativeASIN=<?php echo $asin;?>&linkCode=xm2&tag=shak08-20" target="_blank">
                                <input id="buynowid" name="buynowid" type="button" value="BUY NOW" class="pbSubmit4" style="background: none repeat scroll 0 0 #0F3154; color:#fff;font-size:13px;">
                            </a>
                        </td>
                    </tr>
                    
		</tbody>
	</table>
			
<?php
		} // For Loop
	}else{
		?>
		<table class="table" style="background-color:#eee;">
			<tbody>
				<tr style="font-size:20px;">
					<td style="padding-top:15px;" rowspan="4">
						No Products available.
					</td>
				</tr>
			</tbody>
		</table>		
<?php
	}	
	$ur = site_url()."/index.php/recommended-products/";	
	?>
	<a href="<?php echo add_query_arg( array('showdIdshd' => $showdIds, 'resultCatTypehd' => $totalscore), $ur);?>"><input type="button" class="pbSubmit" value="SEE MORE PRODUCTS" style="margin-left:45px;"></a>
	
<?php	
}

function activityDeleteAjax(){
        global $wpdb;
        $getVal = $_GET['delVal'];
            foreach($_SESSION['guestUserAcivities'] as $key => $value){
                if($_SESSION['guestUserAcivities'][$key]->id == $getVal && isset($_SESSION['guestUserAcivities'][$key]->isSaved) && !($_SESSION['guestUserAcivities'][$key]->isSaved) ){
                    unset($_SESSION['guestUserAcivities'][$key]);
                }else if($_SESSION['guestUserAcivities'][$key]->id == $getVal){
                    $selqry = "DELETE FROM wp_nutri_calculation WHERE id = $getVal"; 
                    $wpdb->query($wpdb->prepare($selqry));
                    unset($_SESSION['guestUserAcivities'][$key]);
                }
            }
}
add_action( 'wp_ajax_activityDeleteAjax', 'activityDeleteAjax' );

function destroySession(){ 
    unset($_SESSION['guestUserAcivities']);
}
add_action( 'wp_ajax_destroySession', 'destroySession' );

function activitySaveAjax(){
    
    global $wpdb;
	$getVal = array();
	$getVal = explode("#@#@#",$_GET['nutriSaveVal']);
	$nutidata = $nutiformat = array();
        $goalTyp = $getVal[0];
	$catidpost = get_cat_ID(trim($goalTyp));
	$mainCat = $getVal[1];
	$activitiesdif = $getVal[2];	
	$nutWeight = $getVal[3];
	$nutWeighttyp = $getVal[4];
	$nutDuration = $getVal[5];
	$nutDurationtyp = $getVal[6];	
        $nutAge = $getVal[7];
	$nutAgetyp = years;
	$nutHeight = $getVal[8];
	$nutHeighttyp = $getVal[9];
	$nutIntensitytyp = $getVal[10];
	$genderTyp = $getVal[11];
        $generalActivityLevel = $getVal[13];
        $uid = $getVal[12];
	$tmp1 = get_category($catidpost);
	$tmp2 = get_category($activitiesdif);

	$cate_name = '';
	$acti_name = '';

	$cate_name = $tmp1->name; 
	$acti_name = $tmp2->name;
        
        $addedTime = date('Y-m-d g:i:s'); 
        $errArr = '';
	
        if( $getVal[2] == ''){
            $errArr[] = "Activity is Empty.";
        }
        if( $getVal[10] == 'undefined' || $getVal[10] == ''){
            $errArr[] = "Exercise Intensity is Empty.";
        }
        if( $getVal[11] == 'undefined' || $getVal[11] == ''){
            $errArr[] = "Gender is Empty.";
        }
        if( $getVal[5] == ''){
            $errArr[] = "Duration is Empty.";
        }else if(!is_numeric($getVal[5])){
         $errArr[] = "Duration must be numeric.";
        }
        if( $getVal[7] == ''){
            $errArr[] = "Age is Empty.";
        }else if(!is_numeric($getVal[7])){
         $errArr[] = "Age must be numeric.";
        }
         if( $getVal[8] == ''){
            $errArr[] = "Height is Empty.";
        }else if(!is_numeric($getVal[8])){
         $errArr[] = "Height must be numeric.";
        }
         if( $getVal[3] == ''){
            $errArr[] = "Weight is Empty.";
        }else if(!is_numeric($getVal[3])){
         $errArr[] = "Weight must be numeric.";
        }
        
        $nutidata = new stdClass();   
        $nutidata->user_id= $uid;
        $nutidata->goal_type= $mainCat;
        $nutidata->category= $catidpost;
        $nutidata->category_name= $cate_name;
        $nutidata->activity= $activitiesdif; 
        $nutidata->activity_name= $acti_name;
        $nutidata->weight= $nutWeight;
        $nutidata->weight_type= $nutWeighttyp;
        $nutidata->duration= $nutDuration;
        $nutidata->duration_type= $nutDurationtyp;
        $nutidata->age= $nutAge;
        $nutidata->age_type= $nutAgetyp; 
        $nutidata->height= $nutHeight;
        $nutidata->height_type= $nutHeighttyp; 
        $nutidata->intensity_type= $nutIntensitytyp; 
        $nutidata->gender= $genderTyp;
        $nutidata->general_activity_level= $generalActivityLevel;
        $nutidata->cal_category= $postExHdCalCat;
        $nutidata->addedon= $addedTime;
        $nutidata->id = round(microtime(true));
        $nutidata->isSaved = false;

        if($errArr != ''){ 
		echo implode("<br />", $errArr);
		echo "###";		
	}      
        else{
  
        if(!isset($_SESSION['guestUserAcivities'])){
            $_SESSION['guestUserAcivities'] = array();
        }
        echo "###"; 
        array_push($_SESSION['guestUserAcivities'], $nutidata);
        echo "Details stored successfully.";
        }
}

add_action( 'wp_ajax_activitySaveAjax', 'activitySaveAjax' );

function nutricallSaveAjax(){
	global $wpdb;
	$currentActFromUi = array();
        $cate_name = '';
	$acti_name = '';
//	$getVal = explode("#@#@#",$_GET['nutriSaveVal']);	
	$currentActFromUi =  $_GET['nutriSaveVal'];
        $currentActFromUi->isSaved = false;
	$nutidata = $nutiformat = array();	
	
	$catidpost = get_cat_ID(trim($currentAct->goal_type));
        $tmp1 = get_category($catidpost);
        $currentActFromUi->category_name = $tmp1->name; 
       
        $tmp2 = get_category($currentAct->activity);
        $currentActFromUi->activity_name = $tmp2->name; 

	$addedTime = date('Y-m-d g:i:s');

        foreach($_SESSION['guestUserAcivities'] as $key => $val){
            $currentAct = $val;
            if(isset($currentAct->isSaved) && !$currentAct->isSaved ){
            $nutidata = array(
//					'user_id' => $currentActFromUi['uid'],
					'user_id' => $currentAct->user_id,
					'goal_type' => $currentAct->goal_type,
					'category' => $catidpost,
					'category_name' => $currentActFromUi->category_name,
					'activity' => $currentAct->activity, 
					'activity_name' => $currentAct->activity_name,
					'weight' => $currentAct->weight,
					'weight_type' => $currentAct->weight_type,
					'duration' => $currentAct->duration,
					'duration_type' => $currentAct->duration_type,
					'cal_category' => $currentActFromUi['cal_category'],
					'postEx_calories' => $currentActFromUi['postEx_calories'],
					'postEx_carbohydrate' => $currentActFromUi['postEx_carbohydrate'],
					'postEx_protein' => $currentActFromUi['postEx_protein'],
					'postEx_fat' => $currentActFromUi['postEx_fat'],
					'postEx_BCAA' => $currentActFromUi['postEx_BCAA'],
					'todayReq_calories' => $currentActFromUi['todayReq_calories'],
					'todayReq_carbohydrate' => $currentActFromUi['todayReq_carbohydrate'],
					'todayReq_protein' => $currentActFromUi['todayReq_protein'],
					'todayReq_fat' => $currentActFromUi['todayReq_fat'],
					'todayReq_BCAA' => $currentActFromUi['todayReq_BCAA'],
                                        'age' => $currentAct->age,
                                        'age_type' =>  $currentAct->age_type, 
                                        'height' => $currentAct->height,
                                        'height_type' => $currentAct->height_type, 
                                        'intensity_type' => $currentAct->intensity_type, 
                                        'gender' => $currentAct->gender,
                                        'general_activity_level' =>  $currentAct->general_activity_level,
					'addedon' => $addedTime
				);
	
	$nutitable = 'wp_nutri_calculation';
	$nutiformat = array('%d','%d','%d','%s','%d','%s','%f','%s','%f','%s','%s','%d','%d','%d','%d','%d','%d','%d','%d','%d','%d','%d','%s','%f','%s','%s','%s','%s','%s');
            $wpdb->insert( $nutitable, $nutidata, $nutiformat );
            unset($_SESSION['guestUserAcivities'][$key]->isSaved);
            }
	
        }
        echo "Details saved successfully.";                                                                                                                           
}

add_action( 'wp_ajax_nutricallSaveAjax', 'nutricallSaveAjax' );

function getActivityDetailsFromDb(){
    global $wpdb;
    global $current_user;
    $currentUserId = $current_user->id;
    $chosenDate = date("Y-m-d", strtotime($_GET['date']));
    $selqry = "select * from wp_nutri_calculation where date(addedon) = '$chosenDate' AND user_id = $currentUserId ";
    $dailyActivities = $wpdb->get_results($selqry);
    return $dailyActivities;
}

function getDailyActivitiesByDate(){  
    global $wpdb;
    global $current_user;
    $currentUserId = $current_user->id; 
    $chosenDate = date("Y-m-d", strtotime($_GET['date'])); //print_r($_GET['date']);echo"  ";print_r($chosenDate);//die;
    $selqry = "select * from wp_nutri_calculation where date(addedon) = '$chosenDate' AND user_id = $currentUserId ";
    $dailyActivities = $wpdb->get_results($selqry);
        if(!empty($dailyActivities)){
        foreach($dailyActivities as $info => $dailyAct ){
            $terms = getTerms($dailyAct->activity); 
  ?>
        <div id="showDailyActivitiesByDate"  style="display: inline-block;">
            <div style="float:left;width: 148px;height: 127px;border-radius: 50%;background:#00ADE7;text-align: center;font-size: 15px;padding-top: 25px;margin: 5px; border: 2px solid #4682B4;"><?php echo $dailyAct->weight;?><?php echo $dailyAct->weight_type;?><br/><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/06/weight.png" style="margin-top:5px;" height=45 width=45></div>
            <div style="float:left;width: 148px;height: 127px;border-radius: 50%;background:#00ADE7;text-align: center;font-size: auto;padding-top: 25px;margin: 5px; border: 2px solid #4682B4;"><?php $string = strip_tags($dailyAct->activity_name);if(strlen($dailyAct->activity_name) > 14){$stringCut = substr($string, 0, 14);echo $stringCut."..";}else{echo $dailyAct->activity_name;}?><br/><?php if($terms[0]->activityicon == ""){?><img src="<?php echo site_url(); ?>/wp-content/plugins/categories-images/images/acts.png" height=45 width=45><?php }else{?><img src="<?php echo $terms[0]->activityicon;?>"height=45 width=45><?php }?></div>
            <div style="float:left;width: 148px;height: 127px;border-radius: 50%;background:#00ADE7;text-align: center;font-size: 15px;padding-top: 25px;margin: 5px; border: 2px solid #4682B4;"><?php echo $dailyAct->duration;?><?php echo $dailyAct->duration_type;?><br/><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/06/clk.png" style="margin-top:5px;" height=45 width=45></div>
            <div style="float:left;width: 148px;height: 127px;border-radius: 50%;background:#00ADE7;text-align: center;font-size: 15px;padding-top: 25px;margin: 5px; border: 2px solid #4682B4;"><?php echo $dailyAct->todayReq_calories;?><br/><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/06/caloriburn.png" style="margin-top:5px;" height=45 width=45></div>
        </div> 
        <?php }}else{?><div style="text-align:center;padding-top: 70px;"><?php echo"No records found for the day."?></div><?php ;}
}
add_action( 'wp_ajax_getDailyActivitiesByDate', 'getDailyActivitiesByDate' );

function getFilteredActivitiesByDate(){
    global $wpdb;
    global $current_user;
    $currentUserId = $current_user->id;
    $e =$_GET['startDate'];
    $p =$_GET['endDate'];  
    $chosenStartDate = date("Y-m-d", strtotime($e));
    $chosenEndDate = date("Y-m-d", strtotime($p)); 
    $selqry = "select *,date(addedon) from wp_nutri_calculation where date(addedon) BETWEEN '$chosenStartDate' AND '$chosenEndDate' AND user_id = $currentUserId";
    $filteredActivities = $wpdb->get_results($selqry);
    $getUniqueActivityDur = array();
    $getUniqueActivityCal = array();
    $getUniqueActivity = array();
    $totalDur = $totalCal = $activityCount = 0;
    $avgDur = $avgWeight = $avgCal = $activityCount = 0;
    $totalActsForTheDay = count($filteredActivities);
    $date1=date_create("$chosenStartDate");
    $date2=date_create("$chosenEndDate");
    $diff=date_diff($date1,$date2);
    $NoOfDays =$diff->format("%a day(s)");  
    $convertedWeightOfRangeEnd = wegBaseType(($filteredActivities[count($filteredActivities)-1]->weight),($filteredActivities[count($filteredActivities)-1]->weight_type));
    $convertedWeightOfRangeStart = hrBaseType(($filteredActivities[0]->weight),($filteredActivities[0]->weight_type));
//    $weightChangeForTheProvidedRange = (($filteredActivities[count($filteredActivities)-1]->weight)-($filteredActivities[0]->weight));
    $weightChangeForTheProvidedRange = round($convertedWeightOfRangeEnd - $convertedWeightOfRangeStart);
        if($chosenEndDate  >= $chosenStartDate){   
    ?> 
        <!--<table id="myTable" class="table tablesorter" style="text-align:center;width:40%;float:left;">-->   

        <table id="table" class="table" style="text-align:center;width:40%;float:left;">    
                    <div class="listViewTable1RowDesign listViewTableDesign" style="width:366%;text-align:center;padding: 8px;">
                         Totals
                    </div>
    <?php 
        foreach($filteredActivities as $info => $filteredAct ){               
    ?>              
                <tbody id="showActivitiesBySelectedDates">
                     <tr style="background-color:#e9e9e9;">
                        <td style="border:5px solid #fff; padding-top:20px;"><?php echo $filteredAct->addedon ;?></td>
                        <td style="border:5px solid #fff; padding-top:20px;"><?php echo $filteredAct->weight ;?><?php echo $filteredAct->weight_type ;?></td>
                        <td style="border:5px solid #fff; padding-top:20px;"><?php echo $filteredAct->activity_name ;?></td>
                        <td style="border:5px solid #fff; padding-top:20px;"><?php echo $filteredAct->duration ;?><?php echo $filteredAct->duration_type ;?></td>
                        <td style="border:5px solid #fff; padding-top:20px;"><?php echo $filteredAct->todayReq_calories ;?></td>
                     </tr>
                </tbody>
        </table> 
       
            <?php }         
            echo "###";
                      
           for($i = 0; $i< $totalActsForTheDay ; $i++){
               $convertedTotalDuration = hrBaseType($filteredActivities[$i]->duration ,$filteredActivities[$i]->duration_type);
               $getUniqueActivity[$filteredActivities[$i]->activity_name] += 1;                         
               $getUniqueActivityDur[$filteredActivities[$i]->activity_name] += $convertedTotalDuration;                         
               $getUniqueActivityCal[$filteredActivities[$i]->activity_name] += $filteredActivities[$i]->todayReq_calories;             
           } ?>
            <div class="listViewTable1RowDesign listViewTableDesign" style="width:132%;text-align:center;padding: 8px;">
                         Activity Breakdown
                    </div>
           <div class="listViewTable1RowDesign listViewTableDesign" style="width:132%;text-align:center;padding: 8px;">
                         Totals
                    </div>
           <?php foreach($getUniqueActivityDur as $key => $val){ ?> 
            <table>
                <tbody id="actbreaktot"> 
                     <tr style="background-color:#e9e9e9;">
                        <td style="border:5px solid #fff; padding-top:20px;"><?php echo $key;?></td>
                        <td style="border:5px solid #fff; padding-top:20px;"><?php echo $val;?></td>
                        <td style="border:5px solid #fff; padding-top:20px;"><?php echo $getUniqueActivityCal[$key];?></td>                        
                     </tr>
                </tbody>
            </table> 
           <?php }
           ?>
           <div class="listViewTable1RowDesign listViewTableDesign" style="width:132%;text-align:center;padding: 8px;">
                         Averages
                    </div>
           <?php
           foreach($getUniqueActivityDur as $key => $val){ ?>            
            <table>
                <tbody id="actbreakavg"> 
                     <tr style="background-color:#e9e9e9;">
                        <td style="border:5px solid #fff; padding-top:20px;"><?php echo $key;?></td>
                        <td style="border:5px solid #fff; padding-top:20px;"><?php echo $val/$getUniqueActivity[$key];?></td>
                        <td style="border:5px solid #fff; padding-top:20px;"><?php echo $getUniqueActivityCal[$key]/$getUniqueActivity[$key];?></td>                        
                     </tr>
                </tbody>
            </table> 
            <?php }   
            echo "###";
            ?>
           <div class="listViewTable1RowDesign listViewTableDesign" style="width:460%;text-align:center;padding: 8px;margin-top:20px;">
                         Total
                    </div>
           <?php
            foreach($filteredActivities as $info => $filteredAct ){ 
                  //wegBaseType hrBaseType inchBaseType 
                $convertedWeight = wegBaseType($filteredAct->weight , $filteredAct->weight_type); 
                $convertedDuration = hrBaseType($filteredAct->duration , $filteredAct->duration_type); 
                $activityCount = $activityCount + 1;  
                $totalDur +=  $convertedDuration;                
                $totalWeight +=  $convertedWeight;                
                $totalCal +=  $filteredAct->todayReq_calories;            
            }            
            $avgDur = round($totalDur/$totalActsForTheDay);
            $avgWeight = round($totalWeight/$totalActsForTheDay);
            $avgCal = round($totalCal/$totalActsForTheDay);              
                ?>
        <table>
                <tbody id="totals">
                     <tr style="background-color:#e9e9e9;">
                        <td style="border:5px solid #fff; padding-top:20px; width:150px;"><?php echo $NoOfDays;?></td>
                        <td style="border:5px solid #fff; padding-top:20px; width:150px;"><?php echo $weightChangeForTheProvidedRange;?><?php echo "K";?></td>
                        <td style="border:5px solid #fff; padding-top:20px; width:150px;"><?php echo $activityCount." Activities";?></td>
                        <td style="border:5px solid #fff; padding-top:20px; width:150px;"><?php echo $totalDur;?><?php echo "H";?></td>
                        <td style="border:5px solid #fff; padding-top:20px; width:150px;"><?php echo $totalCal  ;?></td>
                     </tr>
                </tbody>
        </table>  
        <?php  echo "###";?>
        <table>
            <div class="listViewTable1RowDesign listViewTableDesign" style="width:383%;text-align:center;padding: 8px;">
                         Average
                    </div>
                <tbody id="avg">
                     <tr style="background-color:#e9e9e9;">
                        <td style="border:5px solid #fff; padding-top:20px; width:150px;"><?php echo $NoOfDays;?></td>
                        <td style="border:5px solid #fff; padding-top:20px; width:150px;"><?php echo $avgWeight;?><?php echo "K";?></td>
                        <td style="border:5px solid #fff; padding-top:20px; width:150px;"><?php echo "-";?></td>
                        <td style="border:5px solid #fff; padding-top:20px; width:150px;"><?php echo $avgDur;?><?php echo "H";?></td>
                        <td style="border:5px solid #fff; padding-top:20px; width:150px;"><?php echo $avgCal  ;?></td>
                     </tr>
                </tbody>
        </table> 
         <?php  echo "###";?>

    <?php 
                    
        if(empty($filteredActivities)){ ?>        
        <div style="text-align:center;border:5px solid #fff; padding-top:20px;"><?php echo"No records found for the provided Range.";?></div>
        <?php 
    }
    }else{print_r("Please choose a valid Range.");}

}
add_action( 'wp_ajax_getFilteredActivitiesByDate', 'getFilteredActivitiesByDate' );

function constructDataGrid(){
    global $wpdb;
    global $current_user;
    $currentUserId = $current_user->id;
    $e =$_GET['startDate'];
    $p =$_GET['endDate'];  
    $chosenStartDate = date("Y-m-d", strtotime($e));
    $chosenEndDate = date("Y-m-d", strtotime($p)); 
    $selqry = "select *,date(addedon) from wp_nutri_calculation where date(addedon) BETWEEN '$chosenStartDate' AND '$chosenEndDate' AND user_id = $currentUserId ";
    $filteredActivities = $wpdb->get_results($selqry);
//    print_r($filteredActivities);
    echo json_encode($filteredActivities);
}
add_action( 'wp_ajax_constructDataGrid', 'constructDataGrid' );

function updateDataGrid(){
     global $wpdb;
     $activityName = $_GET['actName'];
     $selectedDate = $_GET['selectedDate'];
     $tcal = $_GET['tcal'];
     $weight = $_GET['weight'];
     $duration = $_GET['duration'];
     $rowId = $_GET['id'];
     $updateRow = "UPDATE wp_nutri_calculation SET addedon = '$selectedDate',activity_name = '$activityName' ,weight = $weight,duration = $duration,todayReq_calories = $tcal WHERE id = $rowId  ";
//      $updateRow = "UPDATE wp_nutri_calculation SET addedon = $selectedDate,activity_name = $activityName ,weight = $weight,duration = $duration,todayReq_calories = $tcal,activity_name = $activityName WHERE id = $rowId  ";
     $wpdb->query($wpdb->prepare($updateRow));
     echo "success";
}
add_action( 'wp_ajax_updateDataGrid', 'updateDataGrid' );
function insertDataGrid(){
     global $wpdb;
     global $current_user;
     $currentUserId = $current_user->id;
     $activityName = $_GET['actName'];
     $selectedDate = $_GET['selectedDate'];
     $tcal = $_GET['tcal'];
     $weight = $_GET['weight'];
     $duration = $_GET['duration'];print_r($activityName);
     $rowId = $_GET['id'];echo $selectedDate;
     $insertRow = "INSERT INTO wp_nutri_calculation (activity_name, weight,duration,todayReq_calories ,addedon) VALUES ( '$activityName', '$weight', '$duration', '$tcal', '$selectedDate')";
     echo $insertRow; 
//     echo $tcal; echo $weight; echo $duration;
     $wpdb->query($wpdb->prepare($insertRow));
     echo "success2";
}
add_action( 'wp_ajax_insertDataGrid', 'insertDataGrid' );
function deleteDataGrid(){
     global $wpdb;
     $rowId = $_GET['id'];
     $deleteRow = "DELETE FROM wp_nutri_calculation WHERE id = $rowId ";     
     $wpdb->query($wpdb->prepare($deleteRow));
     echo "success3";
}
add_action( 'wp_ajax_deleteDataGrid', 'deleteDataGrid' );
//Recommended product function ends

//2L

//Recommended product with filters function starts
function productWithFilterAjax($afArr){
	global $wpdb;
	
	//Getting the passed values
	$filterArr = $filterArrRange = $filterArrVal = array();
	$filterArr = $_GET['passFilter'];	
	$sortArr = explode("#@#@#",$_GET['passSort']);
	
	//Declaration
	$definFilters = array();
	$definFilters["PRICE"] = 'NA';
	$definFilters["SHAKEBOT RATING"] = $sortArr[2]; //Total Score
	$definFilters["AMAZON RATING"] = 'NA';
	$definFilters["PROTEIN PER SERVING"] = 'protein'; //Additional BCAAs (g)
	$definFilters["CARBS PER SERVING"] = 'totcarbohydrate'; //Dietary Fiber (g)
	$definFilters["SUGAR PER SERVING"] = 'sugars'; //Protein (g)
	$definFilters["FAT PER SERVING"] = 'totalfat'; //Saturated Fat (g)
	$definFilters["CALORIES PER SERVING"] = 'calories'; //Calories from Fat
	
	//echo "Filer Arr = ";print_r($filterArr);
	//echo "Sort Arr = ";print_r($sortArr);
	
	//Query initialization
	$selqry = "select Id,productname,productimage,ratioctop,servingsize,asin,RhiTotalScore,SkillTotalScore,EndTotalScore,calories,protein,priprotein,totcarbohydrate,sugars,totalfat from wp_recommended_products where 1";
		
	if(count($filterArr)>0){ //For filters
		
		$priceFilterFlg = 0;
		$priceOrderFlg = 0;
		$priceMinMaxArr = array();
		
		//Query formation
		for($j=0;$j<count($filterArr[0]);$j++){						
			
			if($filterArr[0][$j] == "PRICE"){ //Enabling the price filter flg
				$priceFilterFlg = 1;
				$priceMinMaxArr = explode(" - ", $filterArr[1][$j]);;
			}
			
			if($definFilters[$filterArr[0][$j]] != 'NA'){ //NA is here
				if($definFilters[$filterArr[0][$j]] == '' && $filterArr[0][$j] != "SHAKEBOT RATING"){
					$selqry .= " and company like '%".$filterArr[0][$j]."%'";
				}else{			
					if(($filterArr[0][$j] == "SHAKEBOT RATING" && $definFilters[$filterArr[0][$j]] == '')){
						$minMaxArr = array();
						$minMaxArr = explode(" - ", $filterArr[1][$j]);
						$selqry .= " and (";
						$selqry .= " ( RhiTotalScore >= ".$minMaxArr[0]." and RhiTotalScore <= ".$minMaxArr[1].")";
						$selqry .= " or ( EndTotalScore >= ".$minMaxArr[0]." and EndTotalScore <= ".$minMaxArr[1].")";
						$selqry .= " or ( SkillTotalScore >= ".$minMaxArr[0]." and SkillTotalScore <= ".$minMaxArr[1].")";
						$selqry .= " ) ";
					}else{
						$minMaxArr = array();
						$minMaxArr = explode(" - ", $filterArr[1][$j]);
						$selqry .= " and";
						$selqry .= " (".$definFilters[$filterArr[0][$j]]." >= ".$minMaxArr[0]." and ".$definFilters[$filterArr[0][$j]]." <= ".$minMaxArr[1].")";
					}
				}
			}
		}
	}
	
	//Query not in
	if($sortArr[3] != ''){
		$sortArr[3] = ltrim($sortArr[3],",");
		$selqry .= " and Id not in (".$sortArr[3].")";
	}
	
	//for Testing
	//$selqry .= " and Id in (17,18,19,20,21,22,23,24,25,26,27,28,29,31,34,35,36,37,38,39)";
			
	//Query order by
	if($sortArr[0] == 'PRICE'){
		$priceOrderFlg = 1;
	}else{
		if($sortArr[0] != ''){			
			if($definFilters[$sortArr[0]] != 'NA' && trim($definFilters[$sortArr[0]]) != ''){ //NA is here
				$selqry .= " order by ".$definFilters[$sortArr[0]];
			}else if(trim($definFilters["SHAKEBOT RATING"]) != ''){
				$selqry .= " order by ".$definFilters["SHAKEBOT RATING"];
			}else{
				$selqry .= " order by RhiTotalScore";
			}
			
			//Query for type of order by
			if($sortArr[1] != ''){
				if($sortArr[1] == 'lth'){
					$selqry .= " asc ";
				}else{
					$selqry .= " desc ";
				}				
			}
		}else{
			if(trim($definFilters["SHAKEBOT RATING"]) != ''){
				$selqry .= " order by ".$definFilters["SHAKEBOT RATING"]." desc";
			}
		}
	}		
		
	//Query results
	$resultsWithFilters1 = array();
	$resultsWithFilters1 = $wpdb->get_results($selqry);       
	$score = $definFilters["SHAKEBOT RATING"];
        
	//For pagination calculation
	$recordPerPage = $totRec = $noofpages = $curpage = $sl = $el = 0; 
	
	$recordPerPage = 9;
	$totRec = count($resultsWithFilters1);
	$noofpages = ceil($totRec/$recordPerPage);
	$curpage = $sortArr[4];
	$sl = ($curpage - 1) * 9;
	$el = $recordPerPage;
		
	//Query with limit
	if($priceOrderFlg == 0 && $priceFilterFlg == 0){
		$selqry .= " limit ".$sl.",".$el;
	}

	$resultsWithFilters = array();
	$resultsWithFilters = $wpdb->get_results($selqry); 
	
	//For getting the price			
	$ptyp = 1;
	$ptyp = $_GET['passType'];
	
	if($priceOrderFlg == 1 || $priceFilterFlg == 1 ){		
		if($ptyp == 1){
			//For getting the price			                    
			for($indk=0;$indk<count($resultsWithFilters);$indk++){
				$urlPass = $seckeyPass = $ul = $asn = '';
				$asn = $resultsWithFilters[$indk]->asin;                             
                                				
				$urlPass = "http://webservices.amazon.com/onca/xml?AWSAccessKeyId=AKIAIWY4V7MWOBW4VWGA&AssociateTag=shak08-20&IdType=ASIN&ItemId=".$asn."&Operation=ItemLookup&ResponseGroup=Offers&Service=AWSECommerceService";

				$seckeyPass = "DwyOiA1Ul8x98Lt7sHMwR3j662ynT9fO3zpV3hsM";
				$ul = signAmazonUrl($urlPass,$seckeyPass);
				$priceArr = getXml($ul);
				$pice = '';
				if($priceArr->Items->Item->OfferSummary->LowestNewPrice->FormattedPrice != ''){
					$pice = $priceArr->Items->Item->OfferSummary->LowestNewPrice->FormattedPrice;
				}elseif($priceArr->Items->Item->Offers->Offer->OfferListing->SalePrice->FormattedPrice != ''){	
					$pice = $priceArr->Items->Item->Offers->Offer->OfferListing->SalePrice->FormattedPrice;
				}else{
					$pice = $priceArr->Items->Item->Offers->Offer->OfferListing->Price->FormattedPrice;									
				}								
				$resultsWithFilters[$indk]->PriceObj = str_replace("$","",$pice);
				usleep(500000);
			}
			$_SESSION['prevArr'] = array();
			$_SESSION['prevArr'] = $resultsWithFilters;
		}else{
			$resultsWithFilters = $_SESSION['prevArr'];
		}
	}	

			
	if($priceFilterFlg == 1){ //Applying the Price Filters
		//$priceMinMaxArr
		$resultsWithFiltersTm = array();
		$resultsWithFiltersTm = $resultsWithFilters;
		$resultsWithFilters = array();
		
		for($indy=0;$indy<count($resultsWithFiltersTm);$indy++){
			if($resultsWithFiltersTm[$indy]->PriceObj>=$priceMinMaxArr[0] && $resultsWithFiltersTm[$indy]->PriceObj<=$priceMinMaxArr[1]){
				$resultsWithFilters[] = $resultsWithFiltersTm[$indy];
			}
		}
		
		$totRec = count($resultsWithFilters);
		$noofpages = ceil($totRec/$recordPerPage);		
	}
	
	if($priceFilterFlg == 1 ||  $priceOrderFlg == 1){ //Applying the Price wise sort
		if($priceOrderFlg == 1){
			$mid = array();
			// Obtain a list of columns
			foreach ($resultsWithFilters as $key => $row) {
				$mid[$key]  = $row->PriceObj;
			}
			
			if($sortArr[1] == 'lth'){		 
				// Sort the data with mid descending
				// Add $data as the last parameter, to sort by the common key
				array_multisort($mid, SORT_ASC, $resultsWithFilters);
			}else{
				// Sort the data with mid descending
				// Add $data as the last parameter, to sort by the common key
				array_multisort($mid, SORT_DESC, $resultsWithFilters);
			}
		}
	}		
	
//	echo "<pre>";print_r($resultsWithFilters);
	
	if($priceFilterFlg == 0 &&  $priceOrderFlg == 0){ //For setting the start and end record
		$lpStart = 0;
		$lpEnd = count($resultsWithFilters);
	}else{
		$lpStart = $sl;
		$lpEnd = $lpStart + 9;
	}
       
	$threeBk = 0;	
	if(count($resultsWithFilters)>0){  //print_r($score);
		for($indj=$lpStart;$indj<$lpEnd;$indj++){
			if($resultsWithFilters[$indj]->asin !='' ){
				if($threeBk == 0){echo "<div class='row'>";};
				$threeBk++;
		?>
                <div id="test-form<?php echo $indj;?>" class="mfp-hide white-popup-block table-responsive">
                        <table class="table-responsive" style="color:black; font-weight:bold; ">
                            <tbody>
                                    <h4 style="text-align:center;color:black;"><?php echo strtoupper($resultsWithFilters[$indj]->productname);?></h4>
                                    <tr><td style="padding-top:50px;" rowspan="6" ><img class="" src="<?php echo $resultsWithFilters[$indj]->productimage;?>" width="100px" height="130px">
                                    </td><td colspan="2" style="text-align:right;color:#00ade7;font-size: 14px;">NUTRITIONAL CONTENTS</td></tr>                                    
                                    <tr><td style="width:60%;text-align: right; font-size: 13px;">CALORIES :</td><td><?php if($resultsWithFilters[$indj]->calories){echo $resultsWithFilters[$indj]->calories."g";}else{echo "-";}?></td></tr>
                                    <tr><td style="width:60%;text-align: right; font-size: 13px;">PROTEIN :</td><td><?php if($resultsWithFilters[$indj]->protein){echo $resultsWithFilters[$indj]->protein."g";}else{echo "-";}?></td></tr>
                                    <tr><td style="width:60%;text-align: right; font-size: 13px;">CARBOHYDRATE :</td><td><?php if($resultsWithFilters[$indj]->totcarbohydrate){echo $resultsWithFilters[$indj]->totcarbohydrate."g";}else{echo "-";}?></td></tr>
                                    <tr><td style="width:60%;text-align: right; font-size: 13px;">SUGARS :</td><td><?php if($resultsWithFilters[$indj]->sugars){echo $resultsWithFilters[$indj]->sugars."g";}else{echo "-";}?></td></tr>
                                    <tr><td style="width:60%;text-align: right; font-size: 13px;">FAT :</td><td><?php if($resultsWithFilters[$indj]->totalfat){echo $resultsWithFilters[$indj]->totalfat."g";}else{echo "-";}?></td></tr> 
                            </tbody>
                    </table>
                </div>
        
                <div id="sb-form<?php echo $indj;?>" class="mfp-hide white-popup-block container table-responsive">                       
                   
                   <div style="margin-top:15px;border:2px solid #fff;padding-top:10px;color:#fff;font-weight:bold;height:50px;font-size:18px; background-color:#ed1c24;text-align:center;">SB RATING</div>         
                    <table class="table" style="width:50%;float:left;">                                    
                        <th colspan="2" style="padding-top: 15px;border-right:2px solid #fff;border-left:2px solid #fff;color:#fff;font-weight:bold;height:60px;font-size:17px;text-align:center;background-color:#00ADE7;">My Nutritional Needs</th>           
                        <tr style="color:#fff; font-weight:bold; height:50px; font-size:16px;">
                                            <td colspan="2" style="padding-top: 11px;border:2px solid #fff;text-align:center; background-color:#00ADE7;width:60%;">Post Exercise</td>		
                                    </tr>

                                    <tr style="background-color:#eee; height:55px;">											
                                            <td style="background-color: #CC9900; color:#fff;border:2px solid #fff; font-size:16px; text-align:center; font-weight:bold;">Calories</td>
                                            <td style="border:2px solid #fff; text-align:center;padding-top:15px;"><?php echo $_SESSION['postExArr']['Calories']; ?></td>		
                                      </tr>	

                                    <tr style="background-color:#eee; height:55px;">											
                                            <td style="background-color: #CC9900;color:#fff;border:2px solid #fff; font-size:16px; text-align:center; font-weight:bold;">Carbohydrate&nbsp;</td>
                                            <td style="border:2px solid #fff; text-align:center;padding-top:15px;"><?php echo $_SESSION['postExArr']['Carbohydrate'];?></td>		
                                    </tr>

                                    <tr style="background-color:#eee; height:55px;">											
                                            <td style="background-color: #CC9900;color:#fff;border:2px solid #fff; font-size:16px; text-align:center; font-weight:bold;">Protein</td>
                                            <td style="border:2px solid #fff; text-align:center;padding-top:15px;"><?php echo $_SESSION['postExArr']['Protein'];?></td>		
                                    </tr>

                                    <tr style="background-color:#eee; height:60px;">											
                                            <td style="background-color: #CC9900;color:#fff;border:2px solid #fff; font-size:16px; text-align:center; font-weight:bold;">Fat</td>
                                            <td style="border:2px solid #fff; text-align:center;padding-top:15px;"><?php echo $_SESSION['postExArr']['Fat'];?></td>		
                                    </tr>
                            </table> 
                    
                            <table class="table" style="width:49%;float:left;">
                                <th colspan="2" style="padding-top:30px;border-bottom:2px solid #fff;color:#fff;font-weight:bold;height:110px;width: 300px;font-size:17px;text-align:center;background-color:#00ADE7;"><?php echo $resultsWithFilters[$indj]->productname;?></th>                                                                    
                                <tbody style="border-right:2px solid #fff;border:5px solid #fff;background-color:#CC9900;color:#fff;font-weight:bold;height:233px;padding: 10px 10px 10px 10px">                                
                                <tr><td style="width:60%;text-align: right; font-size: 16px;">Per Serving :</td><td><?php if($resultsWithFilters[$indj]->servingsize){echo $resultsWithFilters[$indj]->servingsize;}else{echo "-";}?></td></tr>
                                    <tr><td style="width:60%;text-align: right; font-size: 16px;">Calories :</td><td><?php if($resultsWithFilters[$indj]->calories){echo $resultsWithFilters[$indj]->calories."g";}else{echo "-";}?></td></tr>
                                    <tr><td style="width:60%;text-align: right; font-size: 16px;">Carbohydrate :</td><td><?php if($resultsWithFilters[$indj]->totcarbohydrate){echo $resultsWithFilters[$indj]->totcarbohydrate."g";}else{echo "-";}?></td></tr>
                                    <tr><td style="width:60%;text-align: right; font-size: 16px;">Protein :</td><td><?php if($resultsWithFilters[$indj]->protein){echo $resultsWithFilters[$indj]->protein."g";}else{echo "-";}?></td></tr>                                    
                                    <tr><td style="width:60%;text-align: right; font-size: 16px;">Fat :</td><td><?php if($resultsWithFilters[$indj]->totalfat){echo $resultsWithFilters[$indj]->totalfat."g";}else{echo "-";}?></td></tr> 
                                    </tbody>
                            </table>
                </div>
                                    
		<div class="col-md-4 table-responsive" style="border:0px solid red; padding:10px; float:left;">										
			<table class="table" style="background-color:#eee; margin:2px; width:255px;">
				<tbody>		
                                                        
                                     <tr> 
                                         <td rowspan="2" id="prodrating" style="padding-top:55px;padding-left:8px;width:90px; color: #fff;font-weight:bold;background-color:#eee;">
                                            <a class="popup-with-form" style="padding-left:15px;" href="#sb-form<?php echo $indj;?>">
                                                <img src="<?php echo site_url(); ?>/wp-content/uploads/2015/10/sbscore.png" height=45 width=45></a>
                                            <a class="popup-with-form" href="#sb-form<?php echo $indj;?>">                                                                                                      
                                            <?php if($resultsWithFilters[$indj]->$score >=0 && $resultsWithFilters[$indj]->$score <50){$color='#ed1c24';echo "<div style='margin-left:2px;' class='red'>".round($resultsWithFilters[$indj]->$score)."</div>";                      
                                            }else if($resultsWithFilters[$indj]->$score >=50 && $resultsWithFilters[$indj]->$score <80){$color='#ffb31a';echo "<div style='margin-left:2px;' class='orange'>".round($resultsWithFilters[$indj]->$score)."</div>"; 
                                            }else if($resultsWithFilters[$indj]->$score >=80 && $resultsWithFilters[$indj]->$score <=100){$color='#4CAF50';echo "<div style='margin-left:2px;' class='green'>".round($resultsWithFilters[$indj]->$score)."</div>";         
                                            }else{} ?> 
                                            </a></td> 
                                         </td>                              
                                         <td id="prodname" style="padding-top:20px;padding-bottom: 20px;text-align: center;font-weight:bold ; background-color:#00ADE7;" colspan="2" >
                                             <a class="popup-with-form" style="color:#fff" href="#test-form<?php echo $indj;?>">
                                            <?php  
								if($resultsWithFilters[$indj]->productname == ''){
									echo "-";
								}else{
									if(strlen($resultsWithFilters[$indj]->productname) <= 12){
										echo $resultsWithFilters[$indj]->productname;
									}else{
										echo substr($resultsWithFilters[$indj]->productname,0,12); echo "...";
									}
								}
                                            ?></a>
                                        </td>
                                    </tr>
                                        <tr>                                                                         
                                            <td id="prodimg" style="padding-top:10px;padding-left:31px; background-color:#00ADE7;">
                                                <a class="popup-with-form" href="#test-form<?php echo $indj;?>">
                                                    <img src="<?php echo $resultsWithFilters[$indj]->productimage;?>" width="100px" height="130px">
                                                </a>
                                            </td>
                                        </tr>  
                                        <tr>
                                            <td colspan="2"style="padding:10px 0px 11px 72px;">
                                                <a rel="nofollow" href="http://www.amazon.com/gp/product/<?php echo $asin;?>?ie=UTF8&camp=1789&creativeASIN=<?php echo $asin;?>&linkCode=xm2&tag=shak08-20" target="_blank">
                                                    <input id="buynowid" name="buynowid" type="button" value="BUY NOW" class="pbSubmit4" style="background: none repeat scroll 0 0 #0F3154; color:#fff;font-size:13px;">
                                                </a>
                                            </td>
                                        </tr>                                    
				</tbody>
			</table>
		</div>
	<?php
		if($threeBk == 3){$threeBk =0;echo "</div>";};
	?>	
	<?php }}}else{ ?>
		<table class="table" style="background-color:#eee;">
			<tbody>
				<tr style="font-size:20px;">
					<td style="padding-top:15px;" rowspan="4">
						No Products available.
					</td>
				</tr>				
			</tbody>
		</table>	
		<table class="table" style="background-color:#eee;">
			<tr style="height:450px;background-color:#fff;">
				<td>&nbsp;</td>
			</tr>	
		</table>
	<?php }
	echo "#$#$#";
	showingPagination($totRec,$noofpages,$curpage,$sl,$el); //For showing the pagination
}

add_action( 'wp_ajax_productWithFilterAjax', 'productWithFilterAjax' );

//For showing the pagination in the my recommended product page
function showingPagination($totRecpass,$noofpagespass,$curpagepass,$slpass,$elpass){
	$args = array(
				'base'               => '%_%',
				'format'             => '?page=%#%',
				'total'              => $noofpagespass, //No of pages
				'current'            => $curpagepass, //Current page no
				'show_all'           => False,
				'end_size'           => 1,
				'mid_size'           => 2,
				'prev_next'          => True,
				'prev_text'          => __('« Previous'),
				'next_text'          => __('Next »'),
				'type'               => 'list123',
				'add_args'           => False,
				'add_fragment'       => '',
				'before_page_number' => '',
				'after_page_number'  => ''
			);
	
	echo paginate_links( $args );	
}

//For getting the value from the XML
function getXml($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    $result = curl_exec($ch);
    curl_close($ch);

    return simplexml_load_string($result);
}

//For forming the signed URL
function signAmazonUrl($url, $secret_key)
{
    $original_url = $url;

    // Decode anything already encoded
    $url = urldecode($url);

    // Parse the URL into $urlparts
    $urlparts       = parse_url($url);

    // Build $params with each name/value pair
    foreach (split('&', $urlparts['query']) as $part) {
        if (strpos($part, '=')) {
            list($name, $value) = split('=', $part, 2);
        } else {
            $name = $part;
            $value = '';
        }
        $params[$name] = $value;
    }

    // Include a timestamp if none was provided
    if (empty($params['Timestamp'])) {
        $params['Timestamp'] = gmdate('Y-m-d\TH:i:s\Z');
    }

    // Sort the array by key
    ksort($params);

    // Build the canonical query string
    $canonical       = '';    
    foreach ($params as $key => $val) {
        $canonical  .= "$key=".rawurlencode(utf8_encode($val))."&";
    }    
    // Remove the trailing ampersand
    $canonical       = preg_replace("/&$/", '', $canonical);

    // Some common replacements and ones that Amazon specifically mentions
    $canonical       = str_replace(array(' ', '+', ',', ';'), array('%20', '%20', urlencode(','), urlencode(':')), $canonical);

    // Build the sign
    $string_to_sign             = "GET\n{$urlparts['host']}\n{$urlparts['path']}\n$canonical";
    // Calculate our actual signature and base64 encode it
    $signature            = base64_encode(hash_hmac('sha256', $string_to_sign, $secret_key, true));

    // Finally re-build the URL with the proper string and include the Signature
    $url = "{$urlparts['scheme']}://{$urlparts['host']}{$urlparts['path']}?$canonical&Signature=".rawurlencode($signature);
    return $url;
}

//Recommended product with filters function ends

//Nutrition calculation AJAX ends

/*********************** Ajax Call Ends **********************************/
?>