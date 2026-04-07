<?php
$hero_mode = get_option('respublica_hero_mode', 'auto');
if ($hero_mode === 'featured') {
  $args = ['post_type' => 'post', 'category_name' => 'featured', 'posts_per_page' => 1];
  if (function_exists('pll_current_language')) { $args['lang'] = pll_current_language(); }
} else {
  $args = ['post_type' => 'post', 'posts_per_page' => 1];
  if (function_exists('pll_current_language')) { $args['lang'] = pll_current_language(); }
}
$hero = new WP_Query($args);
if (!$hero->have_posts()) return;
$hero->the_post();
?>
<div class="hero-block">
  <?php if (has_post_thumbnail()): ?>
  <a href="<?php the_permalink(); ?>" class="hero-thumb-link">
    <?php the_post_thumbnail('respublica-hero', [
      'class'         => 'hero-thumb',
      'loading'       => 'eager',
      'decoding'      => 'async',
      'fetchpriority' => 'high',
    ]); ?>
  </a>
  <?php endif; ?>
  <div class="hero-content">
    <?php
    $cats = get_the_category();
    $cats = array_filter($cats, fn($c) => !in_array($c->slug,['en','de','fr','uncategorized']));
    if (!empty($cats)) {
      $cat = array_values($cats)[0];
      echo '<a href="'.get_category_link($cat->term_id).'" class="hero-cat">'.esc_html($cat->name).'</a>';
    }
    ?>
    <h2 class="hero-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php $deck = function_exists('get_field') ? get_field('deck') : ''; ?>
    <?php if ($deck): ?><p class="hero-deck"><?php echo esc_html($deck); ?></p><?php endif; ?>
    <div class="hero-meta">
      <?php echo get_the_date('d.m.Y'); ?> · <?php the_author(); ?>
    </div>
    <div class="hero-share">
      <?php get_template_part('template-parts/global/share'); ?>
    </div>
  </div>
</div>
<?php wp_reset_postdata(); ?>

