<article class="">
  <?php
    $img = get_the_post_thumbnail_url(get_the_ID());
    $price = get_post_meta(get_the_ID(), 'price', true);
  ?>

  <div class="img">
    <a href="<?php echo the_permalink(); ?>"><img src="<?=$img?>" alt="<?php echo the_title(); ?>"></a>
  </div>
  <div class="title">
    <h3><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
  </div>
  <?php if ($price): ?>
  <div class="price">
    <?php echo $price; ?>
  </div>
  <?php endif; ?>
</article>
