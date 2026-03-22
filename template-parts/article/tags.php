<?php $tags = get_the_tags(); if (!$tags) return; ?>
<div class="tags">
  <?php foreach ($tags as $tag): ?>
  <a href="<?php echo get_tag_link($tag->term_id); ?>" class="tag">
    <?php echo esc_html($tag->name); ?>
  </a>
  <?php endforeach; ?>
</div>

