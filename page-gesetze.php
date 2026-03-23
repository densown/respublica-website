<?php
/*
 * Template Name: Gesetzesänderungen
 * Template Post Type: page
 */
$gz_api_base = apply_filters('respublica_gesetze_api_base', 'https://api.respublica.media');

$gz_i18n = array(
	'loading'            => rp_t('Lade Gesetzesänderungen…', 'Loading legislative updates…'),
	'loadError'          => rp_t('Die Daten konnten nicht geladen werden. Bitte später erneut versuchen.', 'Could not load data. Please try again later.'),
	'empty'              => rp_t('Noch keine Änderungen erfasst — täglich aktualisiert', 'No changes recorded yet — updated daily'),
	'synopseShow'        => rp_t('Synopse anzeigen', 'Show synopsis'),
	'synopseHide'        => rp_t('Synopse ausblenden', 'Hide synopsis'),
	'abstimmungenTitle'  => rp_t('Abstimmungsdaten', 'Vote data'),
	'abstimmungenLoading' => rp_t('Lade Abstimmungsdaten…', 'Loading vote data…'),
	'abstimmungenError'  => rp_t('Abstimmungsdaten konnten nicht geladen werden.', 'Vote data could not be loaded.'),
	'abstimmungenNone'   => rp_t('Keine Abstimmungs-ID vorhanden.', 'No poll ID available.'),
	'abstimmungenPending' => rp_t('Abstimmungsdaten folgen.', 'Vote data to follow.'),
	'abstimmungenEmpty'  => rp_t('Keine Abstimmungsdaten vorhanden.', 'No vote data available.'),
	'noSynopse'          => rp_t('Keine Synopse hinterlegt.', 'No synopsis available.'),
	'synopseLoading'     => rp_t('Lade Synopse…', 'Loading synopsis…'),
	'kontextLabel'       => rp_t('Kontext', 'Context'),
	'kontextShow'        => rp_t('Kontext anzeigen ▼', 'Show context ▼'),
	'kontextHide'        => rp_t('Kontext ausblenden ▲', 'Hide context ▲'),
	'aiDisclaimer'       => rp_t('🤖 KI-generierte Zusammenfassung · Ohne Gewähr', '🤖 AI-generated summary · Without guarantee'),
	'synopseColOld'      => rp_t('Alte Fassung', 'Previous version'),
	'synopseColNew'      => rp_t('Neue Fassung', 'New version'),
	'sourceLabel'        => rp_t('Quelle', 'Source'),
	'badge_zivil'        => rp_t('Zivilrecht', 'Civil law'),
	'badge_sozial'       => rp_t('Sozialrecht', 'Social law'),
	'badge_steuer_arbeit' => rp_t('Steuerrecht/Arbeitsrecht', 'Tax & labour law'),
	'badge_straf'        => rp_t('Strafrecht', 'Criminal law'),
	'badge_verfassung'   => rp_t('Verfassungsrecht', 'Constitutional law'),
	'badge_bundes'       => rp_t('Bundesrecht', 'Federal law'),
	'toolbarDomain'      => rp_t('Rechtsgebiet', 'Legal area'),
	'toolbarSearch'      => rp_t('Suche (Kürzel)', 'Search (abbreviation)'),
	'toolbarSearchPh'    => rp_t('z. B. BGB, StGB …', 'e.g. BGB, StGB …'),
	'sortLabel'          => rp_t('Sortierung', 'Sort'),
	'sortNew'            => rp_t('Neueste zuerst', 'Newest first'),
	'sortOld'            => rp_t('Älteste zuerst', 'Oldest first'),
	'pagerPrev'          => rp_t('← Zurück', '← Back'),
	'pagerNext'          => rp_t('Weiter →', 'Next →'),
	'filterEmpty'        => rp_t('Keine Einträge für die aktuelle Auswahl.', 'No entries for the current selection.'),
	'pagerMetaTpl'       => rp_t('Seite {p} von {tp} · {n} Einträge gesamt', 'Page {p} of {tp} · {n} entries total'),
	'pagerSeite'         => rp_t('Seite', 'Page'),
	'pagerVon'           => rp_t('von', 'of'),
	'pagerEntriesTotal'  => rp_t('Einträge gesamt', 'entries total'),
	'tabsAriaLabel'       => rp_t('Tab Navigation', 'Tab Navigation'),
	'tabGesetze'          => rp_t('Gesetzesänderungen', 'Legislative Changes'),
	'tabRechtsprechung'  => rp_t('Rechtsprechung', 'Case Law'),
	'tabEuLaw'           => rp_t('EU-Recht', 'EU Law'),
	'tabEuComingSoon'    => rp_t('Demnächst', 'Coming Soon'),

	'urteileSectionLabel' => rp_t('Rechtsprechung', 'Case Law'),
	'urteileFilterExpand' => rp_t('Filter ▾', 'Filter ▾'),
	'urteileFilterCollapse' => rp_t('Filter ▲', 'Filter ▲'),
	'urteileSearchLabel' => rp_t('Suche', 'Search'),
	'urteileSearchPh'    => rp_t('Aktenzeichen, Stichworte…', 'Case numbers, keywords…'),
	'urteileCourtLabel'  => rp_t('Gericht', 'Court'),
	'urteileAreaLabel'   => rp_t('Rechtsgebiet', 'Legal area'),
	'urteileTimeLabel'   => rp_t('Zeitraum', 'Time range'),
	'urteileTime30Days'  => rp_t('Letzte 30 Tage', 'Last 30 days'),
	'urteileTime3Months' => rp_t('3 Monate', '3 months'),
	'urteileTime1Year'   => rp_t('1 Jahr', '1 year'),
	'urteileTimeAll'     => rp_t('Alle', 'All'),
	'urteileSortLabel'   => rp_t('Sortierung', 'Sort'),
	'urteileSortLatest'  => rp_t('Neueste', 'Newest'),
	'urteileSortOldest'  => rp_t('Älteste', 'Oldest'),
	'urteileLoading'      => rp_t('Lade Rechtsprechung…', 'Loading case law…'),
	'urteileLoadError'   => rp_t('Rechtsprechungsdaten konnten nicht geladen werden.', 'Case law could not be loaded.'),
	'urteileEmpty'       => rp_t('Keine Urteile für die aktuelle Auswahl.', 'No case law for the current selection.'),
	'urteileTenorShow'    => rp_t('Tenor anzeigen ▾', 'Show Tenor ▾'),
	'urteileTenorHide'    => rp_t('Tenor ausblenden ▲', 'Hide Tenor ▲'),
	'urteileAuswirkungShow' => rp_t('Auswirkung anzeigen ▾', 'Show Impact ▾'),
	'urteileAuswirkungHide' => rp_t('Auswirkung ausblenden ▲', 'Hide Impact ▲'),
	'urteileLinkLabel'   => rp_t('Volltext auf rechtsprechung-im-internet.de →', 'Full text on rechtsprechung-im-internet.de →'),
);

get_header();
get_template_part('template-parts/global/masthead');
get_template_part('template-parts/global/nav');
get_template_part('template-parts/global/breaking-ticker');
?>

