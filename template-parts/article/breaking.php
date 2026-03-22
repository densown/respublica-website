<?php
declare(strict_types=1);

if (!function_exists('get_field')) {
    return;
}

$breaking = get_field('breaking');
if (empty($breaking)) {
    return;
}
?>

<section class="rp-breaking" aria-label="Breaking Banner">
  <div class="rp-breaking__inner">
    <span class="rp-breaking__label">BREAKING</span>
    <span>Res.Publica</span>
  </div>
</section>

