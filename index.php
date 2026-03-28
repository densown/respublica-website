<?php

declare(strict_types=1);

get_header();
get_template_part('template-parts/global/masthead');
get_template_part('template-parts/global/nav');

?>
<main class="site-main">
  <div class="archive-wrap">
    <div class="articles-grid">
      <?php while (have_posts()): the_post();
        get_template_part('template-parts/archive/article-card');
      endwhile; ?>
    </div>
    <div class="pagination"><?php the_posts_pagination(['prev_text'=>'← Zurück','next_text'=>'Weiter →']); ?></div>
  </div>
</main>
<?php
get_template_part('template-parts/global/footer');
get_footer();
