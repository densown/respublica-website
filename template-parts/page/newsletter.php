<?php
declare(strict_types=1);

?>

<section class="rp-newsletter" aria-label="Newsletter">
  <div class="rp-newsletter__iframe">
    <iframe
      src="https://respublica.substack.com/embed"
      width="100%"
      height="520"
      style="border:0;"
      frameborder="0"
      scrolling="no"
      title="Res.Publica Newsletter"
    ></iframe>
  </div>

  <div class="rp-newsletter__list">
    <h2>Letzte Artikel</h2>
    <?php
    $q = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => 5,
        'orderby' => 'date',
        'order' => 'DESC',
    ]);
    if ($q->have_posts()) :
        while ($q->have_posts()) : $q->the_post();
            get_template_part('template-parts/archive/article-card');
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
    <p style="margin-top:12px; font-family:'Source Serif 4', ui-serif, Georgia, 'Times New Roman', Times, serif; font-size:16px; color:var(--mid);">
      Du kannst den Newsletter auch direkt abonnieren auf
      <a href="https://respublica.substack.com" target="_blank" rel="noopener noreferrer">respublica.substack.com</a>.
    </p>
  </div>
</section>

