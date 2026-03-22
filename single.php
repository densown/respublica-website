<?php get_header(); ?>
<?php get_template_part('template-parts/global/masthead'); ?>
<?php get_template_part('template-parts/global/nav'); ?>
<?php get_template_part('template-parts/global/breaking-ticker'); ?>
<main class="site-main">
  <div class="single-wrap">
    <?php while (have_posts()): the_post(); ?>
    <?php
    $is_breaking = function_exists('get_field') ? get_field('breaking') : false;
    if ($is_breaking || get_option('respublica_breaking_global') === '1'):
    ?>
    <div class="breaking-banner aktiv">
      <span class="breaking-label">Breaking</span>
      <span class="breaking-ticker-text"><?php the_title(); ?></span>
    </div>
    <?php endif; ?>
    <article class="single-article" itemscope itemtype="https://schema.org/Article">
      <?php get_template_part('template-parts/article/headline'); ?>
      <?php if (has_post_thumbnail()): ?>
      <div class="single-featured-img">
        <?php the_post_thumbnail('large', ['class'=>'single-thumb','itemprop'=>'image']); ?>
        <?php $cap = get_post(get_post_thumbnail_id())->post_excerpt; ?>
        <?php if ($cap): ?><p class="single-caption"><?php echo esc_html($cap); ?></p><?php endif; ?>
      </div>
      <?php endif; ?>
      <?php get_template_part('template-parts/article/body'); ?>
      <?php get_template_part('template-parts/article/pullquote'); ?>
      <?php get_template_part('template-parts/article/factbox'); ?>
      <?php get_template_part('template-parts/article/infobox'); ?>
      <?php get_template_part('template-parts/article/gallery'); ?>
      <?php get_template_part('template-parts/article/embed'); ?>
      <?php get_template_part('template-parts/article/autor'); ?>
      <?php get_template_part('template-parts/article/tags'); ?>
      <?php get_template_part('template-parts/global/share'); ?>
      <?php get_template_part('template-parts/reddit/share-button'); ?>
      <?php get_template_part('template-parts/reddit/post-preview'); ?>
      <?php get_template_part('template-parts/reddit/comments'); ?>
      <?php get_template_part('template-parts/article/related'); ?>
    </article>
    <?php endwhile; ?>
  </div>
</main>
<?php get_template_part('template-parts/global/newsletter-cta'); ?>
<?php get_template_part('template-parts/global/footer'); ?>
<?php get_footer(); ?>
