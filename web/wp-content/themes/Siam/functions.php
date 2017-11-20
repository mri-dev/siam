<?php
define('PROTOCOL', 'https');
define('TARGETDOMAIN', 'dev.siamthaimasszazs.hu');
define('DOMAIN', $_SERVER['HTTP_HOST']);
define('IFROOT', str_replace(get_option('siteurl'), '//'.DOMAIN, get_stylesheet_directory_uri()));
define('DEVMODE', true);
define('IMG', IFROOT.'/images');
//define('GOOGLE_API_KEY', 'AIzaSyA0Mu8_XYUGo9iXhoenj7HTPBIfS2jDU2E');
define('GOOGLE_API_KEY', 'AIzaSyD99pf6f7JFVgvmiieIvtlJyMlS15I36qg');
define('LANGKEY','hu');
define('FB_APP_ID', '');
define('DEFAULT_LANGUAGE', 'hu_HU');

function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'avada-stylesheet' ) );
    wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function custom_theme_enqueue_styles() {
  wp_enqueue_style( 'app-css', IFROOT . '/assets/css/style.css?t=' . ( (DEVMODE === true) ? time() : '' ) );
}
add_action( 'wp_enqueue_scripts', 'custom_theme_enqueue_styles', 100 );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );
