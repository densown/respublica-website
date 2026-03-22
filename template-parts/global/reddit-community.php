<?php
$reddit_url = get_option('respublica_reddit_url','https://www.reddit.com/r/Res_Publica_DE/');
?>
<section class="reddit-section">
  <div class="reddit-section-inner">
    <div class="reddit-section-left">
      <span class="reddit-big-icon"><?php echo respublica_reddit_icon(48, '#FF4500'); ?></span>
      <div class="reddit-section-label">Community</div>
      <h2 class="reddit-section-title"><?php echo rp_t('Diskutiere mit uns auf Reddit', 'Join the Discussion on Reddit'); ?></h2>
      <p class="reddit-section-desc">
        <?php echo rp_t(
          'Res.Publica lebt von Debatte. Unsere Community auf Reddit diskutiert jeden Artikel — kritisch, informiert, direkt. Werde Teil davon.',
          'Res.Publica thrives on debate. Our Reddit community discusses every article — critically, informedly, directly. Be part of it.'
        ); ?>
      </p>
      <a href="<?php echo esc_url($reddit_url); ?>" target="_blank" rel="noopener" class="reddit-join-btn">
        <?php echo respublica_reddit_icon(18, 'white'); ?>
        <?php echo rp_t('r/Res_Publica_DE beitreten', 'Join r/Res_Publica_DE'); ?>
      </a>
    </div>
    <div class="reddit-section-right">
      <div class="reddit-stats">
        <div class="reddit-stat">
          <span class="reddit-stat-num">2.400+</span>
          <span class="reddit-stat-label"><?php echo rp_t('Mitglieder', 'Members'); ?></span>
        </div>
        <div class="reddit-stat">
          <span class="reddit-stat-num">50k+</span>
          <span class="reddit-stat-label"><?php echo rp_t('Besucher/Woche', 'Visitors/Week'); ?></span>
        </div>
      </div>
      <div class="reddit-cta-box">
        <p class="reddit-cta-text"><?php echo rp_t(
          'Jeden Artikel den wir veröffentlichen posten wir auch auf Reddit — mit einer Diskussionsfrage. Komm und diskutiere mit.',
          'We post every article we publish on Reddit too — with a discussion question. Come join the conversation.'
        ); ?></p>
        <a href="<?php echo esc_url($reddit_url); ?>" target="_blank" rel="noopener" class="reddit-cta-link">
          <?php echo rp_t('Zur Community →', 'Visit Community →'); ?>
        </a>
      </div>
    </div>
  </div>
</section>

