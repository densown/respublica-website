<?php
$guests = new WP_Query([
  'category_name'  => 'guest-contributors',
  'posts_per_page' => 4,
  'orderby'        => 'date',
  'order'          => 'DESC',
]);
?>
<section class="guest-section">
  <div class="guest-inner">
    <div class="guest-header">
      <div class="guest-label">Guest Contributors</div>
      <h2 class="guest-title"><?php echo rp_t('Stimmen aus dem Feld', 'Voices from the Field'); ?></h2>
      <p class="guest-desc">
        <?php echo rp_t(
          'Dieser Bereich steht allen offen, die etwas Wichtiges zu sagen haben — Analysten, Forscher, Journalisten und informierte Bürger. Wir veröffentlichen Gastbeiträge zu Geopolitik, Demokratie und globalen Themen. Bei Interesse melde dich bei uns:',
          'This space is open to anyone with something important to say — analysts, researchers, journalists, and informed citizens. We publish guest contributions on geopolitics, democracy, and global affairs. If you\'d like to contribute, reach out to us at'
        ); ?>
        <a href="mailto:res.publica.magazin@gmail.com">res.publica.magazin@gmail.com</a>
      </p>
      <a href="<?php echo home_url('/category/guest-contributors/'); ?>" class="guest-all-link">
        <?php echo rp_t('Alle Gastbeiträge →', 'All Guest Contributions →'); ?>
      </a>
    </div>

    <?php if ($guests->have_posts()): ?>
    <div class="guest-grid">
      <?php while ($guests->have_posts()): $guests->the_post(); ?>
      <article class="guest-card">
        <?php if (has_post_thumbnail()): ?>
        <a href="<?php the_permalink(); ?>" class="guest-thumb-link">
          <?php the_post_thumbnail('medium', [
            'class'   => 'guest-thumb',
            'loading' => 'lazy',
            'decoding'=> 'async',
          ]); ?>
        </a>
        <?php endif; ?>
        <div class="guest-card-content">
          <h3 class="guest-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h3>
          <div class="guest-card-meta">
            <strong><?php the_author(); ?></strong> ·
            <?php echo get_the_date('d.m.Y'); ?>
          </div>
        </div>
      </article>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php else: ?>
    <div class="guest-empty">
      <p>No guest contributions yet. Be the first —
        <a href="mailto:res.publica.magazin@gmail.com">reach out to us.</a>
      </p>
    </div>
    <?php endif; ?>
  </div>
</section>

