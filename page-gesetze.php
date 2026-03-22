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
	'abstimmungenEmpty'  => rp_t('Keine Abstimmungsdaten vorhanden.', 'No vote data available.'),
	'noSynopse'          => rp_t('Keine Synopse hinterlegt.', 'No synopsis available.'),
);

get_header();
get_template_part('template-parts/global/masthead');
get_template_part('template-parts/global/nav');
get_template_part('template-parts/global/breaking-ticker');
?>

<main class="site-main gesetze-page election-monitor-page">

	<div class="em-hero gz-hero">
		<div class="em-hero-inner">
			<div class="em-hero-label">
				<?php echo rp_t('Parlament &amp; Recht', 'Parliament &amp; Law'); ?>
			</div>
			<h1 class="em-hero-title">
				<?php echo rp_t('Gesetzesänderungen', 'Legislative changes'); ?>
			</h1>
			<p class="em-hero-desc">
				<?php echo rp_t(
					'Hier dokumentieren wir Änderungen an Gesetzestexten mit Kurzbeschreibung und Synopse. Abstimmungsdaten werden geladen, sobald du eine Änderung aufklappst.',
					'We document changes to legislation with short summaries and synopses. Vote data loads when you expand an entry.'
				); ?>
			</p>
		</div>
	</div>

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
				id="gz-root"
				class="gz-root"
				data-api-base="<?php echo esc_attr($gz_api_base); ?>"
				data-i18n="<?php echo esc_attr(wp_json_encode($gz_i18n)); ?>"
			>
				<p class="gz-status gz-loading"><?php echo esc_html($gz_i18n['loading']); ?></p>
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
	var root = document.getElementById('gz-root');
	if (!root) return;

	var base = (root.getAttribute('data-api-base') || '').replace(/\/$/, '');
	var i18n = {};
	try {
		i18n = JSON.parse(root.getAttribute('data-i18n') || '{}');
	} catch (e) {}

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

	function itemKuerzel(g) {
		return pick(g, ['kuerzel', 'gesetz', 'short', 'law', 'slug', 'id']);
	}
	function itemDatum(g) {
		return pick(g, ['datum', 'date', 'stand', 'updated_at', 'created_at']);
	}
	function itemBeschreibung(g) {
		return pick(g, ['beschreibung', 'description', 'text', 'summary', 'titel', 'title']);
	}
	function itemDiff(g) {
		return pick(g, ['diff', 'synopse', 'aenderung', 'change', 'patch']);
	}
	function itemPollId(g) {
		var v = pick(g, ['poll_id', 'pollId', 'abstimmung_id', 'vote_id']);
		return v === '' ? '' : String(v);
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

	function bindCard(detail) {
		var pollId = detail.getAttribute('data-poll-id') || '';
		var abstLoaded = false;

		detail.addEventListener('toggle', function () {
			if (!detail.open || abstLoaded) return;
			abstLoaded = true;
			var panel = ensureAbstimmungenPanel(detail);
			if (!panel) return;
			panel.removeAttribute('hidden');
			if (!pollId) {
				panel.innerHTML = '<p class="gz-muted">' + esc(i18n.abstimmungenNone) + '</p>';
				return;
			}
			fetchAbstimmungen(detail, pollId);
		});

		var btn = detail.querySelector('.gz-btn-synopse');
		var syn = detail.querySelector('.gz-synopse');
		if (btn && syn) {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
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
	}

	function render(items) {
		root.innerHTML = '';
		if (!items.length) {
			var empty = document.createElement('p');
			empty.className = 'gz-empty';
			empty.textContent = i18n.empty || '';
			root.appendChild(empty);
			return;
		}

		for (var i = 0; i < items.length; i++) {
			var g = items[i] || {};
			var kuerzel = itemKuerzel(g);
			var datum = itemDatum(g);
			var beschreibung = itemBeschreibung(g);
			var diffRaw = itemDiff(g);
			var pollId = itemPollId(g);

			var diffStr = diffRaw === '' ? '' : String(diffRaw);

			var d = document.createElement('details');
			d.className = 'gz-card';
			if (pollId) d.setAttribute('data-poll-id', pollId);

			var sum = document.createElement('summary');
			sum.className = 'gz-card-summary';
			sum.innerHTML =
				'<span class="gz-kuerzel">' + esc(kuerzel || '—') + '</span>' +
				'<span class="gz-datum">' + esc(datum || '—') + '</span>' +
				'<span class="gz-chevron" aria-hidden="true"></span>';

			var body = document.createElement('div');
			body.className = 'gz-card-body';
			var bodyHtml =
				'<p class="gz-beschreibung">' + esc(beschreibung) + '</p>';
			if (diffStr) {
				bodyHtml +=
					'<button type="button" class="gz-btn-synopse em-btn-secondary">' + esc(i18n.synopseShow) + '</button>' +
					'<div class="gz-synopse" hidden><pre class="gz-diff-pre">' + esc(diffStr) + '</pre></div>';
			} else {
				bodyHtml += '<p class="gz-muted">' + esc(i18n.noSynopse) + '</p>';
			}
			body.innerHTML = bodyHtml;

			d.appendChild(sum);
			d.appendChild(body);
			root.appendChild(d);
			bindCard(d);
		}
	}

	fetch(base + '/api/gesetze')
		.then(function (r) {
			if (!r.ok) throw new Error('HTTP ' + r.status);
			return r.json();
		})
		.then(function (data) {
			render(normalizeList(data));
		})
		.catch(function () {
			root.innerHTML = '<p class="gz-error">' + esc(i18n.loadError) + '</p>';
		});
})();
</script>

<?php get_footer(); ?>
