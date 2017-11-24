<?php
/**
 * The footer template.
 *
 * @package Avada
 * @subpackage Templates
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
	  <?php do_action( 'avada_after_main_content' ); ?>
		</div>  <!-- fusion-row -->
		</main>  <!-- #main -->
		<?php do_action( 'avada_after_main_container' ); ?>

		<?php global $social_icons; ?>

		<?php if ( false !== strpos( Avada()->settings->get( 'footer_special_effects' ), 'footer_sticky' ) ) : ?>
			</div>
		<?php endif; ?>

		<?php
		/**
		 * Get the correct page ID.
		 */
		$c_page_id = Avada()->fusion_library->get_page_id();
		$phone = get_option('contact_phone', true);
		?>


    <footer class="mainfooter">
      <div class="fwrapper">
        <?php
          global $post;
          $footer_menu = wp_get_nav_menu_items('Lábléc', array(
            'post_status' => 'publish'
          ));
        ?>
        <?php if ($footer_menu): ?>
        <div class="footer-menu">
          <ul>
          <?php foreach ($footer_menu as $m): $menu_class = '';
            if ($post->ID == $m->object_id) { $menu_class .= 'current '; }
            $menu_class = rtrim($menu_class, ' ');
          ?>
            <li class="<?php echo $menu_class; ?>"><a href="<?php echo $m->url; ?> "><?php echo $m->title; ?></a> </li>
          <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>
        <div class="footer-content-holder">
          <div class="logo">
            <a href="<?php echo get_option('home', true); ?>"><img src="<?php echo IMG; ?>/logo_white.svg" alt="<?php echo get_option('blogname', true); ?>"></a>
          </div>
          <div class="contact-infos">
            <div class="infos">
              <?php $email = get_option('admin_email', true); ?>
              <div class="email">
                <a href="mailto:<?=$email?>"><?=$email?></a>
              </div>
              <div class="phone">
                <i class="fa fa-phone"></i> <a href="tel:<?php echo str_replace(array(' ', '(',')', '-'),'',$phone); ?>"></a><?php echo $phone; ?>
              </div>
              <div class="social">
                <?php
                  $social = (new Avada_Social_Icons())->render_social_icons(array(
                    'position' => 'footer'
                  ));

                  echo $social;
                ?>
              </div>
              <div class="copy">
                &copy; <?php echo date('Y'); ?> <?php echo get_option('blogname', true); ?>
              </div>
            </div>
          </div>
          <div class="creator">
            <div class="pretext">
              A weboldal készítője:
            </div>
            <div class="rlogo">
              <a href="https://www.web-pro.hu" target="_blank"><img class="ref" src="<?=IMG?>/webprorefwhite.svg" alt="Web-Pro"></a>
            </div>
            <div class="link">
              <a href="https://www.web-pro.hu" target="_blank">www.web-pro.hu</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script type="text/javascript">
      (function($){
        $(window).resize(function(){
            var w = $(window).width();
            var xpv = 5.33;
            var newfooterheight = w / xpv;
            $('footer.mainfooter').css({
              height: newfooterheight
            });
        });
      })(jQuery);
    </script>

		</div> <!-- wrapper -->

		<a class="fusion-one-page-text-link fusion-page-load-link"></a>

		<?php wp_footer(); ?>

		<?php
		/**
		 * Echo the scripts added to the "before </body>" field in Theme Options.
		 * The 'space_body' setting is not sanitized.
		 * In order to be able to take advantage of this,
		 * a user would have to gain access to the database
		 * in which case this is the least on your worries.
		 */
		echo Avada()->settings->get( 'space_body' ); // WPCS: XSS ok.
		?>
	</body>
</html>
