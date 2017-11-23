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

$phone = get_option('contact_phone', true);
$nyitvatartas = get_option('nyitvatartas', true);
$address = get_option('contact_address', true);
?>

<div class="fusion-secondary-header">
	<div class="fusion-row">
    <div class="fusion-alignleft">
      <?php $email = get_option('admin_email', true); ?>
      <div class="contacts">
        <span class="email"><a href="mailto:<?=$email?>"><i class="fa fa-envelope-o"></i> <?=$email?></a></span>
				<?php if ($phone): ?>
					<span class="phone"><i class="fa fa-phone"></i> <?php echo $phone; ?></span>
				<?php endif; ?>
				<?php if ($address): ?>
				<span class="address"><i class="fa fa-map-pin"></i> <?php echo $address; ?></span>
				<?php endif; ?>
      </div>
      <?php unset($email); ?>
    </div>
		<?php if ( $content_2 ) : ?>
			<div class="fusion-alignright">
			<?php echo $content_2; // WPCS: XSS ok. ?>
			<?php if ($nyitvatartas): ?>
				<div class="opens">
					<i class="fa fa-clock-o"></i> Nyitva tartás: <?php echo $nyitvatartas; ?>
				</div>
			<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php
	unset($phone);
	unset($nyitvatartas);
	unset($address);
?>
