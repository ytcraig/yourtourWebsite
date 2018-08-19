<?php

// Add styles.js
function add_main_js() {

wp_enqueue_style( 'my-styles',
get_template_directory_uri() . '/css/style.css', null);

if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
	}
	wp_deregister_script( 'wp-embed' );
  wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');
  wp_enqueue_script('main.js', get_template_directory_uri() . '/js/paginate.js', true);
  wp_enqueue_script('main.js', get_template_directory_uri() . '/js/scripts.js', true);



}
add_action( 'wp_enqueue_scripts', 'add_main_js' );
