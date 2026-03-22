<?php
if (!function_exists('get_field')) return;
$code = get_field('embed_code');
if (!$code) return;
?>
<div class="article-embed">
  <?php echo $code; ?>
</div>

