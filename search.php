<?php
declare(strict_types=1);

get_header();
get_template_part('template-parts/global/masthead');
get_template_part('template-parts/global/nav');

$query = get_search_query();
global $wp_query;
?>

<main class="rp-shell" role="main">
  <header class="rp-search__header">
    <h1 class="rp-search__headline rp-h1" style="font-size:30px; padding-left:14px; border-left:5px solid var(--red);">
      <?php printf(esc_html__('X Ergebnisse für “%s”', 'respublica-theme'), esc_html($query)); ?>
    </h1>
    <div class="rp-search__form">
      <?php get_search_form(); ?>
    </div>
    <?php if (isset($wp_query) && !empty($wp_query->found_posts)) : ?>
      <p class="rp-mono-meta" style="font-family:'IBM Plex Mono', ui-monospace; text-transform:uppercase; letter-spacing:.10em; font-size:11px; color:var(--mid); margin:12px 0 0;">
        <?php echo esc_html((string) $wp_query->found_posts); ?>
        <?php echo esc_html__(' Ergebnisse', 'respublica-theme'); ?>
      </p>
    <?php endif; ?>
  </header>

  <div class="rp-archive__list" aria-label="Suchergebnisse">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/archive/article-card');
        endwhile;
        the_posts_pagination();
    else :
        echo '<p>Keine Treffer gefunden.</p>';
    endif;
    ?>
  </div>
</main>

<?php
get_template_part('template-parts/global/footer');
get_footer();
?>

