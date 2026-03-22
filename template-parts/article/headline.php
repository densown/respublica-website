<header class="article-header">
  <?php
  $cats = get_the_category();
  $cats = array_filter($cats, fn($c) => !in_array($c->slug,['en','de','fr','uncategorized']));
  if (!empty($cats)):
    $cat = array_values($cats)[0];
  ?>
  <div class="rubrik">
    <a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo esc_html($cat->name); ?></a>
  </div>
  <?php endif; ?>
  <h1 itemprop="headline"><?php the_title(); ?></h1>
  <?php $deck = function_exists('get_field') ? get_field('deck') : ''; ?>
  <?php if ($deck): ?>
  <p class="deck"><?php echo esc_html($deck); ?></p>
  <?php endif; ?>
  <div class="byline">
    <span><strong><?php the_author(); ?></strong> · Res.Publica</span>
    <span><?php echo get_the_date('d.m.Y'); ?>, <?php echo get_the_date('H:i'); ?> <?php echo rp_t('Uhr', ''); ?></span>
    <?php $rt = ceil(str_word_count(strip_tags(get_the_content())) / 200); ?>
    <?php if ($rt > 0): ?><span><?php echo $rt; ?> <?php echo rp_t('Min. Lesezeit', 'min read'); ?></span><?php endif; ?>
  </div>
</header>

