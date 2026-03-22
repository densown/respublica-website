<?php

declare(strict_types=1);

get_header();
get_template_part('template-parts/global/masthead');
get_template_part('template-parts/global/nav');

$term = get_queried_object();
$cat_name = isset($term->name) ? (string) $term->name : '';

?>
<main class="site-main">
  <div class="archive-wrap">
    <div class="category-header">
      <div class="rubrik"><?php single_cat_title(); ?></div>
      <p class="category-desc"><?php echo category_description(); ?></p>
    </div>
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

