<?php
$artikel_typ = function_exists('get_field') ? get_field('artikel_typ') : '';
$bio         = function_exists('get_field') ? get_field('autor_bio') : '';
$fallback    = get_the_author_meta('description');
$show        = $bio || $fallback || in_array($artikel_typ, ['interview','analyse']);
if (!$show) return;
?>
<div class="autor-box">
  <div class="autor-avatar">
    <?php $foto = function_exists('get_field') ? get_field('autor_foto') : null; ?>
    <?php if ($foto): ?>
    <img src="<?php echo esc_url($foto['url']); ?>" alt="<?php the_author(); ?>" class="autor-foto">
    <?php else: ?>
    <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', ['class'=>'autor-foto']); ?>
    <?php endif; ?>
  </div>
  <div class="autor-info">
    <span class="autor-name"><?php the_author(); ?></span>
    <p class="autor-bio"><?php echo esc_html($bio ?: $fallback); ?></p>
  </div>
</div>

