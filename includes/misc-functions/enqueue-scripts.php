<?php
/**
 * Enqueue Syntax Highlighter Scripts and Styles
 * http://alexgorbatchev.com/SyntaxHighlighter/manual/installation.html
 */
 
function mp_html_enqueue_scripts(){
	//sh scripts 
	wp_enqueue_script( 'shCore', plugins_url( '/mp_html/includes/js/shCore.js' ),  array( 'jquery' ) );	
	wp_enqueue_script( 'shBrushJScript', plugins_url( '/mp_html/includes/js/shBrushJScript.js' ),  array( 'jquery', 'shCore' ) );	
	wp_enqueue_script( 'enableSyntaxHighlighter', plugins_url( '/mp_html/includes/js/enableSyntaxHighlighter.js' ),  array( 'jquery', 'shBrushJScript', 'shCore' ) );	
	//sh styles
	wp_enqueue_style( 'shCoreDefault', plugins_url( '/mp_html/includes/css/shCoreDefault.css' ));	
}
add_action('wp_enqueue_scripts', 'mp_html_enqueue_scripts');
