<?php
$substack = get_option('respublica_substack_url', 'https://substack.com/@respublicamgz');
?>
<div class="newsletter-cta">
  <div class="newsletter-cta-inner">
    <div class="newsletter-cta-text">
      <span class="newsletter-cta-label">Newsletter</span>
      <p class="newsletter-cta-headline"><?php echo rp_t('Jeden Tag die wichtigsten Analysen.', 'The most important analyses. Every day.'); ?></p>
      <p class="newsletter-cta-sub"><?php echo rp_t('Geopolitik, Wahlen, Datenstorys — direkt in dein Postfach.', 'Geopolitics, elections, data stories — straight to your inbox.'); ?></p>
    </div>
    <a href="<?php echo esc_url($substack); ?>" target="_blank" rel="noopener" class="newsletter-cta-btn">
      <?php echo rp_t('Jetzt abonnieren ↗', 'Subscribe now ↗'); ?>
    </a>
  </div>
</div>

