<?php
/**
 * WordPress Administration Template Header
 *
 * @package WordPress
 * @subpackage Administration
 */

@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));
if ( ! defined( 'WP_ADMIN' ) )
	require_once( dirname( __FILE__ ) . '/admin.php' );

/**
 * In case admin-header.php is included in a function.
 *
 * @global string    $title
 * @global string    $hook_suffix
 * @global WP_Screen $current_screen
 * @global WP_Locale $wp_locale
 * @global string    $pagenow
 * @global string    $wp_version
 * @global string    $update_title
 * @global int       $total_update_count
 * @global string    $parent_file
 */
global $title, $hook_suffix, $current_screen, $wp_locale, $pagenow, $wp_version,
	$update_title, $total_update_count, $parent_file;

// Catch plugins that include admin-header.php before admin.php completes.
if ( empty( $current_screen ) )
	set_current_screen();

get_admin_page_title();
$title = esc_html( strip_tags( $title ) );

if ( is_network_admin() )
	$admin_title = sprintf( __( 'Network Admin: %s' ), esc_html( get_current_site()->site_name ) );
elseif ( is_user_admin() )
	$admin_title = sprintf( __( 'User Dashboard: %s' ), esc_html( get_current_site()->site_name ) );
else
	$admin_title = get_bloginfo( 'name' );

if ( $admin_title == $title )
	$admin_title = sprintf( __( '%1$s &#8212; WordPress' ), $title );
else
	$admin_title = sprintf( __( '%1$s &lsaquo; %2$s &#8212; WordPress' ), $title, $admin_title );

/**
 * Filter the title tag content for an admin page.
 *
 * @since 3.1.0
 *
 * @param string $admin_title The page title, with extra context added.
 * @param string $title       The original page title.
 */
$admin_title = apply_filters( 'admin_title', $admin_title, $title );

wp_user_settings();

_wp_admin_html_begin();
?>
<title><?php echo $admin_title; ?></title>
<?php

wp_enqueue_style( 'colors' );
wp_enqueue_style( 'ie' );
wp_enqueue_script('utils');
wp_enqueue_script( 'svg-painter' );

$admin_body_class = preg_replace('/[^a-z0-9_-]+/i', '-', $hook_suffix);
?>
<script type="text/javascript">
addLoadEvent = function(func){if(typeof jQuery!="undefined")jQuery(document).ready(func);else if(typeof wpOnload!='function'){wpOnload=func;}else{var oldonload=wpOnload;wpOnload=function(){oldonload();func();}}};
var ajaxurl = '<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>',
	pagenow = '<?php echo $current_screen->id; ?>',
	typenow = '<?php echo $current_screen->post_type; ?>',
	adminpage = '<?php echo $admin_body_class; ?>',
	thousandsSeparator = '<?php echo addslashes( $wp_locale->number_format['thousands_sep'] ); ?>',
	decimalPoint = '<?php echo addslashes( $wp_locale->number_format['decimal_point'] ); ?>',
	isRtl = <?php echo (int) is_rtl(); ?>;
</script>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<?php

/**
 * Enqueue scripts for all admin pages.
 *
 * @since 2.8.0
 *
 * @param string $hook_suffix The current admin page.
 */
do_action( 'admin_enqueue_scripts', $hook_suffix );

/**
 * Fires when styles are printed for a specific admin page based on $hook_suffix.
 *
 * @since 2.6.0
 */
do_action( "admin_print_styles-$hook_suffix" );

/**
 * Fires when styles are printed for all admin pages.
 *
 * @since 2.6.0
 */
do_action( 'admin_print_styles' );

/**
 * Fires when scripts are printed for a specific admin page based on $hook_suffix.
 *
 * @since 2.1.0
 */
do_action( "admin_print_scripts-$hook_suffix" );

/**
 * Fires when scripts are printed for all admin pages.
 *
 * @since 2.1.0
 */
do_action( 'admin_print_scripts' );

/**
 * Fires in head section for a specific admin page.
 *
 * The dynamic portion of the hook, `$hook_suffix`, refers to the hook suffix
 * for the admin page.
 *
 * @since 2.1.0
 */
do_action( "admin_head-$hook_suffix" );

/**
 * Fires in head section for all admin pages.
 *
 * @since 2.1.0
 */
do_action( 'admin_head' );

if ( get_user_setting('mfold') == 'f' )
	$admin_body_class .= ' folded';

if ( !get_user_setting('unfold') )
	$admin_body_class .= ' auto-fold';

if ( is_admin_bar_showing() )
	$admin_body_class .= ' admin-bar';

if ( is_rtl() )
	$admin_body_class .= ' rtl';

if ( $current_screen->post_type )
	$admin_body_class .= ' post-type-' . $current_screen->post_type;

if ( $current_screen->taxonomy )
	$admin_body_class .= ' taxonomy-' . $current_screen->taxonomy;

$admin_body_class .= ' branch-' . str_replace( array( '.', ',' ), '-', floatval( $wp_version ) );
$admin_body_class .= ' version-' . str_replace( '.', '-', preg_replace( '/^([.0-9]+).*/', '$1', $wp_version ) );
$admin_body_class .= ' admin-color-' . sanitize_html_class( get_user_option( 'admin_color' ), 'fresh' );
$admin_body_class .= ' locale-' . sanitize_html_class( strtolower( str_replace( '_', '-', get_locale() ) ) );

if ( wp_is_mobile() )
	$admin_body_class .= ' mobile';

if ( is_multisite() )
	$admin_body_class .= ' multisite';

if ( is_network_admin() )
	$admin_body_class .= ' network-admin';

$admin_body_class .= ' no-customize-support no-svg';

?>
</head>
<?php
/**
 * Filter the CSS classes for the body tag in the admin.
 *
 * This filter differs from the {@see 'post_class'} and {@see 'body_class'} filters
 * in two important ways:
 *
 * 1. `$classes` is a space-separated string of class names instead of an array.
 * 2. Not all core admin classes are filterable, notably: wp-admin, wp-core-ui,
 *    and no-js cannot be removed.
 *
 * @since 2.3.0
 *
 * @param string $classes Space-separated list of CSS classes.
 */
$admin_body_classes = apply_filters( 'admin_body_class', '' );
?>
<body class="wp-admin wp-core-ui no-js <?php echo $admin_body_classes . ' ' . $admin_body_class; ?>">
<script type="text/javascript">
	document.body.className = document.body.className.replace('no-js','js');
</script>

<?php
// Make sure the customize body classes are correct as early as possible.
if ( current_user_can( 'customize' ) ) {
	wp_customize_support_script();
}
?>

<div id="wpwrap">
<?php require(ABSPATH . 'wp-admin/menu-header.php'); ?>
<div id="wpcontent">

<?php
/**
 * Fires at the beginning of the content section in an admin page.
 *
 * @since 3.0.0
 */
do_action( 'in_admin_header' );
?>

<div id="wpbody" role="main">
<?php
unset($title_class, $blog_name, $total_update_count, $update_title);

$current_screen->set_parentage( $parent_file );

?>

<div id="wpbody-content" aria-label="<?php esc_attr_e('Main content'); ?>" tabindex="0">
<?php

$current_screen->render_screen_meta();

if ( is_network_admin() ) {
	/**
	 * Print network admin screen notices.
	 *
	 * @since 3.1.0
	 */
	do_action( 'network_admin_notices' );
} elseif ( is_user_admin() ) {
	/**
	 * Print user admin screen notices.
	 *
	 * @since 3.1.0
	 */
	do_action( 'user_admin_notices' );
} else {
	/**
	 * Print admin screen notices.
	 *
	 * @since 3.1.0
	 */
	do_action( 'admin_notices' );
}

/**
 * Print generic admin screen notices.
 *
 * @since 3.1.0
 */
do_action( 'all_admin_notices' );

if ( $parent_file == 'options-general.php' ){
	require(ABSPATH . 'wp-admin/options-head.php');
}
?>
<!-- Customize starts -->

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>



