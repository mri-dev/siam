<?php
define('PROTOCOL', 'https');
define('TARGETDOMAIN', 'siamthaimasszazs.hu');
define('DOMAIN', $_SERVER['HTTP_HOST']);
define('IFROOT', str_replace(get_option('siteurl'), '//'.DOMAIN, get_stylesheet_directory_uri()));
define('DEVMODE', true);
define('IMG', IFROOT.'/images');
define('GOOGLE_API_KEY', 'AIzaSyD99pf6f7JFVgvmiieIvtlJyMlS15I36qg');
define('LANGKEY','hu');
define('FB_APP_ID', '');
define('DEFAULT_LANGUAGE', 'hu_HU');
define('CAPTCHA_SITE_KEY', '6LfaODoUAAAAADOy8yJEs4l5L8edk-sazDS2qXGN');
define('CAPTCHA_SECRET_KEY', '6LfaODoUAAAAAAmxUKBb0rK-sphXlgYgOXhCk7dQ');

// Includes
require_once "includes/include.php";

function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'avada-stylesheet' ) );
    wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function custom_theme_enqueue_styles() {
  wp_enqueue_style( 'app-css', IFROOT . '/assets/css/style.css?t=' . ( (DEVMODE === true) ? time() : '' ) );

  wp_enqueue_script('captcha-js', '//www.google.com/recaptcha/api.js');
  wp_enqueue_script('moments', IFROOT.'/assets/vendors/moments/moments.min.js', array('jquery'));
  wp_enqueue_script('moment-hu', IFROOT.'/assets/vendors/moments/hu.js', array('jquery'));
  wp_enqueue_script('transition-bootstrap', IFROOT.'/assets/vendors/bootstrap/transition.js', array('jquery'));
  wp_enqueue_script('collapse-bootstrap', IFROOT.'/assets/vendors/bootstrap/collapse.js', array('jquery'));
  wp_enqueue_script('twitter-bootstrap', '//netdna.bootstrapcdn.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'));
  wp_enqueue_script('twitter-datepicker', IFROOT.'/assets/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js', array('jquery'));

  wp_enqueue_style( 'bootstrap-css', IFROOT . '/assets/vendors/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css');
  wp_enqueue_style( 'datepicker-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
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
  $ajax->contact_form();
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
	$ref->set_metabox_cb('szolgaltatas_metaboxes');
	$ref->create();
}
add_action('init', 'rd_init');

function szolgaltatas_metaboxes()
{
  add_meta_box('szolgaltatas_mb', 'Szolgáltatás adatok', 'szolgaltatas_mb', 'szolgaltatas');
}


function szolgaltatas_mb()
{
  global $post;

  // Noncename needed to verify where the data originated
	echo '<input type="hidden" name="szolgaltatas_noncename" id="szolgaltatas_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

  $key = 'price';
	$val = get_post_meta($post->ID, $key, true);
  echo '<p><label for="szolgaltatas_'.$key.'" class="post-attributes-label">Szolgáltatás ára</label></p>';
  echo '<input type="text" id="szolgaltatas_'.$key.'" name="'.$key.'" value="' . $val  . '" class="widefat" />';

}

function szolgaltatas_save_posttype_meta( $post_id, $post )
{
	if ( !wp_verify_nonce( $_POST['szolgaltatas_noncename'], plugin_basename(__FILE__) )) {
	   return $post->ID;
	}

	if ( !current_user_can( 'edit_post', $post->ID )) return $post->ID;

  $events_meta = array();

  $events_meta['price'] = $_POST['price'];

  foreach ((array)$events_meta as $key => $value) { // Cycle through the $events_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}
}
add_action('save_post', 'szolgaltatas_save_posttype_meta', 1, 2);

function jscustomcode () {
  ?>
  <script>
    (function($){
      $( window ).resize(function() {
        var wv = $(window).width();
        var footermenuvp = 30;
        console.log( wv );
        // fixheightbywidth
        $('.fixheightbywidth').css({
          height: $('.fixheightbywidth').width()
        });
        $('.footer-menu').css({
          top: wv/footermenuvp
        });
      });
    })(jQuery);
  </script>
  <?
}
add_action('wp_footer', 'jscustomcode');

function app_register_setting() {
	register_setting( 'general', 'contact_phone', 'strval' );
  register_setting( 'general', 'contact_address', 'strval' );
  register_setting( 'general', 'nyitvatartas', 'strval' );

  add_settings_field(
      'contact_phone',
      __('Telefonszám', 'Avada'),
      'contact_phone_cb',
      'general'
  );
  add_settings_field(
      'contact_address',
      __('Cím', 'Avada'),
      'contact_address_cb',
      'general'
  );
  add_settings_field(
      'nyitvatartas',
      __('Nyitva tartás', 'Avada'),
      'nyitvatartas_cb',
      'general'
  );
}
add_action( 'admin_init', 'app_register_setting' );

function contact_phone_cb()
{
  $option = get_option('contact_phone');
  echo '<input class="regular-text ltr" type="text" name="contact_phone" value="' . $option . '" />';
}
function contact_address_cb()
{
  $option = get_option('contact_address');
  echo '<input class="regular-text ltr" type="text" name="contact_address" value="' . $option . '" />';
}

function nyitvatartas_cb()
{
  $option = get_option('nyitvatartas');
  echo '<input class="regular-text ltr" type="text" name="nyitvatartas" value="' . $option . '" />';
}
