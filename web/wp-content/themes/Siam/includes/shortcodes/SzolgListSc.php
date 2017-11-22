<?php
class SzolgListSC
{
    const SCTAG = 'szolglist';

    public function __construct()
    {
        add_action( 'init', array( &$this, 'register_shortcode' ) );
    }

    public function register_shortcode() {
        add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
    }

    public function do_shortcode( $attr, $content = null )
    {
        $output = '<div class="'.self::SCTAG.'-holder">';

    	  /* Set up the default arguments. */
        $defaults = apply_filters(
            self::SCTAG.'_defaults',
            array(
              'style' => 'circle'
            )
        );
        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        $posts = new WP_Query(array(
          'post_type' => 'szolgaltatas',
          'orderby' => 'menu_order',
          'order' => 'ASC'
        ));

          $output .= '<div class="content-holder style-'.$attr['style'].'">';
          if ( $posts->have_posts() ) {
            while ( $posts->have_posts() ) {
              $posts->the_post();
              $output .= (new ShortcodeTemplates('szolglist-item'))->load_template(array(
                'param' => $attr
              ));
            }
            wp_reset_postdata();
          }
          $output .= '</div>';
        $output .= '</div>';

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }

}

new SzolgListSC();

?>