<main class="site-main gesetze-page election-monitor-page">

	<div class="em-hero gz-hero">
		<div class="em-hero-inner">
			<div class="em-hero-label gz-hero-eyebrow">
				<?php echo rp_t('Parlament &amp; Recht', 'Parliament &amp; Law'); ?>
			</div>
			<h1 class="em-hero-title gz-hero-title">
				<?php echo rp_t('Gesetzesänderungen', 'Legislative changes'); ?>
			</h1>
			<p class="em-hero-desc gz-hero-desc">
				<?php echo rp_t(
					'Hier dokumentieren wir Änderungen an Gesetzestexten mit Kurzbeschreibung und Synopse. Abstimmungsdaten werden geladen, sobald du eine Änderung aufklappst.',
					'We document changes to legislation with short summaries and synopses. Vote data loads when you expand an entry.'
				); ?>
			</p>
		</div>
	</div>

	<div class="gz-tabs">
		<div class="gz-tabs-nav" role="tablist" aria-label="<?php echo esc_attr($gz_i18n['tabsAriaLabel']); ?>">
			<button type="button" class="gz-tab-btn gz-tab-btn--active" id="gz-tab-gesetze" role="tab" aria-selected="true" aria-controls="gz-panel-gesetze" data-tab="gesetze">
				<?php echo esc_html($gz_i18n['tabGesetze']); ?>
			</button>
			<button type="button" class="gz-tab-btn" id="gz-tab-urteile" role="tab" aria-selected="false" aria-controls="gz-panel-urteile" data-tab="urteile">
				<?php echo esc_html($gz_i18n['tabRechtsprechung']); ?>
			</button>
			<button type="button" class="gz-tab-btn gz-tab-btn--disabled" id="gz-tab-eu" role="tab" aria-selected="false" aria-disabled="true" disabled>
				<?php echo esc_html($gz_i18n['tabEuLaw']); ?>
				<span class="gz-tab-badge"><?php echo esc_html($gz_i18n['tabEuComingSoon']); ?></span>
			</button>
		</div>

		<div class="gz-tabpanels">
			<div id="gz-panel-gesetze" class="gz-tabpanel" role="tabpanel" aria-labelledby="gz-tab-gesetze">

	<div class="gz-list-wrap em-data-wrap">
		<div class="gz-list-inner">
			<div class="em-section-label">
				<?php echo rp_t('Änderungen', 'Updates'); ?>
			</div>
			<h2 class="em-section-title gz-section-heading">
				<?php echo rp_t('Übersicht', 'Overview'); ?>
			</h2>
			<p class="em-section-desc gz-section-desc">
				<?php echo rp_t(
					'Datenquelle: interne API. Die Liste wird im Browser geladen.',
					'Data source: internal API. The list is loaded in the browser.'
				); ?>
			</p>

			<div
				id="gz-list-app"
				class="gz-list-app"
				data-api-base="<?php echo esc_attr($gz_api_base); ?>"
				data-i18n="<?php echo esc_attr(wp_json_encode($gz_i18n)); ?>"
			>
				<div id="gz-app-error" class="gz-app-error" hidden role="alert"></div>

				<div id="gz-toolbar" class="gz-toolbar" hidden>
					<div class="gz-field gz-field--search">
						<label for="gz-filter-search"><?php echo esc_html($gz_i18n['toolbarSearch']); ?></label>
						<div class="gz-search-wrap">
							<svg class="gz-search-icon" width="18" height="18" viewBox="0 0 20 20" fill="none" aria-hidden="true">
								<circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="2"/>
								<path d="m14 14 4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
							</svg>
							<input type="search" id="gz-filter-search" placeholder="<?php echo esc_attr($gz_i18n['toolbarSearchPh']); ?>" autocomplete="off" />
						</div>
					</div>
					<div class="gz-field gz-field--filter">
						<label for="gz-filter-domain"><?php echo esc_html($gz_i18n['toolbarDomain']); ?></label>
						<select id="gz-filter-domain" aria-label="<?php echo esc_attr($gz_i18n['toolbarDomain']); ?>">
							<option value="all"><?php echo esc_html(rp_t('Alle', 'All')); ?></option>
							<option value="zivil"><?php echo esc_html($gz_i18n['badge_zivil']); ?></option>
							<option value="sozial"><?php echo esc_html($gz_i18n['badge_sozial']); ?></option>
							<option value="steuer_arbeit"><?php echo esc_html($gz_i18n['badge_steuer_arbeit']); ?></option>
							<option value="straf"><?php echo esc_html($gz_i18n['badge_straf']); ?></option>
							<option value="verfassung"><?php echo esc_html($gz_i18n['badge_verfassung']); ?></option>
							<option value="bundes"><?php echo esc_html($gz_i18n['badge_bundes']); ?></option>
						</select>
					</div>
					<div class="gz-field gz-sort-group">
						<span class="gz-sort-label"><?php echo esc_html($gz_i18n['sortLabel']); ?></span>
						<div class="gz-sort-toggles" role="group" aria-label="<?php echo esc_attr($gz_i18n['sortLabel']); ?>">
							<button type="button" class="gz-btn-sort gz-btn-sort-active" id="gz-sort-new" data-desc="true"
								aria-label="<?php echo esc_attr($gz_i18n['sortNew']); ?>"
								title="<?php echo esc_attr($gz_i18n['sortNew']); ?>">
								<span class="gz-sort-icon" aria-hidden="true">↓</span>
							</button>
							<button type="button" class="gz-btn-sort" id="gz-sort-old" data-desc="false"
								aria-label="<?php echo esc_attr($gz_i18n['sortOld']); ?>"
								title="<?php echo esc_attr($gz_i18n['sortOld']); ?>">
								<span class="gz-sort-icon" aria-hidden="true">↑</span>
							</button>
						</div>
					</div>
				</div>

				<div id="gz-cards" class="gz-cards"></div>

				<div id="gz-pager" class="gz-pager" hidden>
					<span class="gz-pager-meta" id="gz-pager-meta"></span>
					<div class="gz-pager-nav">
						<button type="button" class="gz-btn-page" id="gz-btn-prev"><?php echo esc_html($gz_i18n['pagerPrev']); ?></button>
						<button type="button" class="gz-btn-page" id="gz-btn-next"><?php echo esc_html($gz_i18n['pagerNext']); ?></button>
					</div>
				</div>

				<p id="gz-loading" class="gz-status gz-loading"><?php echo esc_html($gz_i18n['loading']); ?></p>
			</div>
		</div>
	</div>

			</div>

			<div id="gz-panel-urteile" class="gz-tabpanel" role="tabpanel" aria-labelledby="gz-tab-urteile" hidden>
				<div class="gz-urteile-wrap em-data-wrap">
					<div class="gz-urteile-inner">
						<div class="em-section-label">
							<?php echo esc_html($gz_i18n['urteileSectionLabel']); ?>
						</div>

						<div
							id="gz-urteile-app"
							class="gz-urteile-app"
							data-api-base="<?php echo esc_attr($gz_api_base); ?>"
							data-i18n="<?php echo esc_attr(wp_json_encode($gz_i18n)); ?>"
						>
							<div id="gz-urteile-error" class="gz-app-error" hidden role="alert"></div>

							<button type="button" id="gz-urteile-filter-toggle" class="gz-urteile-filter-toggle" aria-expanded="false">
								<?php echo esc_html($gz_i18n['urteileFilterExpand']); ?>
							</button>

							<div id="gz-urteile-filter-panel" class="gz-urteile-filter-panel" aria-hidden="true">
								<div class="gz-toolbar gz-urteile-toolbar">
									<div class="gz-field gz-field--search">
										<label for="gz-urteile-filter-search"><?php echo esc_html($gz_i18n['urteileSearchLabel']); ?></label>
										<div class="gz-search-wrap">
											<svg class="gz-search-icon" width="18" height="18" viewBox="0 0 20 20" fill="none" aria-hidden="true">
												<circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="2"/>
												<path d="m14 14 4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
											</svg>
											<input type="search" id="gz-urteile-filter-search" placeholder="<?php echo esc_attr($gz_i18n['urteileSearchPh']); ?>" autocomplete="off" />
										</div>
									</div>

									<div class="gz-field gz-field--filter">
										<label for="gz-urteile-filter-court"><?php echo esc_html($gz_i18n['urteileCourtLabel']); ?></label>
										<select id="gz-urteile-filter-court" aria-label="<?php echo esc_attr($gz_i18n['urteileCourtLabel']); ?>">
											<option value="all"><?php echo esc_html(rp_t('Alle', 'All')); ?></option>
											<option value="BVerfG">BVerfG</option>
											<option value="BGH">BGH</option>
											<option value="BVerwG">BVerwG</option>
											<option value="BFH">BFH</option>
											<option value="BAG">BAG</option>
											<option value="BSG">BSG</option>
											<option value="BPatG">BPatG</option>
										</select>
									</div>

									<div class="gz-field gz-field--filter">
										<label for="gz-urteile-filter-area"><?php echo esc_html($gz_i18n['urteileAreaLabel']); ?></label>
										<select id="gz-urteile-filter-area" aria-label="<?php echo esc_attr($gz_i18n['urteileAreaLabel']); ?>">
											<option value="all"><?php echo esc_html(rp_t('Alle', 'All')); ?></option>
											<option value="Zivilrecht"><?php echo esc_html('Zivilrecht'); ?></option>
											<option value="Strafrecht"><?php echo esc_html('Strafrecht'); ?></option>
											<option value="Verfassungsrecht"><?php echo esc_html('Verfassungsrecht'); ?></option>
											<option value="Verwaltungsrecht"><?php echo esc_html('Verwaltungsrecht'); ?></option>
											<option value="Steuerrecht"><?php echo esc_html('Steuerrecht'); ?></option>
											<option value="Arbeitsrecht"><?php echo esc_html('Arbeitsrecht'); ?></option>
											<option value="Sozialrecht"><?php echo esc_html('Sozialrecht'); ?></option>
											<option value="Patentrecht"><?php echo esc_html('Patentrecht'); ?></option>
										</select>
									</div>

									<div class="gz-field gz-field--filter">
										<label for="gz-urteile-filter-time"><?php echo esc_html($gz_i18n['urteileTimeLabel']); ?></label>
										<select id="gz-urteile-filter-time" aria-label="<?php echo esc_attr($gz_i18n['urteileTimeLabel']); ?>">
											<option value="30d" selected><?php echo esc_html($gz_i18n['urteileTime30Days']); ?></option>
											<option value="3m"><?php echo esc_html($gz_i18n['urteileTime3Months']); ?></option>
											<option value="1y"><?php echo esc_html($gz_i18n['urteileTime1Year']); ?></option>
											<option value="all"><?php echo esc_html($gz_i18n['urteileTimeAll']); ?></option>
										</select>
									</div>

									<div class="gz-sort-group">
										<span class="gz-sort-label"><?php echo esc_html($gz_i18n['urteileSortLabel']); ?></span>
										<div class="gz-sort-toggles" role="group" aria-label="<?php echo esc_attr($gz_i18n['urteileSortLabel']); ?>">
											<button type="button" class="gz-btn-sort gz-btn-sort-active" id="gz-urteile-sort-latest" data-desc="true"
												aria-label="<?php echo esc_attr($gz_i18n['urteileSortLatest']); ?>"
												title="<?php echo esc_attr($gz_i18n['urteileSortLatest']); ?>">
												<span class="gz-sort-icon" aria-hidden="true">↓</span>
											</button>
											<button type="button" class="gz-btn-sort" id="gz-urteile-sort-oldest" data-desc="false"
												aria-label="<?php echo esc_attr($gz_i18n['urteileSortOldest']); ?>"
												title="<?php echo esc_attr($gz_i18n['urteileSortOldest']); ?>">
												<span class="gz-sort-icon" aria-hidden="true">↑</span>
											</button>
										</div>
									</div>
								</div>
							</div>

							<div id="gz-urteile-skeleton" class="gz-urteile-skeleton" aria-hidden="true" hidden>
								<div class="gz-skeleton-card"></div>
								<div class="gz-skeleton-card"></div>
								<div class="gz-skeleton-card"></div>
							</div>

							<p id="gz-urteile-loading" class="gz-status gz-loading" hidden><?php echo esc_html($gz_i18n['urteileLoading']); ?></p>

							<div id="gz-urteile-cards" class="gz-urteile-cards gz-cards"></div>

							<div id="gz-urteile-pager" class="gz-pager" hidden>
								<span class="gz-pager-meta" id="gz-urteile-pager-meta"></span>
								<div class="gz-pager-nav">
									<button type="button" class="gz-btn-page" id="gz-urteile-btn-prev"><?php echo esc_html($gz_i18n['pagerPrev']); ?></button>
									<button type="button" class="gz-btn-page" id="gz-urteile-btn-next"><?php echo esc_html($gz_i18n['pagerNext']); ?></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="gz-legal-wrap" aria-label="<?php echo esc_attr( rp_t( 'Rechtliche Hinweise', 'Legal notice' ) ); ?>">
		<div class="gz-legal-inner">
			<ul class="gz-legal-list">
				<li>
					<?php echo wp_kses_post( rp_t(
						'Gesetzestexte stammen von <a href="https://www.gesetze-im-internet.de/" target="_blank" rel="noopener noreferrer">gesetze-im-internet.de</a> (Quelle: Bundesministerium der Justiz).',
						'Legislative texts are taken from <a href="https://www.gesetze-im-internet.de/" target="_blank" rel="noopener noreferrer">gesetze-im-internet.de</a> (source: Federal Ministry of Justice).'
					) ); ?>
				</li>
				<li>
					<?php echo wp_kses_post( rp_t(
						'Die Texte sind <strong>nicht</strong> die amtliche Fassung — amtliche Fassung: <a href="https://www.recht.bund.de/" target="_blank" rel="noopener noreferrer">recht.bund.de</a> (Bundesgesetzblatt).',
						'These texts are <strong>not</strong> the official version — official version: <a href="https://www.recht.bund.de/" target="_blank" rel="noopener noreferrer">recht.bund.de</a> (Federal Law Gazette).'
					) ); ?>
				</li>
				<li>
					<?php echo esc_html( rp_t(
						'Gesetzestexte sind amtliche Werke gemäß § 5 UrhG und gemeinfrei.',
						'Legislative texts are official works within the meaning of Section 5 UrhG (German Copyright Act) and are in the public domain.'
					) ); ?>
				</li>
				<li>
					<?php echo wp_kses_post( rp_t(
						'Abstimmungsdaten: <a href="https://www.abgeordnetenwatch.de/" target="_blank" rel="noopener noreferrer">abgeordnetenwatch.de</a>, Lizenz <a href="https://creativecommons.org/publicdomain/zero/1.0/deed.de" target="_blank" rel="noopener noreferrer">CC0 1.0</a>.',
						'Vote data: <a href="https://www.abgeordnetenwatch.de/" target="_blank" rel="noopener noreferrer">abgeordnetenwatch.de</a>, <a href="https://creativecommons.org/publicdomain/zero/1.0/deed.en" target="_blank" rel="noopener noreferrer">CC0 1.0</a> licence.'
					) ); ?>
				</li>
				<li>
					<?php echo esc_html( rp_t(
						'Kein Anspruch auf Vollständigkeit oder Aktualität.',
						'No claim to completeness or timeliness.'
					) ); ?>
				</li>
				<li>
					<?php echo esc_html( rp_t(
						'Alle Angaben ohne Gewähr.',
						'All information is provided without warranty.'
					) ); ?>
				</li>
			</ul>
		</div>
	</section>

