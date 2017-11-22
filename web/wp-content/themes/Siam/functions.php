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

// Includes
require_once "includes/include.php";

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

/**
* AJAX REQUESTS
*/
function ajax_requests()
{
  $ajax = new AjaxRequests();
  //$ajax->contact_form();
}
add_action( 'init', 'ajax_requests' );

// AJAX URL
function get_ajax_url( $function )
{
  return admin_url('admin-ajax.php?action='.$function);
}

function rd_init()
{
  date_default_timezone_set('Europe/Budapest');

  $ref = new PostTypeFactory( 'szolgaltatas' );
	$ref->set_textdomain( TD );
	$ref->set_icon('tag');
	$ref->set_name( 'Szolgáltatás', 'Szolgáltatások' );
	$ref->set_labels( array(
		'add_new' => 'Új %s',
		'not_found_in_trash' => 'Nincsenek %s a lomtárban.',
		'not_found' => 'Nincsenek %s a listában.',
		'add_new_item' => 'Új %s létrehozása',
	) );
	//$ref->set_metabox_cb('weproref_metaboxes');
	$ref->create();

}
add_action('init', 'rd_init');

function jscustomcode () {
  ?>
  <script>
    (function($){
      $( window ).resize(function() {
        var wv = $(window).width();
        console.log( wv );
        // fixheightbywidth
        $('.fixheightbywidth').css({
          height: $('.fixheightbywidth').width()
        });
      });
    })(jQuery);
  </script>
  <?
}
add_action('wp_footer', 'jscustomcode');
