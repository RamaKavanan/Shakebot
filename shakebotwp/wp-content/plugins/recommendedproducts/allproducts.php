<?php
/*
Plugin Name: Recommended products
Description: Plugin for the recommended products
Author: Saravanan.S
Version: 0.1
*/

add_action('admin_menu', 'rp_plugin_setup_menu');
 
function rp_plugin_setup_menu(){
        add_menu_page( 'Recommended Plugin Page', 'Recommended Products', 'edit_pages', 'rp-plugin', 'rp_admin_options_page' );
}
 
function rp_admin_options_page(){
	if (isset($_GET["cal"]) && $_GET["cal"] == 'newproduct'){
        @include_once dirname( __FILE__ ) . '/newproduct.php';
	}elseif($_GET["cal"] == 'delproduct'){
		@include_once dirname( __FILE__ ) . '/delproduct.php';
	}elseif($_GET["cal"] == 'importproduct'){
		@include_once dirname( __FILE__ ) . '/importproduct.php';	
	}else{
		@include_once dirname( __FILE__ ) . '/viewproducts.php';
	}
}?>
