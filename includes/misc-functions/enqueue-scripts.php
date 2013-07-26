<?php
/**
 * Enqueue Syntax Highlighter Scripts and Styles
 * http://alexgorbatchev.com/SyntaxHighlighter/manual/installation.html
 */
 
function mp_html_enqueue_scripts(){
	//sh scripts 
	wp_enqueue_script( 'shCore', plugins_url( '/js/shCore.js', dirname(__FILE__) ),  array( 'jquery' ) );	
	wp_enqueue_script( 'shBrushJScript', plugins_url( '/js/shBrushJScript.js', dirname(__FILE__) ),  array( 'jquery', 'shCore' ) );	
	wp_enqueue_script( 'enableSyntaxHighlighter', plugins_url( '/js/enableSyntaxHighlighter.js', dirname(__FILE__) ),  array( 'jquery', 'shBrushJScript', 'shCore' ) );	
	//sh styles
	wp_enqueue_style( 'shCoreDefault', plugins_url( '/css/shCoreDefault.css', dirname(__FILE__) ));	
}
add_action('wp_enqueue_scripts', 'mp_html_enqueue_scripts');
