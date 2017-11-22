<article class="">
  <?php
    $link = get_permalink($post->ID);
    $img = get_the_post_thumbnail_url($post);

    if ($img) {
      list($imgw, $imgh) = getimagesize($img);
    }
  ?>
  <div class="in">
    <div class="image fixheightbywidth <?=($imgw < $imgh)?'portrait':''?>">
      <a href="<?=$link?>"><img src="<?=$img?>" alt="<?=$post->post_title?>"></a>
    </div>
    <div class="date"><?=date('Y.m.d.', strtotime($post->post_modified_gmt))?></div>
    <div class="title"><h4><a href="<?=$link?>"><?=$post->post_title?></a></h4></div>
    <div class="excerpt">
      <?=$post->post_excerpt?>
    </div>
    <div class="link">
      <a href="<?=$link?>">Tovább >></a>
    </div>
  </div>
</article>
