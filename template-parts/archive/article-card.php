<article class="article-card">
  <?php if (has_post_thumbnail()): ?>
  <a href="<?php the_permalink(); ?>" class="card-thumb-link">
    <?php the_post_thumbnail('respublica-card', [
      'class'    => 'card-thumb',
      'loading'  => 'lazy',
      'decoding' => 'async',
    ]); ?>
  </a>
  <?php endif; ?>
  <div class="card-content">
    <?php
    $cats = get_the_category();
    $cats = array_filter($cats, fn($c) => !in_array($c->slug, ['en','de','fr','uncategorized']));
    if (!empty($cats)) {
      $cat = array_values($cats)[0];
      echo '<a href="' . get_category_link($cat->term_id) . '" class="card-cat">' . esc_html($cat->name) . '</a>';
    }
    ?>
    <h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php
    $deck = function_exists('get_field') ? get_field('deck') : '';
    if ($deck): ?>
      <p class="card-deck"><?php echo esc_html($deck); ?></p>
    <?php endif; ?>
    <div class="card-meta">
      <span><?php echo get_the_date('d.m.Y'); ?></span>
      <span><?php the_author(); ?></span>
    </div>
  </div>
</article>

