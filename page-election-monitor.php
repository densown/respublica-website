<?php
/*
 * Template Name: Election Monitor
 * Template Post Type: page
 */
get_header();
get_template_part('template-parts/global/masthead');
get_template_part('template-parts/global/nav');
get_template_part('template-parts/global/breaking-ticker');
?>

<main class="site-main election-monitor-page">

  <!-- HERO HEADER -->
  <div class="em-hero">
    <div class="em-hero-inner">
      <div class="em-hero-label">
        <?php echo rp_t('Wahlmonitor', 'Election Monitor'); ?>
        <span class="em-wip-badge">Work in Progress</span>
      </div>
      <h1 class="em-hero-title">
        <?php echo rp_t('Globaler Wahlmonitor', 'Global Election Monitor'); ?>
      </h1>
      <p class="em-hero-desc">
        <?php echo rp_t(
          'Wir bauen eine interaktive Datenplattform für Wahlen weltweit — mit Ergebniskarten, Umfrage-Trackern, historischen Vergleichen und Echtzeit-Analysen. Noch sind wir nicht ganz fertig, aber du kannst schon einen Blick hinter die Kulissen werfen.',
          'We are building an interactive data platform for elections worldwide — with result maps, poll trackers, historical comparisons, and real-time analysis. We are not quite done yet, but you can already get a glimpse behind the scenes.'
        ); ?>
      </p>
      <div class="em-hero-actions">
        <a href="<?php echo get_option('respublica_substack_url','https://substack.com/@respublicamgz'); ?>"
           target="_blank" rel="noopener" class="em-btn-primary">
          <?php echo rp_t('Benachrichtigt werden wenn fertig ↗', 'Notify me when ready ↗'); ?>
        </a>
        <a href="mailto:res.publica.magazin@gmail.com" class="em-btn-secondary">
          <?php echo rp_t('Mitarbeiten?', 'Want to contribute?'); ?>
        </a>
      </div>
    </div>
  </div>

  <!-- WIP BANNER -->
  <div class="em-wip-banner">
    <div class="em-wip-inner">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"/>
        <line x1="12" y1="8" x2="12" y2="12"/>
        <line x1="12" y1="16" x2="12.01" y2="16"/>
      </svg>
      <?php echo rp_t(
        'Diese Seite befindet sich im Aufbau. Die Features unten zeigen was geplant ist — nicht alles ist bereits verfügbar.',
        'This page is under construction. The features below show what is planned — not everything is available yet.'
      ); ?>
    </div>
  </div>

  <!-- GEPLANTE FEATURES -->
  <div class="em-features-wrap">
    <div class="em-section-label">
      <?php echo rp_t('Was wir bauen', 'What we are building'); ?>
    </div>
    <div class="em-features-grid">

      <div class="em-feature-card em-feature-soon">
        <div class="em-feature-icon">🗺</div>
        <div class="em-feature-status em-status-soon">
          <?php echo rp_t('In Entwicklung', 'In Development'); ?>
        </div>
        <h3><?php echo rp_t('Interaktive Wahlkarten', 'Interactive Election Maps'); ?></h3>
        <p><?php echo rp_t(
          'Wahlkreiskarten für Deutschland und international. Ergebnisse nach Region, Partei und Zeitraum filterbar.',
          'Electoral maps for Germany and internationally. Filter results by region, party, and time period.'
        ); ?></p>
      </div>

      <div class="em-feature-card em-feature-soon">
        <div class="em-feature-icon">📊</div>
        <div class="em-feature-status em-status-soon">
          <?php echo rp_t('In Entwicklung', 'In Development'); ?>
        </div>
        <h3><?php echo rp_t('Umfrage-Tracker', 'Poll Tracker'); ?></h3>
        <p><?php echo rp_t(
          'Aktuelle Umfragewerte für alle relevanten Wahlen — visualisiert als Zeitverlauf mit Trendlinien.',
          'Current polling data for all relevant elections — visualized as a timeline with trend lines.'
        ); ?></p>
      </div>

      <div class="em-feature-card em-feature-planned">
        <div class="em-feature-icon">🏛</div>
        <div class="em-feature-status em-status-planned">
          <?php echo rp_t('Geplant', 'Planned'); ?>
        </div>
        <h3><?php echo rp_t('Sitzverteilungen', 'Seat Distributions'); ?></h3>
        <p><?php echo rp_t(
          'Parlamentsdiagramme für alle Länder. Historische Vergleiche seit 1990.',
          'Parliament diagrams for all countries. Historical comparisons since 1990.'
        ); ?></p>
      </div>

      <div class="em-feature-card em-feature-planned">
        <div class="em-feature-icon">📅</div>
        <div class="em-feature-status em-status-planned">
          <?php echo rp_t('Geplant', 'Planned'); ?>
        </div>
        <h3><?php echo rp_t('Wahlkalender', 'Election Calendar'); ?></h3>
        <p><?php echo rp_t(
          'Alle kommenden Wahlen weltweit auf einen Blick — mit Countdown, Kontext und verlinkten Analysen.',
          'All upcoming elections worldwide at a glance — with countdown, context, and linked analyses.'
        ); ?></p>
      </div>

      <div class="em-feature-card em-feature-planned">
        <div class="em-feature-icon">📈</div>
        <div class="em-feature-status em-status-planned">
          <?php echo rp_t('Geplant', 'Planned'); ?>
        </div>
        <h3><?php echo rp_t('Historische Vergleiche', 'Historical Comparisons'); ?></h3>
        <p><?php echo rp_t(
          'Wie hat sich die politische Landschaft verändert? Interaktive Vergleiche von Bundestagswahlen seit 1949.',
          'How has the political landscape changed? Interactive comparisons of German federal elections since 1949.'
        ); ?></p>
      </div>

      <div class="em-feature-card em-feature-planned">
        <div class="em-feature-icon">🌍</div>
        <div class="em-feature-status em-status-planned">
          <?php echo rp_t('Geplant', 'Planned'); ?>
        </div>
        <h3><?php echo rp_t('Internationale Demokratiedaten', 'International Democracy Data'); ?></h3>
        <p><?php echo rp_t(
          'Demokratieindizes, Wahlbeteiligung und Parteiensysteme weltweit — datengetrieben und visuell.',
          'Democracy indices, voter turnout, and party systems worldwide — data-driven and visual.'
        ); ?></p>
      </div>

    </div>
  </div>

  <!-- ERSTE DATAWRAPPER GRAFIK SLOT -->
  <div class="em-data-wrap">
    <div class="em-section-label">
      <?php echo rp_t('Erste Daten', 'First Data'); ?>
    </div>
    <h2 class="em-section-title">
      <?php echo rp_t('Bundestagswahl 2025 — Ergebnisse nach Bundesland', 'Federal Election 2025 — Results by State'); ?>
    </h2>
    <p class="em-section-desc">
      <?php echo rp_t(
        'Zweitstimmenanteile aller relevanten Parteien nach Bundesland. Datenquelle: Bundeswahlleiterin.',
        'Second vote shares of all relevant parties by federal state. Data source: Federal Returning Officer.'
      ); ?>
    </p>
    <!-- DATAWRAPPER EMBED HIER EINFÜGEN -->
    <div class="em-embed-placeholder">
      <div class="em-embed-inner">
        <span class="em-embed-icon">📊</span>
        <p><?php echo rp_t(
          'Hier wird die interaktive Grafik eingebettet. Datawrapper Embed-Code hier einfügen.',
          'The interactive chart will be embedded here. Insert Datawrapper embed code here.'
        ); ?></p>
        <code>&lt;!-- Datawrapper iframe hier --&gt;</code>
      </div>
    </div>
  </div>

  <!-- NÄCHSTE WAHLEN -->
  <div class="em-upcoming-wrap">
    <div class="em-section-label">
      <?php echo rp_t('Nächste Wahlen', 'Upcoming Elections'); ?>
    </div>
    <div class="em-upcoming-grid">

      <div class="em-election-item">
        <div class="em-election-country">🇩🇪 <?php echo rp_t('Deutschland', 'Germany'); ?></div>
        <div class="em-election-name"><?php echo rp_t('Berlin Abgeordnetenwahl', 'Berlin State Election'); ?></div>
        <div class="em-election-date">2026</div>
        <div class="em-election-status em-status-upcoming">
          <?php echo rp_t('Bevorstehend', 'Upcoming'); ?>
        </div>
      </div>

      <div class="em-election-item">
        <div class="em-election-country">🇫🇷 <?php echo rp_t('Frankreich', 'France'); ?></div>
        <div class="em-election-name"><?php echo rp_t('Präsidentschaftswahl', 'Presidential Election'); ?></div>
        <div class="em-election-date">2027</div>
        <div class="em-election-status em-status-upcoming">
          <?php echo rp_t('Bevorstehend', 'Upcoming'); ?>
        </div>
      </div>

      <div class="em-election-item">
        <div class="em-election-country">🇺🇸 <?php echo rp_t('USA', 'USA'); ?></div>
        <div class="em-election-name"><?php echo rp_t('Midterms', 'Midterm Elections'); ?></div>
        <div class="em-election-date">2026</div>
        <div class="em-election-status em-status-upcoming">
          <?php echo rp_t('Bevorstehend', 'Upcoming'); ?>
        </div>
      </div>

    </div>
  </div>

  <!-- CTA -->
  <div class="em-cta-wrap">
    <div class="em-cta-inner">
      <h2 class="em-cta-title">
        <?php echo rp_t('Bleib auf dem Laufenden', 'Stay in the Loop'); ?>
      </h2>
      <p class="em-cta-desc">
        <?php echo rp_t(
          'Abonniere unseren Newsletter und erfahre als Erstes wenn neue Features live gehen.',
          'Subscribe to our newsletter and be the first to know when new features go live.'
        ); ?>
      </p>
      <a href="<?php echo get_option('respublica_substack_url','https://substack.com/@respublicamgz'); ?>"
         target="_blank" rel="noopener" class="em-btn-primary">
        <?php echo rp_t('Newsletter abonnieren ↗', 'Subscribe to Newsletter ↗'); ?>
      </a>
    </div>
  </div>

</main>

<?php get_template_part('template-parts/global/newsletter-cta'); ?>
<?php get_template_part('template-parts/global/footer'); ?>
<?php get_footer(); ?>

