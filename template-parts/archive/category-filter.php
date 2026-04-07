<?php
$is_en = (strpos($_SERVER['REQUEST_URI'] ?? '', '/en/') === 0);
$filter_cats = [
  'breaking-news' => $is_en ? 'News' : 'Nachrichten',
  'analysis'       => $is_en ? 'Analysis' : 'Analyse',
  'germany'        => $is_en ? 'Germany' : 'Deutschland',
  'europe'         => $is_en ? 'Europe' : 'Europa',
  'world'          => $is_en ? 'World' : 'Welt',
];
$all_label = $is_en ? 'All' : 'Alle';
?>
<div class="cat-filter">
  <button class="cat-filter-btn active" data-cat="all"><?php echo $all_label; ?></button>
  <?php foreach ($filter_cats as $slug => $label): ?>
    <?php if (get_category_by_slug($slug)): ?>
      <button class="cat-filter-btn" data-cat="<?php echo esc_attr($slug); ?>">
        <?php echo esc_html($label); ?>
      </button>
    <?php endif; ?>
  <?php endforeach; ?>
</div>