</main>

<?php get_template_part('template-parts/global/newsletter-cta'); ?>
<?php get_template_part('template-parts/global/footer'); ?>

<script>
(function () {
	var listApp = document.getElementById('gz-list-app');
	if (!listApp) return;
	var cards = document.getElementById('gz-cards');
	if (!cards) return;

	var base = (listApp.getAttribute('data-api-base') || '').replace(/\/$/, '');
	var i18n = {};
	try {
		i18n = JSON.parse(listApp.getAttribute('data-i18n') || '{}');
	} catch (e) {}

	var PAGE_SIZE = 20;
	var rawData = [];
	var sortDesc = true;
	var filterKey = 'all';
	var searchQuery = '';
	var page = 1;

	var el = {
		loading: document.getElementById('gz-loading'),
		error: document.getElementById('gz-app-error'),
		toolbar: document.getElementById('gz-toolbar'),
		pager: document.getElementById('gz-pager'),
		pagerMeta: document.getElementById('gz-pager-meta'),
		filterDomain: document.getElementById('gz-filter-domain'),
		filterSearch: document.getElementById('gz-filter-search'),
		sortNew: document.getElementById('gz-sort-new'),
		sortOld: document.getElementById('gz-sort-old'),
		btnPrev: document.getElementById('gz-btn-prev'),
		btnNext: document.getElementById('gz-btn-next'),
	};

	function showError(msg) {
		if (!el.error) return;
		el.error.textContent = msg || '';
		el.error.hidden = !msg;
	}

	function getFilteredSorted() {
		var rows = rawData.slice();
		if (filterKey !== 'all') {
			rows = rows.filter(function (r) {
				return rechtGebietFromKuerzel(itemKuerzel(r)) === filterKey;
			});
		}
		var q = searchQuery.trim().toLowerCase();
		if (q) {
			rows = rows.filter(function (r) {
				var k = (itemKuerzel(r) || '').toLowerCase();
				var n = (itemName(r) || '').toLowerCase();
				return k.indexOf(q) !== -1 || n.indexOf(q) !== -1;
			});
		}
		rows.sort(function (a, b) {
			var da = itemDatum(a) || '';
			var db = itemDatum(b) || '';
			var cmp = sortDesc ? db.localeCompare(da) : da.localeCompare(db);
			if (cmp !== 0) return cmp;
			var idb = parseInt(itemGesetzId(b), 10) || 0;
			var ida = parseInt(itemGesetzId(a), 10) || 0;
			return idb - ida;
		});
		return rows;
	}

	function pagerMetaHtml(p, tp, n) {
		if (i18n.pagerSeite && i18n.pagerVon && i18n.pagerEntriesTotal) {
			return (
				'<span class="gz-pager-primary">' +
				'<span class="gz-pager-w">' +
				esc(i18n.pagerSeite) +
				'</span> ' +
				'<strong class="gz-pager-cur">' +
				esc(String(p)) +
				'</strong> ' +
				'<span class="gz-pager-w">' +
				esc(i18n.pagerVon) +
				'</span> ' +
				'<span class="gz-pager-tmax">' +
				esc(String(tp)) +
				'</span>' +
				'</span>' +
				'<span class="gz-pager-sep" aria-hidden="true">·</span>' +
				'<span class="gz-pager-n">' +
				esc(String(n)) +
				' <span class="gz-pager-w">' +
				esc(i18n.pagerEntriesTotal) +
				'</span></span>'
			);
		}
		var tpl = i18n.pagerMetaTpl || '';
		return esc(
			tpl.replace(/\{p\}/g, String(p)).replace(/\{tp\}/g, String(tp)).replace(/\{n\}/g, String(n))
		);
	}

	function getLang() {
		return document.documentElement.getAttribute('data-lang') === 'en' ? 'en' : 'de';
	}

	function esc(s) {
		if (s == null) return '';
		var d = document.createElement('div');
		d.textContent = String(s);
		return d.innerHTML;
	}

	function pick(obj, keys) {
		for (var i = 0; i < keys.length; i++) {
			var k = keys[i];
			if (obj && Object.prototype.hasOwnProperty.call(obj, k) && obj[k] != null && obj[k] !== '') {
				return obj[k];
			}
		}
		return '';
	}

	function normalizeList(raw) {
		if (Array.isArray(raw)) return raw;
		if (raw && Array.isArray(raw.gesetze)) return raw.gesetze;
		if (raw && Array.isArray(raw.data)) return raw.data;
		if (raw && Array.isArray(raw.items)) return raw.items;
		return [];
	}

	function itemGesetzId(g) {
		var v = pick(g, ['id']);
		return v === '' ? '' : String(v);
	}
	function itemKuerzel(g) {
		return String(pick(g, ['kuerzel']) || '');
	}
	function itemName(g) {
		return String(pick(g, ['name']) || '');
	}
	function itemDatum(g) {
		return pick(g, ['datum', 'date', 'stand', 'updated_at', 'created_at']);
	}
	function itemZusammenfassung(g) {
		return pick(g, ['zusammenfassung', 'beschreibung', 'description', 'text', 'summary']);
	}
	function itemKontext(g) {
		if (!g || typeof g !== 'object') return '';
		var v = g.kontext;
		if (v == null || v === '') {
			v = g.context;
		}
		if (v == null || v === '') {
			v = g.Kontext;
		}
		if ((v == null || v === '') && g.attributes && typeof g.attributes === 'object') {
			var a = g.attributes;
			v = a.kontext != null ? a.kontext : a.context;
		}
		if (v == null) return '';
		if (typeof v === 'string') return v;
		if (typeof v === 'object') {
			try {
				return JSON.stringify(v, null, 2);
			} catch (e2) {
				return String(v);
			}
		}
		return String(v);
	}
	function itemBgblReferenz(g) {
		return pick(g, ['bgbl_referenz', 'bgblReferenz']);
	}
	function itemPollId(g) {
		var v = pick(g, ['poll_id', 'pollId', 'abstimmung_id', 'vote_id']);
		return v === '' ? '' : String(v);
	}

	function normalizeKuerzelCode(k) {
		return String(k || '')
			.trim()
			.toUpperCase()
			.replace(/[^A-Z0-9]/g, '');
	}

	function rechtGebietFromKuerzel(kuerzel) {
		var kRaw = String(kuerzel || '').trim();
		var u = normalizeKuerzelCode(kuerzel);
		if (['BGB', 'HGB', 'GMBHG'].indexOf(u) >= 0) return 'zivil';
		if (['STGB', 'STPO'].indexOf(u) >= 0) return 'straf';
		if (['GG', 'BVERFGG'].indexOf(u) >= 0) return 'verfassung';
		if (['ESTG', 'KSTG', 'USTG', 'MILOG'].indexOf(u) >= 0) return 'steuer_arbeit';
		if (['BSHG', 'ASYLBLG'].indexOf(u) >= 0) return 'sozial';
		if (u.indexOf('SGB') === 0) return 'sozial';
		return 'bundes';
	}

	function badgeClassFromKey(key) {
		var map = {
			zivil: 'gz-badge--zivil',
			sozial: 'gz-badge--sozial',
			steuer_arbeit: 'gz-badge--steuer-arbeit',
			straf: 'gz-badge--straf',
			verfassung: 'gz-badge--verfassung',
			bundes: 'gz-badge--bundes'
		};
		return map[key] || map.bundes;
	}

	function badgeLabelFromKey(key) {
		var map = {
			zivil: 'badge_zivil',
			sozial: 'badge_sozial',
			steuer_arbeit: 'badge_steuer_arbeit',
			straf: 'badge_straf',
			verfassung: 'badge_verfassung',
			bundes: 'badge_bundes'
		};
		var ik = map[key] || map.bundes;
		return i18n[ik] || '';
	}

	function formatDatumDisplay(raw) {
		var s = String(raw || '').trim();
		var m = /^(\d{4})-(\d{2})-(\d{2})/.exec(s);
		if (!m) return s || '—';
		var y = parseInt(m[1], 10);
		var mo = parseInt(m[2], 10) - 1;
		var d = parseInt(m[3], 10);
		var dt = new Date(y, mo, d);
		if (isNaN(dt.getTime())) return s;
		if (getLang() === 'en') {
			return dt.toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' });
		}
		var months = [
			'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
			'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
		];
		var dayStr = d < 10 ? '0' + d : String(d);
		return dayStr + '. ' + months[mo] + ' ' + y;
	}

	function countDiffPlusMinus(diffStr) {
		var lines = String(diffStr || '').split(/\r?\n/);
		var plus = 0;
		var minus = 0;
		for (var i = 0; i < lines.length; i++) {
			var line = lines[i];
			if (/^@@/.test(line)) continue;
			if (/^---(\s|$)/.test(line) || line === '---') continue;
			if (/^\+\+\+(\s|$)/.test(line) || line === '+++') continue;
			if (/^\+/.test(line)) plus++;
			else if (/^-/.test(line)) minus++;
		}
		return { plus: plus, minus: minus };
	}

	function applyCardBorderFromDiff(detail, diffStr) {
		detail.classList.remove(
			'gz-card--border-default',
			'gz-card--border-expand',
			'gz-card--border-contract',
			'gz-card--border-balance'
		);
		var raw = String(diffStr || '').trim();
		if (!raw) {
			detail.classList.add('gz-card--border-default');
			return;
		}
		var c = countDiffPlusMinus(raw);
		if (c.plus > c.minus) detail.classList.add('gz-card--border-expand');
		else if (c.minus > c.plus) detail.classList.add('gz-card--border-contract');
		else detail.classList.add('gz-card--border-balance');
	}

	function renderDiffColumns(diffStr) {
		var lines = String(diffStr || '').split(/\r?\n/);
		var rows = [];
		var i = 0;
		while (i < lines.length) {
			var line = lines[i];
			if (/^@@/.test(line)) {
				i++;
				continue;
			}
			if (/^\\ No newline/.test(line)) {
				rows.push({ t: 'ctx', text: line });
				i++;
				continue;
			}
			if (/^---(\s|$)/.test(line) || line === '---') {
				i++;
				continue;
			}
			if (/^\+\+\+(\s|$)/.test(line) || line === '+++') {
				i++;
				continue;
			}
			var c0 = line.charAt(0);
			if (c0 === ' ') {
				rows.push({ t: 'ctx', text: line.slice(1) });
				i++;
			} else if (c0 === '-') {
				var next = lines[i + 1];
				if (next && next.charAt(0) === '+') {
					rows.push({ t: 'pair', old: line.slice(1), neu: next.slice(1) });
					i += 2;
				} else {
					rows.push({ t: 'minus', text: line.slice(1) });
					i++;
				}
			} else if (c0 === '+') {
				rows.push({ t: 'plus', text: line.slice(1) });
				i++;
			} else if (line === '') {
				rows.push({ t: 'ctx', text: '' });
				i++;
			} else {
				rows.push({ t: 'ctx', text: line });
				i++;
			}
		}
		var html =
			'<div class="gz-diff-table" role="region" aria-label="Synopse">' +
			'<div class="gz-diff-header-row" role="row">' +
			'<span class="gz-diff-header gz-diff-header--old">' +
			esc(i18n.synopseColOld || '') +
			'</span>' +
			'<span class="gz-diff-header gz-diff-header--new">' +
			esc(i18n.synopseColNew || '') +
			'</span>' +
			'</div>';
		for (var r = 0; r < rows.length; r++) {
			var row = rows[r];
			if (row.t === 'ctx') {
				html +=
					'<div class="gz-diff-row gz-diff-row--context">' +
					'<div class="gz-diff-context-inner">' +
					esc(row.text) +
					'</div></div>';
			} else if (row.t === 'pair') {
				html +=
					'<div class="gz-diff-row gz-diff-row--split">' +
					'<div class="gz-diff-cell gz-diff-cell--old">' +
					esc(row.old) +
					'</div>' +
					'<div class="gz-diff-cell gz-diff-cell--new">' +
					esc(row.neu) +
					'</div></div>';
			} else if (row.t === 'minus') {
				html +=
					'<div class="gz-diff-row gz-diff-row--split">' +
					'<div class="gz-diff-cell gz-diff-cell--old">' +
					esc(row.text) +
					'</div>' +
					'<div class="gz-diff-cell gz-diff-cell--new gz-diff-cell--empty"></div></div>';
			} else if (row.t === 'plus') {
				html +=
					'<div class="gz-diff-row gz-diff-row--split">' +
					'<div class="gz-diff-cell gz-diff-cell--old gz-diff-cell--empty"></div>' +
					'<div class="gz-diff-cell gz-diff-cell--new">' +
					esc(row.text) +
					'</div></div>';
			}
		}
		html += '</div>';
		return html;
	}

	function extractDiffFromPayload(payload) {
		if (payload == null) return '';
		if (typeof payload === 'string') return payload;
		/* API GET /api/gesetze/{id}: diff im JSON-Root, z. B. { "id": 1, "diff": "@@ -4492..." } */
		if (typeof payload === 'object' && Object.prototype.hasOwnProperty.call(payload, 'diff')) {
			var dRoot = payload.diff;
			if (typeof dRoot === 'string') return dRoot;
		}
		if (typeof payload.synopse === 'string') return payload.synopse;
		if (payload.data && typeof payload.data === 'object') {
			var d = payload.data;
			if (typeof d.diff === 'string') return d.diff;
			if (typeof d.synopse === 'string') return d.synopse;
		}
		return '';
	}

	function renderBgblRef(ref) {
		var s = String(ref == null ? '' : ref).trim();
		if (!s) return '';
		var label = esc(i18n.sourceLabel || 'Quelle');
		if (/^https?:\/\//i.test(s)) {
			return (
				'<p class="gz-bgbl">' +
				'<span class="gz-bgbl-label">' + label + ':</span> ' +
				'<a href="' + esc(s) + '" target="_blank" rel="noopener noreferrer" class="gz-bgbl-link">' + esc(s) + '</a>' +
				'</p>'
			);
		}
		return (
			'<p class="gz-bgbl">' +
			'<span class="gz-bgbl-label">' + label + ':</span> ' +
			'<span class="gz-bgbl-text">' + esc(s) + '</span>' +
			'</p>'
		);
	}

	function formatAbstimmungen(data) {
		if (data == null) return '<p class="gz-muted">' + esc(i18n.abstimmungenEmpty) + '</p>';
		if (typeof data === 'string') {
			return '<pre class="gz-pre">' + esc(data) + '</pre>';
		}
		if (Array.isArray(data)) {
			if (data.length === 0) {
				return '<p class="gz-muted">' + esc(i18n.abstimmungenEmpty) + '</p>';
			}
			var ul = '<ul class="gz-ab-list">';
			for (var i = 0; i < data.length; i++) {
				ul += '<li><pre class="gz-pre gz-pre--inline">' + esc(JSON.stringify(data[i], null, 2)) + '</pre></li>';
			}
			return ul + '</ul>';
		}
		return '<pre class="gz-pre">' + esc(JSON.stringify(data, null, 2)) + '</pre>';
	}

	function ensureAbstimmungenPanel(detail) {
		var panel = detail.querySelector('.gz-abstimmungen-panel');
		if (panel) return panel;
		var body = detail.querySelector('.gz-card-body');
		if (!body) return null;
		panel = document.createElement('div');
		panel.className = 'gz-abstimmungen-panel';
		panel.setAttribute('hidden', '');
		body.appendChild(panel);
		return panel;
	}

	function fetchAbstimmungen(detail, pollId) {
		var panel = ensureAbstimmungenPanel(detail);
		if (!panel) return;
		panel.removeAttribute('hidden');
		panel.innerHTML = '<p class="gz-muted">' + esc(i18n.abstimmungenLoading) + '</p>';
		var url = base + '/api/abstimmungen/' + encodeURIComponent(pollId);
		fetch(url)
			.then(function (r) {
				if (!r.ok) throw new Error('HTTP ' + r.status);
				return r.json();
			})
			.then(function (data) {
				panel.innerHTML =
					'<div class="gz-abstimmungen-head">' + esc(i18n.abstimmungenTitle) + '</div>' +
					'<div class="gz-abstimmungen-body">' + formatAbstimmungen(data) + '</div>';
			})
			.catch(function () {
				panel.innerHTML = '<p class="gz-error">' + esc(i18n.abstimmungenError) + '</p>';
			});
	}

	function bindSynopseToggle(btn, syn) {
		btn.addEventListener('click', function (e) {
			e.preventDefault();
			e.stopPropagation();
			var open = syn.hasAttribute('hidden');
			if (open) {
				syn.removeAttribute('hidden');
				btn.textContent = i18n.synopseHide || 'Hide';
			} else {
				syn.setAttribute('hidden', '');
				btn.textContent = i18n.synopseShow || 'Show';
			}
		});
	}

	function loadDiffLazy(detail, gesetzId) {
		var wrap = detail.querySelector('.gz-diff-wrap');
		if (!wrap) return;
		var st = wrap.getAttribute('data-diff-state');
		if (st === 'done' || st === 'loading') return;
		wrap.setAttribute('data-diff-state', 'loading');

		var inner = wrap.querySelector('.gz-diff-inner');
		if (!inner) return;

		if (!gesetzId) {
			applyCardBorderFromDiff(detail, '');
			inner.innerHTML = '<p class="gz-muted">' + esc(i18n.noSynopse) + '</p>';
			wrap.setAttribute('data-diff-state', 'done');
			return;
		}

		inner.innerHTML = '<p class="gz-muted">' + esc(i18n.synopseLoading || '') + '</p>';

		fetch(base + '/api/gesetze/' + encodeURIComponent(gesetzId))
			.then(function (r) {
				if (!r.ok) throw new Error('HTTP ' + r.status);
				var ct = (r.headers.get('content-type') || '').toLowerCase();
				if (ct.indexOf('application/json') !== -1) return r.json();
				return r.text().then(function (t) {
					return { __plain: t };
				});
			})
			.then(function (payload) {
				var diffStr = '';
				if (payload && typeof payload.__plain === 'string') {
					diffStr = payload.__plain.trim();
				} else {
					diffStr = String(extractDiffFromPayload(payload) || '').trim();
				}
				applyCardBorderFromDiff(detail, diffStr);
				if (!diffStr) {
					inner.innerHTML = '<p class="gz-muted">' + esc(i18n.noSynopse) + '</p>';
					return;
				}
				inner.innerHTML =
					'<button type="button" class="gz-btn-synopse em-btn-secondary">' + esc(i18n.synopseShow) + '</button>' +
					'<div class="gz-synopse" hidden><div class="gz-diff-columns-wrap">' +
					renderDiffColumns(diffStr) +
					'</div></div>';
				var btn = inner.querySelector('.gz-btn-synopse');
				var syn = inner.querySelector('.gz-synopse');
				if (btn && syn) bindSynopseToggle(btn, syn);
			})
			.catch(function () {
				applyCardBorderFromDiff(detail, '');
				inner.innerHTML = '<p class="gz-error">' + esc(i18n.loadError) + '</p>';
			})
			.finally(function () {
				wrap.setAttribute('data-diff-state', 'done');
			});
	}

	function bindKontextToggle(detail) {
		var btn = detail.querySelector('.gz-kontext-toggle');
		var panel = detail.querySelector('.gz-kontext-panel');
		if (!btn || !panel) return;
		var showLabel = i18n.kontextShow || 'Kontext anzeigen ▼';
		var hideLabel = i18n.kontextHide || 'Kontext ausblenden ▲';
		function setOpen(open) {
			if (open) {
				panel.classList.add('gz-kontext-panel--open');
				btn.setAttribute('aria-expanded', 'true');
				btn.textContent = hideLabel;
			} else {
				panel.classList.remove('gz-kontext-panel--open');
				btn.setAttribute('aria-expanded', 'false');
				btn.textContent = showLabel;
			}
		}
		setOpen(false);
		btn.addEventListener('click', function (e) {
			e.preventDefault();
			e.stopPropagation();
			setOpen(!panel.classList.contains('gz-kontext-panel--open'));
		});
	}

	function bindCard(detail, gesetzId) {
		var pollId = detail.getAttribute('data-poll-id') || '';
		var abstLoaded = false;

		bindKontextToggle(detail);

		detail.addEventListener('toggle', function () {
			if (!detail.open) return;
			loadDiffLazy(detail, gesetzId);
			if (abstLoaded) return;
			abstLoaded = true;
			var panel = ensureAbstimmungenPanel(detail);
			if (!panel) return;
			panel.removeAttribute('hidden');
			if (!pollId) {
				panel.innerHTML =
					'<p class="gz-abstimmungen-pending">' + esc(i18n.abstimmungenPending || '') + '</p>';
				return;
			}
			fetchAbstimmungen(detail, pollId);
		});
	}

	function renderPage() {
		cards.innerHTML = '';
		if (!rawData.length) {
			var emptyAll = document.createElement('p');
			emptyAll.className = 'gz-empty';
			emptyAll.textContent = i18n.empty || '';
			cards.appendChild(emptyAll);
			if (el.pagerMeta) el.pagerMeta.innerHTML = '';
			if (el.btnPrev) el.btnPrev.disabled = true;
			if (el.btnNext) el.btnNext.disabled = true;
			return;
		}

		var all = getFilteredSorted();
		var total = all.length;
		var totalPages = Math.max(1, Math.ceil(total / PAGE_SIZE));
		if (page > totalPages) page = totalPages;
		if (page < 1) page = 1;
		var start = (page - 1) * PAGE_SIZE;
		var slice = all.slice(start, start + PAGE_SIZE);

		if (!total) {
			var emptyF = document.createElement('p');
			emptyF.className = 'gz-empty';
			emptyF.textContent = i18n.filterEmpty || '';
			cards.appendChild(emptyF);
			if (el.pagerMeta) el.pagerMeta.innerHTML = '';
			if (el.btnPrev) el.btnPrev.disabled = true;
			if (el.btnNext) el.btnNext.disabled = true;
			return;
		}

		if (el.pagerMeta) el.pagerMeta.innerHTML = pagerMetaHtml(page, totalPages, total);
		if (el.btnPrev) el.btnPrev.disabled = page <= 1;
		if (el.btnNext) el.btnNext.disabled = page >= totalPages || total === 0;

		for (var i = 0; i < slice.length; i++) {
			var g = slice[i] || {};
			var gesetzId = itemGesetzId(g);
			var kuerzel = itemKuerzel(g);
			var name = itemName(g);
			var datum = itemDatum(g);
			var zusammenfassung = itemZusammenfassung(g);
			var kontext = String(itemKontext(g) || '').trim();
			var bgbl = itemBgblReferenz(g);
			var pollId = itemPollId(g);

			var d = document.createElement('details');
			d.className = 'gz-card gz-card--border-default';
			if (gesetzId) d.setAttribute('data-gesetz-id', gesetzId);
			if (pollId) d.setAttribute('data-poll-id', pollId);

			var rgKey = rechtGebietFromKuerzel(kuerzel);
			var badgeHtml =
				'<span class="gz-badge ' +
				badgeClassFromKey(rgKey) +
				'">' +
				esc(badgeLabelFromKey(rgKey)) +
				'</span>';

			var sum = document.createElement('summary');
			sum.className = 'gz-card-summary';
			var nameHtml = name
				? '<span class="gz-name">' + esc(name) + '</span>'
				: '';
			sum.innerHTML =
				'<div class="gz-summary-top">' +
				badgeHtml +
				'<span class="gz-kuerzel">' + esc(kuerzel || '—') + '</span>' +
				'</div>' +
				'<span class="gz-datum">' + esc(formatDatumDisplay(datum)) + '</span>' +
				nameHtml +
				'<span class="gz-chevron" aria-hidden="true"></span>';

			var hasZusammenfassung = String(zusammenfassung || '').trim() !== '';
			var bodyHtml =
				'<p class="gz-beschreibung">' + esc(zusammenfassung || '—') + '</p>';
			if (hasZusammenfassung) {
				bodyHtml += '<p class="gz-ai-disclaimer">' + esc(i18n.aiDisclaimer || '') + '</p>';
			}

			if (kontext) {
				bodyHtml +=
					'<div class="gz-kontext-block">' +
					'<button type="button" class="gz-kontext-toggle" aria-expanded="false">' +
					esc(i18n.kontextShow || 'Kontext anzeigen ▼') +
					'</button>' +
					'<div class="gz-kontext-panel">' +
					'<div class="gz-kontext-body">' +
					esc(kontext) +
					'</div></div></div>';
			}

			bodyHtml += renderBgblRef(bgbl);

			bodyHtml +=
				'<div class="gz-diff-wrap">' +
				'<div class="gz-diff-inner"></div>' +
				'</div>';

			var body = document.createElement('div');
			body.className = 'gz-card-body';
			body.innerHTML = bodyHtml;

			d.appendChild(sum);
			d.appendChild(body);
			cards.appendChild(d);
			bindCard(d, gesetzId);
		}
	}

	function onFilterChange() {
		filterKey = el.filterDomain ? el.filterDomain.value : 'all';
		searchQuery = el.filterSearch ? el.filterSearch.value : '';
		page = 1;
		renderPage();
	}

	if (el.filterDomain) el.filterDomain.addEventListener('change', onFilterChange);
	if (el.filterSearch) el.filterSearch.addEventListener('input', onFilterChange);

	if (el.sortNew) {
		el.sortNew.addEventListener('click', function () {
			sortDesc = true;
			if (el.sortNew) el.sortNew.classList.add('gz-btn-sort-active');
			if (el.sortOld) el.sortOld.classList.remove('gz-btn-sort-active');
			page = 1;
			renderPage();
		});
	}
	if (el.sortOld) {
		el.sortOld.addEventListener('click', function () {
			sortDesc = false;
			if (el.sortOld) el.sortOld.classList.add('gz-btn-sort-active');
			if (el.sortNew) el.sortNew.classList.remove('gz-btn-sort-active');
			page = 1;
			renderPage();
		});
	}
	if (el.btnPrev) {
		el.btnPrev.addEventListener('click', function () {
			if (page > 1) {
				page -= 1;
				renderPage();
			}
		});
	}
	if (el.btnNext) {
		el.btnNext.addEventListener('click', function () {
			var all = getFilteredSorted();
			var tp = Math.max(1, Math.ceil(all.length / PAGE_SIZE));
			if (page < tp) {
				page += 1;
				renderPage();
			}
		});
	}

	fetch(base + '/api/gesetze')
		.then(function (r) {
			if (!r.ok) throw new Error('HTTP ' + r.status);
			return r.json();
		})
		.then(function (data) {
			rawData = normalizeList(data);
			if (el.loading) el.loading.hidden = true;
			if (el.toolbar) el.toolbar.hidden = false;
			if (el.pager) el.pager.hidden = false;
			showError('');
			page = 1;
			renderPage();
		})
		.catch(function () {
			if (el.loading) el.loading.hidden = true;
			showError(i18n.loadError || '');
		});
})();
</script>

