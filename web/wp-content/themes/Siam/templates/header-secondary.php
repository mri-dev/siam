<?php
/**
 * Template for the secondary header.
 *
 * @author     ThemeFusion
 * @copyright  (c) Copyright by ThemeFusion
 * @link       http://theme-fusion.com
 * @package    Avada
 * @subpackage Core
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php

$content_1 = avada_secondary_header_content( 'header_left_content' );
$content_2 = avada_secondary_header_content( 'header_right_content' );
?>

<div class="fusion-secondary-header">
	<div class="fusion-row">
    <div class="fusion-alignleft">
      <?php $email = get_option('admin_email', true); ?>
      <div class="contacts">
        <span class="email"><a href="mailto:<?=$email?>"><i class="fa fa-envelope-o"></i> <?=$email?></a></span>
        <span class="phone"><i class="fa fa-phone"></i> +36 30 123 4567</span>
      </div>
      <?php unset($email); ?>
    </div>
		<?php if ( $content_2 ) : ?>
			<div class="fusion-alignright">
			<?php echo $content_2; // WPCS: XSS ok. ?>
			</div>
		<?php endif; ?>
	</div>
</div>
