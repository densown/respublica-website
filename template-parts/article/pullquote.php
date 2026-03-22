<?php
if (!function_exists('get_field')) return;
$text = get_field('pullquote_text');
$attr = get_field('pullquote_attribution');
if (!$text) return;
?>
<div class="pullquote">
  &bdquo;<?php echo esc_html($text); ?>&ldquo;
  <?php if ($attr): ?>
  <span class="attr"><?php echo esc_html($attr); ?></span>
  <?php endif; ?>
</div>