<script>
(function () {
	function switchGzTab(tabKey) {
		var panelGesetze = document.getElementById('gz-panel-gesetze');
		var panelUrteile = document.getElementById('gz-panel-urteile');
		var tabGesetze = document.getElementById('gz-tab-gesetze');
		var tabUrteile = document.getElementById('gz-tab-urteile');
		if (!panelGesetze || !panelUrteile || !tabGesetze || !tabUrteile) return;

		var isUrteile = tabKey === 'urteile';
		panelGesetze.hidden = isUrteile;
		panelUrteile.hidden = !isUrteile;

		tabGesetze.setAttribute('aria-selected', String(!isUrteile));
		tabUrteile.setAttribute('aria-selected', String(isUrteile));

		tabGesetze.classList.toggle('gz-tab-btn--active', !isUrteile);
		tabUrteile.classList.toggle('gz-tab-btn--active', isUrteile);

		window.gzActiveTab = tabKey;
	}

	window.gzSwitchTab = switchGzTab;

	var btnGesetze = document.querySelector('button.gz-tab-btn[data-tab="gesetze"]');
	var btnUrteile = document.querySelector('button.gz-tab-btn[data-tab="urteile"]');
	if (btnGesetze) {
		btnGesetze.addEventListener('click', function (e) {
			e.preventDefault();
			switchGzTab('gesetze');
		});
	}
	if (btnUrteile) {
		btnUrteile.addEventListener('click', function (e) {
			e.preventDefault();
			switchGzTab('urteile');
			if (typeof window.gzEnsureUrteileLoaded === 'function') window.gzEnsureUrteileLoaded();
		});
	}
})();
</script>

