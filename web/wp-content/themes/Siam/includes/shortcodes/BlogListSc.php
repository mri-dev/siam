<?php
class BlogListSC
{
    const SCTAG = 'bloglist';

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
              'itemnum' => 3
            )
        );
        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        $posts = get_posts(array(
          'post_per_page' => $attr['itemnum'],
          'category_name' => 'Hírek'
        ));



          $output .= '<div class="content-holder">';
          if (!empty($posts)) {
            foreach ( $posts as $post ) {
              $output .= (new ShortcodeTemplates('bloglist-item'))->load_template(array(
                'param' => $attr,
                'post' => $post
              ));
            }
          }
          $output .= '</div>';
        $output .= '</div>';

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }

}

new BlogListSC();

?>
