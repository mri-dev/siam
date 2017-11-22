<article class="">
  <?php
    $img = get_the_post_thumbnail_url(get_the_ID());
  ?>

  <div class="img">
    <a href="<?php echo the_permalink(); ?>"><img src="<?=$img?>" alt="<?php echo the_title(); ?>"></a>
  </div>
  <div class="title">
    <h3><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
  </div>
  <div class="price">
    4990 Ft-tól
  </div>
</article>
