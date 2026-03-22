<?php
$filter_cats = [
  'breaking-news' => 'News',
  'analysis'       => 'Analysis',
  'usa'            => 'USA',
  'germany'        => 'Germany',
  'world'          => 'World',
];
?>
<div class="cat-filter">
  <button class="cat-filter-btn active" data-cat="all">Alle</button>
  <?php foreach ($filter_cats as $slug => $label): ?>
    <?php if (get_category_by_slug($slug)): ?>
      <button class="cat-filter-btn" data-cat="<?php echo esc_attr($slug); ?>">
        <?php echo esc_html($label); ?>
      </button>
    <?php endif; ?>
  <?php endforeach; ?>
</div>

