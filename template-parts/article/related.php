<?php
$cats = get_the_category();
if (empty($cats)) return;
$cat_id = $cats[0]->term_id;
$related = new WP_Query([
  'category__in'   => [$cat_id],
  'post__not_in'   => [get_the_ID()],
  'posts_per_page' => 3,
  'orderby'        => 'date',
  'order'          => 'DESC',
]);
if (!$related->have_posts()) return;
?>
<div class="related">
  <p class="related-label"><?php echo rp_t('Weitere Artikel', 'More Articles'); ?></p>
  <?php while ($related->have_posts()): $related->the_post(); ?>
  <a href="<?php the_permalink(); ?>" class="related-item">
    <?php if (has_post_thumbnail()): ?>
    <div class="related-thumb"><?php the_post_thumbnail('respublica-thumb', [
      'class'   => 'related-img',
      'loading' => 'lazy',
      'decoding'=> 'async',
    ]); ?></div>
    <?php endif; ?>
    <div class="related-text">
      <?php
      $rc = get_the_category();
      $rc = array_filter($rc, fn($c) => !in_array($c->slug,['en','de','fr','uncategorized']));
      if (!empty($rc)) echo '<span class="related-cat">'.esc_html(array_values($rc)[0]->name).'</span>';
      ?>
      <span class="related-title"><?php the_title(); ?></span>
      <span class="related-date"><?php echo get_the_date('d.m.Y'); ?></span>
    </div>
  </a>
  <?php endwhile; wp_reset_postdata(); ?>
</div>

