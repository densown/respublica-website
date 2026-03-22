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
	'synopseColOld'      => rp_t('Alte Fassung', 'Previous version'),
	'synopseColNew'      => rp_t('Neue Fassung', 'New version'),
	'sourceLabel'        => rp_t('Quelle', 'Source'),
	'badge_zivil'        => rp_t('Zivilrecht', 'Civil law'),
	'badge_sozial'       => rp_t('Sozialrecht', 'Social law'),
	'badge_steuer_arbeit' => rp_t('Steuerrecht/Arbeitsrecht', 'Tax & labour law'),
	'badge_straf'        => rp_t('Strafrecht', 'Criminal law'),
	'badge_verfassung'   => rp_t('Verfassungsrecht', 'Constitutional law'),
	'badge_bundes'       => rp_t('Bundesrecht', 'Federal law'),
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
		btn.addEventListener('click', function (e) {
			e.preventDefault();
			e.stopPropagation();
			var isOpen = !panel.hasAttribute('hidden');
			if (isOpen) {
				panel.setAttribute('hidden', '');
				btn.setAttribute('aria-expanded', 'false');
			} else {
				panel.removeAttribute('hidden');
				btn.setAttribute('aria-expanded', 'true');
			}
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

			var bodyHtml =
				'<p class="gz-beschreibung">' + esc(zusammenfassung || '—') + '</p>';

			if (kontext) {
				bodyHtml +=
					'<div class="gz-kontext-block">' +
					'<button type="button" class="gz-kontext-toggle" aria-expanded="false">' +
					esc(i18n.kontextLabel || 'Kontext') +
					'</button>' +
					'<div class="gz-kontext-panel" hidden>' +
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
			root.appendChild(d);
			bindCard(d, gesetzId);
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
