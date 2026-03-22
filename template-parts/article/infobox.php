<?php
if (!function_exists('get_field')) return;
$text  = get_field('infobox_text');
$titel = get_field('infobox_titel');
if (!$text) return;
?>
<div class="infobox">
  <?php if ($titel): ?><h3><?php echo esc_html($titel); ?></h3><?php endif; ?>
  <p><?php echo nl2br(esc_html($text)); ?></p>
</div>

