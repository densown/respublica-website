<?php
if (!function_exists('get_field')) return;
$items = get_field('factbox_items');
if (!$items) return;
$titel = get_field('factbox_titel') ?: rp_t('Auf einen Blick', 'Key Facts');
?>
<div class="factbox">
  <h3><?php echo esc_html($titel); ?></h3>
  <ul>
    <?php foreach ($items as $item): ?>
    <li><?php echo esc_html($item['item_text']); ?></li>
    <?php endforeach; ?>
  </ul>
</div>

