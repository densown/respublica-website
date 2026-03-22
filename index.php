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

/* duplicate block removed

declare(strict_types=1);

get_header();

?>

<main class="rp-wrap" id="content">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php
            $category_name = '';
            $cats = get_the_category();
            if (!empty($cats) && !is_wp_error($cats)) {
                $category_name = (string) $cats[0]->name;
            }

            $deck = '';
            if (function_exists('get_field')) {
                $deck = (string) (get_field('deck') ?? '');
            }

            $author = get_the_author();
            $date = get_the_date('d.m.Y');
            $place = '';
            if (function_exists('get_field')) {
                $place = (string) (get_field('place') ?? '');
            }
            ?>

            <article <?php post_class('rp-list-item'); ?> style="margin:0 0 34px; padding:0 0 26px; border-bottom:1px solid var(--rule);">
                <?php if ($category_name !== '') : ?>
                    <div class="rp-rubric"><?php echo esc_html($category_name); ?></div>
                <?php endif; ?>

                <h2 class="rp-title" style="font-size:30px; margin-bottom:10px;">
                    <a href="<?php the_permalink(); ?>" style="color:inherit; text-decoration:none;">
                        <?php the_title(); ?>
                    </a>
                </h2>

                <?php if (trim($deck) !== '') : ?>
                    <p class="rp-deck" style="margin-bottom:10px;"><?php echo esc_html($deck); ?></p>
                <?php endif; ?>

                <div class="rp-byline" style="margin:0; padding:0; border:0;">
                    <span><strong><?php echo esc_html((string) $author); ?></strong></span>
                    <span><?php echo esc_html((string) $date); ?></span>
                    <?php if (trim($place) !== '') : ?>
                        <span><?php echo esc_html($place); ?></span>
                    <?php endif; ?>
                </div>
            </article>

        <?php endwhile; ?>

        <div style="margin-top:26px;">
            <?php the_posts_pagination(); ?>
        </div>
    <?php else : ?>
        <p style="color:var(--mid); font-style:italic;">Keine Artikel gefunden.</p>
    <?php endif; ?>
</main>

<?php

get_footer();

*/
