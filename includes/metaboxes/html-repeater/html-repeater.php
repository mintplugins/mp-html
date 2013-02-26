<?php
/**
 * Function which creates new Meta Box
 *
 */
function mp_html_in_post_create_meta_box(){	
	/**
	 * Array which stores all info about the new metabox
	 *
	 */
	$mp_html_in_post_add_meta_box = array(
		'metabox_id' => 'html_metabox', 
		'metabox_title' => __( 'HTML Sections', 'mp_core'), 
		'metabox_posttype' => 'post', 
		'metabox_context' => 'advanced', 
		'metabox_priority' => 'high' 
	);
	
	/**
	 * Array which stores all info about the options within the metabox
	 *
	 */
	$mp_html_in_post_items_array = array(
		array(
			'field_id'			=> 'html_box',
			'field_title' 	=> __( 'Enter some HTML', 'mp_core'),
			'field_description' 	=> 'Paste your HTML code here:',
			'field_type' 	=> 'textarea',
			'field_repeater' => 'html_repeater',
			'field_value' => ''
		)
	);
	
	
	/**
	 * Custom filter to allow for add-on plugins to hook in their own data for add_meta_box array
	 */
	$mp_html_in_post_add_meta_box = has_filter('mp_html_in_post_meta_box_array') ? apply_filters( 'mp_html_in_post_meta_box_array', $mp_html_in_post_add_meta_box) : $mp_html_in_post_add_meta_box;
	
	/**
	 * Custom filter to allow for add on plugins to hook in their own extra fields 
	 */
	$mp_html_in_post_items_array = has_filter('mp_html_in_post_items_array') ? apply_filters( 'mp_html_in_post_items_array', $mp_html_in_post_items_array) : $mp_html_in_post_items_array;
	
	
	/**
	 * Create Metabox class
	 */
	global $mp_html_in_post_metabox;
	$mp_html_in_post_metabox = new MP_CORE_Metabox($mp_html_in_post_add_meta_box, $mp_html_in_post_items_array);
}
add_action('plugins_loaded', 'mp_html_in_post_create_meta_box');

/**
 * Enqueue Additional Custom Scripts for the metabox class
 */
function mp_html_in_post_customscript(){
	//custom script
	wp_enqueue_script( 'customjs', plugins_url( '/mp_html_in_post/includes/js/customjs.js' ),  array( 'jquery' ) );	
	//custom style
	wp_enqueue_style( 'custom_css', plugins_url() . '/mp_html_in_post/includes/css/style.css' );
}
//add_action('mp_core_' . $mp_html_in_post_add_meta_box['metabox_id'] . '_metabox_custom_scripts', 'mp_html_in_post_customscript');

/**
 * Shortcode which is used to display the HTML content on a post
 */
function mp_html_in_post_display_html( $atts ) {
	global $mp_html_in_post_metabox;
	$vars =  shortcode_atts( array('repeater_number' => '0'), $atts );
	$vars['repeater_number'] = intval($vars['repeater_number'])-1;
	
	//Get all the fields in a specific repeater to an array
	$html_snippets = get_post_meta( get_the_ID(), $key = 'html_repeater', $single = true );
	
	//Get a specific field from that array
	return '<pre><pre class="brush: js;">' . $html_snippets[$vars['repeater_number']]['html_box'] . '</pre></pre>';
}
add_shortcode( 'display_html', 'mp_html_in_post_display_html' );
