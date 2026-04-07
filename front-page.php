<?php

declare(strict_types=1);

get_header();
get_template_part('template-parts/global/masthead');
get_template_part('template-parts/global/nav');
get_template_part('template-parts/global/breaking-ticker');

?>
<main class="site-main">
  <?php get_template_part('template-parts/archive/hero'); ?>

  <div class="archive-wrap">
    <?php get_template_part('template-parts/archive/category-filter'); ?>
    <div class="articles-grid">
      <?php
      $paged = get_query_var('paged') ?: 1;
      $args = [
        'post_type'      => 'post',
        'posts_per_page' => 12,
        'paged'          => $paged,
        'post__not_in'   => [get_option('page_on_front')]
      ];
      if (function_exists('pll_current_language')) { $args['lang'] = pll_current_language(); }
      $q = new WP_Query($args);
      while ($q->have_posts()): $q->the_post();
        $post_cats = wp_get_post_categories(get_the_ID(), ['fields' => 'slugs']);
        $cats_str = implode(' ', $post_cats);
        echo '<div data-cats="' . esc_attr($cats_str) . '">';
        get_template_part('template-parts/archive/article-card');
        echo '</div>';
      endwhile;
      wp_reset_postdata();
      ?>
    </div>
    <?php get_template_part('template-parts/archive/guest-contributors'); ?>
    <?php get_template_part('template-parts/global/reddit-community'); ?>
    <?php get_template_part('template-parts/global/newsletter-cta'); ?>
    <div class="pagination">
      <?php
      echo paginate_links([
        'total'   => $q->max_num_pages,
        'current' => $paged,
        'prev_text' => '← Zurück',
        'next_text' => 'Weiter →',
      ]);
      ?>
    </div>
  </div>
</main>

<script>
(function(){
  var btns = document.querySelectorAll('.cat-filter-btn');
  var cards = document.querySelectorAll('[data-cats]');
  btns.forEach(function(btn){
    btn.addEventListener('click', function(){
      btns.forEach(function(b){ b.classList.remove('active'); });
      btn.classList.add('active');
      var cat = btn.getAttribute('data-cat');
      cards.forEach(function(card){
        if (cat === 'all') {
          card.style.display = '';
        } else {
          var cats = card.getAttribute('data-cats') || '';
          card.style.display = cats.indexOf(cat) !== -1 ? '' : 'none';
        }
      });
    });
  });
})();
</script>

<?php
get_template_part('template-parts/global/footer');
get_footer();

