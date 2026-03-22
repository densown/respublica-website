<?php
$last = get_posts(['numberposts'=>1,'orderby'=>'modified']);
$last_time = !empty($last) ? get_the_modified_date('H:i', $last[0]) : '';
?>
<header class="masthead">
  <a href="<?php echo home_url('/'); ?>" class="masthead-logo">
    <img src="<?php echo get_option('respublica_logo_url', 'https://staging.respublica.media/wp-content/uploads/2026/03/Logo-e1772801257878.jpg'); ?>"
         alt="Res.Publica Logo"
         class="masthead-logo-img">
    <span class="masthead-logo-text">Res<span class="dot">.</span>Publica</span>
  </a>
  <div class="masthead-meta">
    <?php echo date_i18n('d.m.Y'); ?><br>
    <?php if ($last_time): ?>
    <span class="masthead-updated">Aktualisiert: <?php echo $last_time; ?> Uhr</span>
    <?php endif; ?>
  </div>
</header>
