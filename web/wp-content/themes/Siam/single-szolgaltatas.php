<?php
/**
 * The theme's index.php file.
 *
 * @package Avada
 * @subpackage Templates
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

$img = get_the_post_thumbnail_url(get_the_ID());
$price = get_post_meta($post->ID, 'price', true);
?>
<?php get_header(); ?>
	<section id="szolgaltatas" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
    <?php while ( have_posts() ) : the_post(); ?>
    <div class="szolgaltatas-page-holder">
  	  <div class="left-cont">
				<div class="title show-on-mobile">
          <h1><?php echo the_title(); ?></h1>
					<div class="pagi">
						<a href="/"><i class="fa fa-home"></i></a> <span class="sep">/</span> <a href="/szolgaltatasok">Szolgáltatások</a>
					</div>
        </div>
        <div class="img">
          <img src="<?=$img?>" alt="<?php echo the_title(); ?>">
        </div>
        <?php if ($price): ?>
        <div class="price">
          Szolgáltatás ára:
          <div class="t"><?php echo $price; ?></div>
        </div>
        <?php endif; ?>
        <div class="foglalas">
          <a href="/idopont-foglalas/?sz=<?php echo the_title(); ?>"><i class="fa fa-calendar"></i> Időpont foglalás</a>
        </div>
  	  </div>
      <div class="right-cont">
        <div class="title hide-on-mobile">
          <h1><?php echo the_title(); ?></h1>
					<div class="pagi">
						<a href="/"><i class="fa fa-home"></i></a> <span class="sep">/</span> <a href="/szolgaltatasok">Szolgáltatások</a>
					</div>
        </div>
        <div class="content">
          <?php the_content(); ?>
        </div>
				<?php echo get_template_part('ajandekutalvany'); ?>
  	  </div>
  	</div>
  <?php endwhile; wp_reset_postdata(); ?>
	</section>
	<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
