<?php
$gallery = get_post_gallery(get_the_ID(), false);
if (empty($gallery['ids'])) return;
$ids = explode(',', $gallery['ids']);
?>
<div class="article-gallery">
  <?php foreach ($ids as $id):
    $img = wp_get_attachment_image_src((int)$id, 'medium_large');
    $cap = get_post((int)$id)->post_excerpt;
    if (!$img) continue;
  ?>
  <div class="gallery-item">
    <img src="<?php echo esc_url($img[0]); ?>" alt="<?php echo esc_attr($cap); ?>">
    <?php if ($cap): ?><p class="gallery-caption"><?php echo esc_html($cap); ?></p><?php endif; ?>
  </div>
  <?php endforeach; ?>
</div>

