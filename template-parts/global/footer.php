<footer class="site-footer">
  <div class="footer-inner">

    <div class="footer-top">
      <a href="<?php echo home_url('/'); ?>" class="footer-logo">
        <img src="<?php echo get_option('respublica_logo_url', 'https://staging.respublica.media/wp-content/uploads/2026/03/Logo-e1772801257878.jpg'); ?>"
             alt="Res.Publica"
             class="footer-logo-img">
        <span>Res<span style="color:var(--red)">.</span>Publica</span>
      </a>
      <p class="footer-claim">Geopolitik · Demokratiedaten · Wahlen · Analyse</p>
    </div>

    <div class="footer-mid">
      <div class="footer-col">
        <span class="footer-col-title"><?php echo rp_t('Themen', 'Topics'); ?></span>
        <a href="<?php echo home_url('/category/analysis/'); ?>">Analysis</a>
        <a href="<?php echo home_url('/category/breaking-news/'); ?>">Breaking News</a>
        <a href="<?php echo home_url('/category/usa/'); ?>">USA</a>
        <a href="<?php echo home_url('/category/germany/'); ?>"><?php echo rp_t('Deutschland', 'Germany'); ?></a>
        <a href="<?php echo home_url('/category/world/'); ?>"><?php echo rp_t('Welt', 'World'); ?></a>
      </div>
      <div class="footer-col">
        <span class="footer-col-title"><?php echo rp_t('Plattformen', 'Platforms'); ?></span>
        <a href="<?php echo get_option('respublica_worldmonitor_url','https://www.worldmonitor.app/'); ?>" target="_blank" rel="noopener">WorldMonitor</a>
        <a href="<?php echo get_option('respublica_electionmonitor_url','/election-monitor/'); ?>" target="_blank" rel="noopener">ElectionMonitor</a>
        <a href="<?php echo get_option('respublica_substack_url','https://substack.com/@respublicamgz'); ?>" target="_blank" rel="noopener">Newsletter</a>
        <a href="<?php echo get_option('respublica_reddit_url','https://www.reddit.com/r/Res_Publica_DE/'); ?>" target="_blank" rel="noopener">Reddit r/Res_Publica_DE</a>
      </div>
      <div class="footer-col">
        <span class="footer-col-title"><?php echo rp_t('Über uns', 'About'); ?></span>
        <a href="<?php echo home_url('/about/'); ?>"><?php echo rp_t('Über Res.Publica', 'About Res.Publica'); ?></a>
        <a href="<?php echo home_url('/impressum/'); ?>">Impressum</a>
        <a href="<?php echo home_url('/datenschutz/'); ?>"><?php echo rp_t('Datenschutzerklärung', 'Privacy Policy'); ?></a>
      </div>
    </div>

    <div class="footer-bottom">
      <span>© Res.Publica <?php echo date('Y'); ?>. <?php echo rp_t('Alle Rechte vorbehalten.', 'All rights reserved.'); ?></span>
      <span class="footer-legal">
        <a href="<?php echo home_url('/impressum/'); ?>">Impressum</a>
        <a href="<?php echo home_url('/datenschutz/'); ?>"><?php echo rp_t('Datenschutz', 'Privacy'); ?></a>
      </span>
    </div>

  </div>
</footer>