<script>
(function () {
	var urteileApp = document.getElementById('gz-urteile-app');
	if (!urteileApp) return;

	var cards = document.getElementById('gz-urteile-cards');
	var pager = document.getElementById('gz-urteile-pager');
	var pagerMeta = document.getElementById('gz-urteile-pager-meta');
	var btnPrev = document.getElementById('gz-urteile-btn-prev');
	var btnNext = document.getElementById('gz-urteile-btn-next');

	var errorEl = document.getElementById('gz-urteile-error');
	var loadingEl = document.getElementById('gz-urteile-loading');
	var skeletonEl = document.getElementById('gz-urteile-skeleton');

	var base = (urteileApp.getAttribute('data-api-base') || '').replace(/\/$/, '');
	var i18n = {};
	try {
		i18n = JSON.parse(urteileApp.getAttribute('data-i18n') || '{}');
	} catch (e) {}

	var PAGE_SIZE = 20;

	var rawData = [];
	var loaded = false;
	var loading = false;

	var page = 1;
	var sortLatest = true;
	var filterSearch = '';
	var filterCourt = 'all';
	var filterArea = 'all';
	var filterTime = '30d';

	var el = {
		filterToggle: document.getElementById('gz-urteile-filter-toggle'),
		filterPanel: document.getElementById('gz-urteile-filter-panel'),
		filterSearch: document.getElementById('gz-urteile-filter-search'),
		filterCourt: document.getElementById('gz-urteile-filter-court'),
		filterArea: document.getElementById('gz-urteile-filter-area'),
		filterTime: document.getElementById('gz-urteile-filter-time'),
		sortLatest: document.getElementById('gz-urteile-sort-latest'),
		sortOldest: document.getElementById('gz-urteile-sort-oldest'),
	};

	function showError(msg) {
		if (!errorEl) return;
		if (msg) {
			errorEl.textContent = msg;
			errorEl.hidden = false;
		} else {
			errorEl.textContent = '';
			errorEl.hidden = true;
		}
	}

	function esc(s) {
		if (s == null) return '';
		var d = document.createElement('div');
		d.textContent = String(s);
		return d.innerHTML;
	}

	function escAttr(s) {
		return esc(s);
	}

	function nl2br(s) {
		return esc(s).replace(/\n/g, '<br/>');
	}

	function getLang() {
		return document.documentElement.getAttribute('data-lang') === 'en' ? 'en' : 'de';
	}

	function parseIsoDate(raw) {
		var s = String(raw || '').trim();
		var m = /^(\d{4})-(\d{2})-(\d{2})/.exec(s);
		if (!m) return null;
		var y = parseInt(m[1], 10);
		var mo = parseInt(m[2], 10) - 1;
		var d = parseInt(m[3], 10);
		var dt = new Date(y, mo, d);
		return isNaN(dt.getTime()) ? null : dt;
	}

	function formatDatumDisplay(raw) {
		var dt = parseIsoDate(raw);
		if (!dt) return String(raw || '').trim() || '—';
		if (getLang() === 'en') {
			return dt.toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' });
		}
		var months = [
			'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
			'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
		];
		var d = dt.getDate();
		var mo = dt.getMonth();
		var y = dt.getFullYear();
		var dayStr = d < 10 ? '0' + d : String(d);
		return dayStr + '. ' + months[mo] + ' ' + y;
	}

	function badgeClassFromRechtsgebiet(rg) {
		var s = String(rg || '');
		if (s.indexOf('Zivilrecht') !== -1) return 'gz-badge--zivil';
		if (s.indexOf('Strafrecht') !== -1) return 'gz-badge--straf';
		if (s.indexOf('Verfassungsrecht') !== -1) return 'gz-badge--verfassung';
		if (s.indexOf('Verwaltungsrecht') !== -1) return 'gz-badge--verwaltungsrecht';
		if (s.indexOf('Öffentliches Recht') !== -1) return 'gz-badge--oeffentliches-recht';
		if (s.indexOf('Steuerrecht') !== -1) return 'gz-badge--steuer-arbeit';
		if (s.indexOf('Arbeitsrecht') !== -1) return 'gz-badge--arbeitsrecht';
		if (s.indexOf('Sozialrecht') !== -1) return 'gz-badge--sozial';
		if (s.indexOf('Patentrecht') !== -1) return 'gz-badge--patentrecht';
		return 'gz-badge--bundes';
	}

	function courtTypeLabelFromTyp(typ) {
		var t = String(typ || '').trim();
		if (!t) return '—';
		if (getLang() === 'en') {
			if (t === 'Urteil') return 'Judgment';
			if (t === 'Beschluss') return 'Ruling';
			if (t === 'Gerichtsbescheid') return 'Court judgment';
		}
		return t;
	}

	function pagerMetaHtml(p, tp, n) {
		if (i18n.pagerSeite && i18n.pagerVon && i18n.pagerEntriesTotal) {
			return (
				'<span class="gz-pager-primary">' +
				'<span class="gz-pager-w">' +
				esc(i18n.pagerSeite) +
				'</span> ' +
				'<strong class="gz-pager-cur">' +
				esc(String(p)) +
				'</strong> ' +
				'<span class="gz-pager-w">' +
				esc(i18n.pagerVon) +
				'</span> ' +
				'<span class="gz-pager-tmax">' +
				esc(String(tp)) +
				'</span>' +
				'</span>' +
				'<span class="gz-pager-sep" aria-hidden="true">·</span>' +
				'<span class="gz-pager-n">' +
				esc(String(n)) +
				' <span class="gz-pager-w">' +
				esc(i18n.pagerEntriesTotal) +
				'</span></span>'
			);
		}
		var tpl = i18n.pagerMetaTpl || '';
		return esc(
			tpl.replace(/\{p\}/g, String(p)).replace(/\{tp\}/g, String(tp)).replace(/\{n\}/g, String(n))
		);
	}

	function getFilteredSorted() {
		var rows = rawData.slice();

		if (filterCourt !== 'all') {
			rows = rows.filter(function (r) {
				return String(r.gericht || '') === filterCourt;
			});
		}

		if (filterArea !== 'all') {
			rows = rows.filter(function (r) {
				return String(r.rechtsgebiet || '').indexOf(filterArea) !== -1;
			});
		}

		if (filterTime !== 'all') {
			var now = new Date();
			var threshold = null;
			if (filterTime === '30d') threshold = new Date(now.getTime() - 30 * 24 * 60 * 60 * 1000);
			if (filterTime === '3m') threshold = new Date(now.getTime() - 90 * 24 * 60 * 60 * 1000);
			if (filterTime === '1y') threshold = new Date(now.getTime() - 365 * 24 * 60 * 60 * 1000);
			if (threshold) {
				rows = rows.filter(function (r) {
					var dt = parseIsoDate(r.datum);
					return dt && dt.getTime() >= threshold.getTime();
				});
			}
		}

		var q = String(filterSearch || '').trim().toLowerCase();
		if (q) {
			rows = rows.filter(function (r) {
				var az = String(r.aktenzeichen || '').toLowerCase();
				var ls = String(r.leitsatz || '').toLowerCase();
				return az.indexOf(q) !== -1 || ls.indexOf(q) !== -1;
			});
		}

		rows.sort(function (a, b) {
			var da = parseIsoDate(a.datum);
			var db = parseIsoDate(b.datum);
			var ta = da ? da.getTime() : 0;
			var tb = db ? db.getTime() : 0;
			if (sortLatest) return tb - ta;
			return ta - tb;
		});

		return rows;
	}

	function bindCollapse(button, panel, showText, hideText) {
		if (!button || !panel) return;
		button.textContent = showText;
		button.setAttribute('aria-expanded', 'false');
		panel.hidden = true;

		button.addEventListener('click', function (e) {
			e.preventDefault();
			e.stopPropagation();
			var open = String(button.getAttribute('aria-expanded')) === 'true';
			var willOpen = !open;
			button.setAttribute('aria-expanded', String(willOpen));
			button.textContent = willOpen ? hideText : showText;
			panel.hidden = !willOpen;
		});
	}

	var gesetzeCache = {};
	var gesetzePending = {};

	function loadGesetzeForUrteil(urteilId) {
		var id = String(urteilId || '');
		if (!id) return Promise.resolve([]);
		if (gesetzeCache[id]) return Promise.resolve(gesetzeCache[id]);
		if (gesetzePending[id]) return gesetzePending[id];

		var p = fetch(base + '/api/urteile/' + encodeURIComponent(id))
			.then(function (r) {
				if (!r.ok) throw new Error('HTTP ' + r.status);
				return r.json();
			})
			.then(function (data) {
				var gs = (data && Array.isArray(data.gesetze)) ? data.gesetze : [];
				gesetzeCache[id] = gs;
				return gs;
			})
			.catch(function () {
				gesetzeCache[id] = [];
				return [];
			})
			.finally(function () {
				delete gesetzePending[id];
			});

		gesetzePending[id] = p;
		return p;
	}

	function renderPage() {
		if (!cards) return;
		cards.innerHTML = '';

		var all = getFilteredSorted();
		var total = all.length;
		var totalPages = Math.max(1, Math.ceil(total / PAGE_SIZE));
		if (page > totalPages) page = totalPages;
		if (page < 1) page = 1;

		var start = (page - 1) * PAGE_SIZE;
		var slice = all.slice(start, start + PAGE_SIZE);

		if (!total) {
			var emptyF = document.createElement('p');
			emptyF.className = 'gz-empty';
			emptyF.textContent = i18n.urteileEmpty || '';
			cards.appendChild(emptyF);
			if (pagerMeta) pagerMeta.innerHTML = '';
			if (btnPrev) btnPrev.disabled = true;
			if (btnNext) btnNext.disabled = true;
			if (pager) pager.hidden = true;
			return;
		}

		if (pagerMeta) pagerMeta.innerHTML = pagerMetaHtml(page, totalPages, total);
		if (pager) pager.hidden = false;
		if (btnPrev) btnPrev.disabled = page <= 1;
		if (btnNext) btnNext.disabled = page >= totalPages || total === 0;

		for (var i = 0; i < slice.length; i++) {
			var u = slice[i] || {};
			var id = u.id;
			var gericht = String(u.gericht || '').trim();
			var rechtsgebiet = String(u.rechtsgebiet || '').trim();

			var typ = String(u.typ || '').trim();
			var az = String(u.aktenzeichen || '').trim();
			var summary = String(u.zusammenfassung || '').trim();
			var tenor = String(u.tenor || '').trim();
			var auswirkung = String(u.auswirkung || '').trim();

			var docId = String(u.doc_id || '').trim();
			var fullTextUrl =
				'https://www.rechtsprechung-im-internet.de/jportal/portal/page/bsjrsprod?showdoccase=1&doc.id=jb-' +
				encodeURIComponent(docId);

			var card = document.createElement('div');
			card.className = 'gz-card gz-urteile-card gz-card--border-default';
			card.setAttribute('data-urteil-id', String(id));

			var rgBadgeClass = badgeClassFromRechtsgebiet(rechtsgebiet);
			var courtBadgeClass = 'gz-badge--court';

			var summaryHtml = '';
			if (summary) {
				summaryHtml =
					'<p class="gz-beschreibung">' + esc(summary) + '</p>' +
					'<p class="gz-ai-disclaimer">' + esc(i18n.aiDisclaimer || '') + '</p>';
			}

			var tenorBlock = '';
			if (tenor) {
				var tenorPanelId = 'gz-urteile-tenor-' + escAttr(id);
				tenorBlock =
					'<div class="gz-urteile-collapse-block">' +
					'<button type="button" class="gz-urteile-collapse-toggle" aria-expanded="false" aria-controls="' + escAttr(tenorPanelId) + '" data-collapse-toggle="tenor">' +
					esc(i18n.urteileTenorShow || 'Tenor anzeigen ▾') +
					'</button>' +
					'<div class="gz-urteile-collapse-panel" id="' + escAttr(tenorPanelId) + '" hidden>' +
					'<div class="gz-urteile-collapse-body">' + nl2br(tenor) + '</div></div></div>';
			}

			var auswirkungBlock = '';
			if (auswirkung) {
				var ausPanelId = 'gz-urteile-auswirkung-' + escAttr(id);
				auswirkungBlock =
					'<div class="gz-urteile-collapse-block">' +
					'<button type="button" class="gz-urteile-collapse-toggle" aria-expanded="false" aria-controls="' + escAttr(ausPanelId) + '" data-collapse-toggle="auswirkung">' +
					esc(i18n.urteileAuswirkungShow || 'Auswirkung anzeigen ▾') +
					'</button>' +
					'<div class="gz-urteile-collapse-panel" id="' + escAttr(ausPanelId) + '" hidden>' +
					'<div class="gz-urteile-collapse-body">' + nl2br(auswirkung) + '</div></div></div>';
			}

			card.innerHTML =
				'<div class="gz-urteile-card-top">' +
				'<div class="gz-urteile-badges">' +
				'<span class="gz-badge ' + rgBadgeClass + '">' + esc(rechtsgebiet || '') + '</span>' +
				'<span class="gz-badge ' + courtBadgeClass + '">' + esc(gericht || '') + '</span>' +
				'</div>' +
				'<div class="gz-urteile-date">' + esc(formatDatumDisplay(u.datum)) + '</div>' +
				'</div>' +
				'<div class="gz-card-body">' +
				'<h3 class="gz-urteile-az">' + esc(az || '—') + '</h3>' +
				'<div class="gz-urteile-type">' + esc(courtTypeLabelFromTyp(typ)) + '</div>' +
				summaryHtml +
				'<div class="gz-urteile-laws-chips" id="gz-urteile-laws-' + escAttr(id) + '">' +
				'<span class="gz-muted">' + esc(i18n.urteileLawsLoading || '—') + '</span>' +
				'</div>' +
				'<div class="gz-urteile-collapses">' +
				tenorBlock +
				auswirkungBlock +
				'</div>' +
				'<div class="gz-urteile-fulltext-row">' +
				'<a class="gz-urteile-fulltext-link" href="' + escAttr(fullTextUrl) + '" target="_blank" rel="noopener noreferrer">' +
				esc(i18n.urteileLinkLabel || 'Volltext') +
				'</a>' +
				'</div>' +
				'</div>';

			cards.appendChild(card);

			var tenorBtn = card.querySelector('[data-collapse-toggle="tenor"]');
			var tenorPanel = tenorBtn ? card.querySelector('#' + tenorBtn.getAttribute('aria-controls')) : null;
			if (tenorBtn && tenorPanel) {
				bindCollapse(tenorBtn, tenorPanel, i18n.urteileTenorShow || '', i18n.urteileTenorHide || '');
			}
			var ausBtn = card.querySelector('[data-collapse-toggle="auswirkung"]');
			var ausPanel = ausBtn ? card.querySelector('#' + ausBtn.getAttribute('aria-controls')) : null;
			if (ausBtn && ausPanel) {
				bindCollapse(ausBtn, ausPanel, i18n.urteileAuswirkungShow || '', i18n.urteileAuswirkungHide || '');
			}
		}

		// Load linked laws (chips) for current page only.
		for (var j = 0; j < slice.length; j++) {
			(function (urteilId) {
				var wrap = document.getElementById('gz-urteile-laws-' + escAttr(urteilId));
				if (!wrap) return;
				wrap.innerHTML = '<span class="gz-muted">' + esc(i18n.urteileLawsLoading || '—') + '</span>';
				loadGesetzeForUrteil(urteilId).then(function (gs) {
					if (!wrap || !wrap.isConnected) return;
					if (!gs || !gs.length) {
						wrap.innerHTML = '<span class="gz-muted">—</span>';
						return;
					}
					var html = '';
					for (var k = 0; k < gs.length; k++) {
						var code = String(gs[k] || '').trim();
						if (!code) continue;
						html +=
							'<button type="button" class="gz-urteile-law-chip" data-kuerzel="' + escAttr(code) + '">' +
							esc(code) +
							'</button>';
					}
					wrap.innerHTML = html || '<span class="gz-muted">—</span>';
				});
			})(slice[j].id);
		}
	}

	function ensureLoaded() {
		if (loaded || loading) return;
		loading = true;
		showError('');

		if (loadingEl) loadingEl.hidden = false;
		if (skeletonEl) skeletonEl.hidden = false;
		if (cards) cards.innerHTML = '';
		if (pager) pager.hidden = true;

		fetch(base + '/api/urteile')
			.then(function (r) {
				if (!r.ok) throw new Error('HTTP ' + r.status);
				return r.json();
			})
			.then(function (data) {
				rawData = Array.isArray(data) ? data : [];
				loaded = true;
				page = 1;
				renderPage();
			})
			.catch(function () {
				showError(i18n.urteileLoadError || '');
			})
			.finally(function () {
				loading = false;
				if (loadingEl) loadingEl.hidden = true;
				if (skeletonEl) skeletonEl.hidden = true;
			});
	}

	if (el.filterToggle && el.filterPanel) {
		var updateFilterPanel = function (open) {
			el.filterPanel.classList.toggle('gz-urteile-filter-panel--open', open);
			el.filterPanel.setAttribute('aria-hidden', String(!open));
			el.filterToggle.setAttribute('aria-expanded', String(open));
			el.filterToggle.textContent = open ? (i18n.urteileFilterCollapse || 'Filter ▲') : (i18n.urteileFilterExpand || 'Filter ▾');
		};

		updateFilterPanel(false);

		el.filterToggle.addEventListener('click', function (e) {
			e.preventDefault();
			e.stopPropagation();
			var open = el.filterPanel.classList.contains('gz-urteile-filter-panel--open');
			updateFilterPanel(!open);
		});
	}

	function onFilterChange() {
		filterSearch = el.filterSearch ? el.filterSearch.value : '';
		filterCourt = el.filterCourt ? el.filterCourt.value : 'all';
		filterArea = el.filterArea ? el.filterArea.value : 'all';
		filterTime = el.filterTime ? el.filterTime.value : 'all';

		page = 1;
		renderPage();
	}

	if (el.filterSearch) el.filterSearch.addEventListener('input', function () {
		if (!loaded) return;
		onFilterChange();
	});
	if (el.filterCourt) el.filterCourt.addEventListener('change', function () {
		if (!loaded) return;
		onFilterChange();
	});
	if (el.filterArea) el.filterArea.addEventListener('change', function () {
		if (!loaded) return;
		onFilterChange();
	});
	if (el.filterTime) el.filterTime.addEventListener('change', function () {
		if (!loaded) return;
		onFilterChange();
	});

	if (el.sortLatest) {
		el.sortLatest.addEventListener('click', function () {
			sortLatest = true;
			if (el.sortLatest) el.sortLatest.classList.add('gz-btn-sort-active');
			if (el.sortOldest) el.sortOldest.classList.remove('gz-btn-sort-active');
			page = 1;
			renderPage();
		});
	}
	if (el.sortOldest) {
		el.sortOldest.addEventListener('click', function () {
			sortLatest = false;
			if (el.sortOldest) el.sortOldest.classList.add('gz-btn-sort-active');
			if (el.sortLatest) el.sortLatest.classList.remove('gz-btn-sort-active');
			page = 1;
			renderPage();
		});
	}

	if (btnPrev) {
		btnPrev.addEventListener('click', function () {
			if (page > 1) {
				page -= 1;
				renderPage();
			}
		});
	}
	if (btnNext) {
		btnNext.addEventListener('click', function () {
			var all = getFilteredSorted();
			var tp = Math.max(1, Math.ceil(all.length / PAGE_SIZE));
			if (page < tp) {
				page += 1;
				renderPage();
			}
		});
	}

	if (cards) {
		cards.addEventListener('click', function (e) {
			var btn = e.target && e.target.closest ? e.target.closest('.gz-urteile-law-chip') : null;
			if (!btn) return;
			var kuerzel = btn.getAttribute('data-kuerzel') || '';
			if (!kuerzel) return;
			if (typeof window.gzSwitchTab === 'function') window.gzSwitchTab('gesetze');
			var lawDomain = document.getElementById('gz-filter-domain');
			if (lawDomain) lawDomain.value = 'all';
			var lawSearch = document.getElementById('gz-filter-search');
			if (lawSearch) {
				lawSearch.value = kuerzel;
				lawSearch.dispatchEvent(new Event('input', { bubbles: true }));
			}
		});
	}

	window.gzEnsureUrteileLoaded = ensureLoaded;

	// If the tab is already active (e.g. restored by browser), load immediately.
	var urteileTab = document.getElementById('gz-tab-urteile');
	if (urteileTab && urteileTab.getAttribute('aria-selected') === 'true') {
		ensureLoaded();
	}
})();
</script>

<?php get_footer(); ?>
