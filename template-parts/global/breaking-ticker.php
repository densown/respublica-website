<?php
$breaking = new WP_Query([
  'category_name'  => 'breaking-news',
  'posts_per_page' => 5,
  'orderby'        => 'date',
  'order'          => 'DESC',
]);
if (!$breaking->have_posts()) return;
?>
<div class="breaking-ticker">
  <span class="ticker-label">Breaking</span>
  <div class="ticker-track">
    <div class="ticker-inner">
      <?php while ($breaking->have_posts()): $breaking->the_post(); ?>
        <a href="<?php the_permalink(); ?>" class="ticker-item">
          <?php the_title(); ?>
        </a>
        <span class="ticker-sep">·</span>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</div>