<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  $(document).ready(function(){
	  
 $('#sports').change(function(){
    var chngvalue = $(this).val();

if (chngvalue == "Softball") {
    $('#position').replaceWith('<select id="position" class="small" name="position"><option value="Infielder">Infielder</option><option value="Outfielder">Outfielder</option><option value="Designated Hitter">Designated Hitter</option><option value="Catcher">Catcher</option><option value="Pitcher">Pitcher</option></select>')
} else if (chngvalue == "Baseball") {
	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Infielder">Infielder</option><option value="Outfielder">Outfielder</option><option value="Designated Hitter">Designated Hitter</option><option value="Catcher">Catcher</option><option value="Pitcher">Pitcher</option></select>')
} else if (chngvalue == "American Football") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Wide Receiver">Wide Receiver</option><option value="Running Back">Running Back</option><option value="Special Teams">Special Teams</option><option value="Quarterback">Quarterback</option><option value="Tight End">Tight End</option><option value="Linebacker">Linebacker</option><option value="Lineman">Lineman</option><option value="Defensive Back">Defensive Back</option></select>')
} else if (chngvalue == "Basketball") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Forward">Forward</option><option value="Guard">Guard</option><option value="Center">Center</option>[&quot;Forward&quot;, &quot;Guard&quot;, &quot;Center&quot;]</select>')
} else if (chngvalue == "Cardio Training") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="High Intensity Bouts">High Intensity Bouts</option><option value="Moderate Intensity">Moderate Intensity</option><option value="Low Intensity">Low Intensity</option><option value="Intervals">Intervals</option><option value="Tabatas">Tabatas</option><option value="Moderate Pace and Intensity">Moderate Pace and Intensity</option><option value="Fat Loss">Fat Loss</option></select>')
} else if (chngvalue == "Swimming") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Short Distance (&lt; 200m)">Short Distance (&lt; 200m)</option><option value="Middle Distance (200m - 500m)">Middle Distance (200m - 500m)</option><option value="Long Distance (&gt;500m)">Long Distance (&gt;500m)</option></select>')
} else if (chngvalue == "Running") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Long Distance (&gt; 800m)">Long Distance (&gt; 800m)</option><option value="Middle Distance (150m - 800m)">Middle Distance (150m - 800m)</option><option value="Sprints (30m - 100m)">Sprints (30m - 100m)</option></select>')
} else if (chngvalue == "Field Hockey") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Goalie">Goalie</option><option value="Defense">Defense</option><option value="Midfielder">Midfielder</option><option value="Striker">Striker</option></select>')
} else if (chngvalue == "Gymnastics") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Floor Exercise">Floor Exercise</option><option value="Balance Beam">Balance Beam</option><option value="Uneven Bars">Uneven Bars</option><option value="Vault">Vault</option></select>')
} else if (chngvalue == "Ice Hockey") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Goalie">Goalie</option><option value="Defenseman">Defenseman</option><option value="Forward">Forward</option></select>')
} else if (chngvalue == "Lacrosse") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Forward">Forward</option><option value="Defenseman">Defenseman</option><option value="Midfielder">Midfielder</option><option value="Goalie">Goalie</option></select>')
} else if (chngvalue == "Snow Sports") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Skiing - Cross Country">Skiing - Cross Country</option><option value="Skiing - Alpine">Skiing - Alpine</option><option value="Skiing - Ski Jumping">Skiing - Ski Jumping</option></select>')
} else if (chngvalue == "Soccer") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Forward">Forward</option><option value="Defenseman">Defenseman</option><option value="Midfielder">Midfielder</option><option value="Goalie">Goalie</option></select>')
} else if (chngvalue == "Track and Field") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Sprints (&lt; 400m)">Sprints (&lt; 400m)</option><option value="Middle Distance (400m - 30000m)">Middle Distance (400m - 30000m)</option><option value="Long Distance (&gt; 3000m)">Long Distance (&gt; 3000m)</option><option value="Jumping - High Jump">Jumping - High Jump</option><option value="Jumping - Triple Jump">Jumping - Triple Jump</option><option value="Jumping - Long Jump">Jumping - Long Jump</option><option value="Jumping - Pole Vault">Jumping - Pole Vault</option><option value="Throwing - Shotput">Throwing - Shotput</option><option value="Throwing - Javelin">Throwing - Javelin</option><option value="Throwing - Hammer">Throwing - Hammer</option><option value="Throwing - Discus">Throwing - Discus</option></select>')
} else if (chngvalue == "Long Distance Event") {
  	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Triathalon">Triathalon</option><option value="Marathon">Marathon</option><option value="Ultramarathon">Ultramarathon</option><option value="Iron Man">Iron Man</option></select>')
} else if (chngvalue == "Volleyball") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="Outside Hitter">Outside Hitter</option><option value="Middle Blocker">Middle Blocker</option><option value="Setter">Setter</option><option value="Libero/Defensive Specialist">Libero/Defensive Specialist</option></select>')
} else if (chngvalue == "Resistance Training") {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value="High Intensity">High Intensity</option><option value="Moderate Intensity">Moderate Intensity</option><option value="Low Intensity">Low Intensity</option><option value="Fat Loss">Fat Loss</option><option value="Circuit Training">Circuit Training</option></select>')
} else {
   	$('#position').replaceWith('<select id="position" class="small" name="position"><option value=""><p><em>No Position</em></p></option></select>')
}


});
});
  
</script>
<!-- Customize ends -->
