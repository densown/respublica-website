<?php
declare(strict_types=1);

get_header();
get_template_part('template-parts/global/masthead');
get_template_part('template-parts/global/nav');
?>

<main class="rp-shell" role="main">
  <?php
  if (is_page('newsletter')) {
      get_template_part('template-parts/page/newsletter');
  } else {
      if (have_posts()) :
          while (have_posts()) : the_post();
              ?>
              <article>
                <h1 class="rp-h1" style="margin-top:0;"><?php the_title(); ?></h1>
                <div class="rp-body">
                  <?php the_content(); ?>
                </div>
              </article>
              <?php
          endwhile;
      endif;
  }
  ?>
</main>

<?php
get_template_part('template-parts/global/footer');
get_footer();
?>

