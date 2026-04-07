<?php
$filter_cats = [
  'breaking-news' => rp_t('Nachrichten', 'News'),
  'analysis'       => rp_t('Analyse', 'Analysis'),
  'germany'        => rp_t('Deutschland', 'Germany'),
  'europe'         => rp_t('Europa', 'Europe'),
  'world'          => rp_t('Welt', 'World'),
];
?>
<div class="cat-filter">
  <button class="cat-filter-btn active" data-cat="all"><?php echo rp_t('Alle', 'All'); ?></button>
  <?php foreach ($filter_cats as $slug => $label): ?>
    <?php if (get_category_by_slug($slug)): ?>
      <button class="cat-filter-btn" data-cat="<?php echo esc_attr($slug); ?>">
        <?php echo esc_html($label); ?>
      </button>
    <?php endif; ?>
  <?php endforeach; ?>
</div>
