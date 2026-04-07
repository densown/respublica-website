<nav class="nav-strip">

  <div class="nav-primary">
    <a href="<?php echo get_category_link(get_cat_ID('breaking-news')) ?: home_url('/category/breaking-news/'); ?>"
       class="<?php echo is_category('breaking-news') ? 'active' : ''; ?>"><?php echo rp_t('Nachrichten', 'News'); ?></a>
    <a href="<?php echo get_category_link(get_cat_ID('analysis')) ?: home_url('/category/analysis/'); ?>"
       class="<?php echo is_category('analysis') ? 'active' : ''; ?>"><?php echo rp_t('Analyse', 'Analysis'); ?></a>
    <a href="<?php echo get_category_link(get_cat_ID('germany')) ?: home_url('/category/germany/'); ?>"
       class="<?php echo is_category('germany') ? 'active' : ''; ?>"><?php echo rp_t('Deutschland', 'Germany'); ?></a>
    <a href="<?php echo get_category_link(get_cat_ID('europe')) ?: home_url('/category/europe/'); ?>"
       class="<?php echo is_category('europe') ? 'active' : ''; ?>"><?php echo rp_t('Europa', 'Europe'); ?></a>
    <a href="<?php echo get_category_link(get_cat_ID('world')) ?: home_url('/category/world/'); ?>"
       class="<?php echo is_category('world') ? 'active' : ''; ?>"><?php echo rp_t('Welt', 'World'); ?></a>

    <a href="<?php echo home_url('/about/'); ?>"
       class="<?php echo is_page('about') ? 'active' : ''; ?>"><?php echo rp_t('Über uns', 'About'); ?></a>

    <div class="nav-controls">
      <button class="darkmode-toggle" id="darkmode-toggle" aria-label="Dark Mode">
        <svg class="icon-sun" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="5"/>
          <line x1="12" y1="1" x2="12" y2="3"/>
          <line x1="12" y1="21" x2="12" y2="23"/>
          <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
          <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
          <line x1="1" y1="12" x2="3" y2="12"/>
          <line x1="21" y1="12" x2="23" y2="12"/>
          <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
          <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
        </svg>
        <svg class="icon-moon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
        </svg>
      </button>
      <button class="lang-toggle" id="lang-toggle" aria-label="Sprache">
        <span class="lang-de">DE</span>
        <span class="lang-sep">/</span>
        <span class="lang-en">EN</span>
      </button>
    </div>
  </div>

    <div class="nav-external">
    <a href="https://app.respublica.media"
       target="_blank" rel="noopener" class="nav-ext-link nav-badge nav-dashboard">
      Dashboard
      <span class="badge-new">NEU</span>
    </a>
    <?php if (get_option('respublica_show_reddit_nav', '1') === '1'): ?>
    <a href="<?php echo get_option('respublica_reddit_url', 'https://www.reddit.com/r/Res_Publica_DE/'); ?>"
       target="_blank" rel="noopener" class="nav-reddit">
      <?php echo respublica_reddit_icon(14, '#FF4500'); ?>
      Reddit
    </a>
    <?php endif; ?>
    <?php if (get_option('respublica_show_substack_nav', '1') === '1'): ?>
    <a href="<?php echo get_option('respublica_substack_url', 'https://substack.com/@respublicamgz'); ?>"
       target="_blank" rel="noopener" class="nav-substack">Newsletter ↗</a>
    <?php endif; ?>
  </div>

  <button class="hamburger" aria-label="Menü öffnen" aria-expanded="false">
    <span></span><span></span><span></span>
  </button>

  <div class="mobile-sidebar" role="dialog" aria-label="Navigation">
    <div class="mobile-sidebar-inner">
      <button class="mobile-sidebar-close" aria-label="Menü schließen">✕</button>

      <a href="<?php echo home_url('/'); ?>" class="mobile-logo">
        <img src="<?php echo get_option('respublica_logo_url','https://staging.respublica.media/wp-content/uploads/2026/03/Logo-e1772801257878.jpg'); ?>"
             alt="Res.Publica" class="mobile-logo-img">
        <span>Res<span style="color:#C8102E">.</span>Publica</span>
      </a>

      <div class="mobile-controls">
        <button class="darkmode-toggle" id="darkmode-toggle-mobile" aria-label="Dark Mode">
          <svg class="icon-sun" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="5"/>
            <line x1="12" y1="1" x2="12" y2="3"/>
            <line x1="12" y1="21" x2="12" y2="23"/>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
            <line x1="1" y1="12" x2="3" y2="12"/>
            <line x1="21" y1="12" x2="23" y2="12"/>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
          </svg>
          <svg class="icon-moon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
          </svg>
          <span class="mobile-control-label"><?php echo rp_t('Dark Mode', 'Dark Mode'); ?></span>
        </button>
        <button class="lang-toggle" id="lang-toggle-mobile" aria-label="Sprache">
          <span class="lang-de">DE</span>
          <span class="lang-sep">/</span>
          <span class="lang-en">EN</span>
          <span class="mobile-control-label"><?php echo rp_t('Sprache', 'Language'); ?></span>
        </button>
      </div>

      <!-- DASHBOARD LINK -->
      <div class="mobile-monitors">
        <a href="https://app.respublica.media"
           target="_blank" rel="noopener" class="mobile-monitor-btn">
          <span class="monitor-icon">📊</span>
          <div>
            <span class="monitor-title">Dashboard</span>
            <span class="monitor-sub"><?php echo rp_t('Wahlen, Weltkarte, Gesetze & mehr', 'Elections, World Map, Laws & more'); ?></span>
          </div>
          <span class="monitor-arrow monitor-new">NEU ↗</span>
        </a>
      </div>

      <!-- REDDIT BLOCK -->
      <a href="<?php echo get_option('respublica_reddit_url','https://www.reddit.com/r/Res_Publica_DE/'); ?>"
         target="_blank" rel="noopener" class="mobile-reddit-block">
        <?php echo respublica_reddit_icon(20, '#FF4500'); ?>
        <div>
          <span class="reddit-title">r/Res_Publica_DE</span>
          <span class="reddit-sub">Join the discussion on Reddit</span>
        </div>
        <span style="margin-left:auto;font-size:11px;color:#FF4500">↗</span>
      </a>

      <!-- KATEGORIEN -->
      <div class="mobile-sidebar-section-label"><?php echo rp_t('Kategorien', 'Categories'); ?></div>
      <nav class="mobile-nav">
        <a href="<?php echo home_url('/category/breaking-news/'); ?>"><?php echo rp_t('Nachrichten', 'News'); ?></a>
        <a href="<?php echo home_url('/category/analysis/'); ?>"><?php echo rp_t('Analyse', 'Analysis'); ?></a>
        <a href="<?php echo home_url('/category/germany/'); ?>"><?php echo rp_t('Deutschland', 'Germany'); ?></a>
        <a href="<?php echo home_url('/category/europe/'); ?>"><?php echo rp_t('Europa', 'Europe'); ?></a>
        <a href="<?php echo home_url('/category/world/'); ?>"><?php echo rp_t('Welt', 'World'); ?></a>
        <a href="<?php echo home_url('/category/guest-contributors/'); ?>"><?php echo rp_t('Gastbeiträge', 'Guest Contributors'); ?></a>
      </nav>

      <!-- WEITERE LINKS -->
      <div class="mobile-sidebar-section-label"><?php echo rp_t('Weitere', 'More'); ?></div>
      <nav class="mobile-nav mobile-nav-secondary">
        <a href="<?php echo home_url('/about/'); ?>"><?php echo rp_t('Über uns', 'About'); ?></a>
        <a href="<?php echo home_url('/impressum/'); ?>">Impressum</a>
        <a href="<?php echo home_url('/datenschutz/'); ?>">Datenschutz</a>
      </nav>

      <a href="<?php echo get_option('respublica_substack_url','https://substack.com/@respublicamgz'); ?>"
         target="_blank" rel="noopener" class="mobile-newsletter-btn">
        <?php echo rp_t('Newsletter abonnieren ↗', 'Subscribe to Newsletter ↗'); ?>
      </a>

      <div class="mobile-sidebar-footer">© Res.Publica <?php echo date('Y'); ?></div>
    </div>
  </div>
  <div class="mobile-overlay"></div>

  <script>
  (function(){
    var btn = document.querySelector('.hamburger');
    var sidebar = document.querySelector('.mobile-sidebar');
    var overlay = document.querySelector('.mobile-overlay');
    var close = document.querySelector('.mobile-sidebar-close');
    if (!btn || !sidebar) return;
    function open() {
      sidebar.classList.add('open');
      overlay.classList.add('open');
      btn.setAttribute('aria-expanded','true');
      document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
      sidebar.classList.remove('open');
      overlay.classList.remove('open');
      btn.setAttribute('aria-expanded','false');
      document.body.style.overflow = '';
    }
    btn.addEventListener('click', open);
    close.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);
  })();
  </script>

  <script>
  (function(){
    var root = document.documentElement;

    // Dark Mode
    var stored = localStorage.getItem('rp-darkmode');
    var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    var isDark = stored !== null ? stored === '1' : prefersDark;
    if (isDark) root.setAttribute('data-theme','dark');

    function toggleDark() {
      var dark = root.getAttribute('data-theme') === 'dark';
      if (dark) {
        root.removeAttribute('data-theme');
        localStorage.setItem('rp-darkmode','0');
      } else {
        root.setAttribute('data-theme','dark');
        localStorage.setItem('rp-darkmode','1');
      }
    }

    document.querySelectorAll('.darkmode-toggle').forEach(function(btn){
      btn.addEventListener('click', toggleDark);
    });

    // Sprache
    var path = window.location.pathname;
    var lang = (path.startsWith('/en/') || path === '/en') ? 'en' : 'de';
    root.setAttribute('data-lang', lang);

    function updateLangBtns(lang) {
      document.querySelectorAll('.lang-toggle').forEach(function(btn){
        btn.querySelector('.lang-de').style.fontWeight = lang === 'de' ? '700' : '400';
        btn.querySelector('.lang-en').style.fontWeight = lang === 'en' ? '700' : '400';
      });
    }
    updateLangBtns(lang);

    function toggleLang() {
      var path = window.location.pathname;
      var isEn = path.startsWith('/en/') || path === '/en';
      if (isEn) {
        // Switch to DE: remove /en/ prefix
        var newPath = path.replace(/^\/en\/?/, '/') || '/';
        window.location.href = newPath;
      } else {
        // Switch to EN: add /en/ prefix
        window.location.href = '/en' + (path === '/' ? '/' : path);
      }
    }

    document.querySelectorAll('.lang-toggle').forEach(function(btn){
      btn.addEventListener('click', toggleLang);
    });
  })();
  </script>

</nav>

