<?php

// declare(strict_types=1); // duplicate block; strict types must be the first statement

add_action('wp_enqueue_scripts', function (): void {
    // Parent theme CSS
    wp_enqueue_style(
        'blocksy-style',
        get_template_directory_uri() . '/style.css',
        [],
        wp_get_theme(get_template())->get('Version')
    );

    // Google Fonts
    $fonts_url = add_query_arg(
        [
            'family' => implode('|', [
                'Playfair+Display:ital,wght@0,700;0,900;1,700',
                'Source+Serif+4:ital,wght@0,300;0,400;0,600;1,300;1,400;1,600',
                'IBM+Plex+Mono:wght@400;500',
            ]),
            'display' => 'swap',
        ],
        'https://fonts.googleapis.com/css2'
    );

    wp_enqueue_style('respublica-fonts', $fonts_url, [], null);

    // Child theme CSS
    wp_enqueue_style(
        'respublica-theme-style',
        get_stylesheet_uri(),
        ['blocksy-style', 'respublica-fonts'],
        wp_get_theme()->get('Version')
    );
}, 20);

add_action('acf/init', function (): void {
    if (
        !function_exists('acf_add_local_field_group')
        || !function_exists('get_field')
    ) {
        return;
    }

    // Artikel-Felder
    acf_add_local_field_group([
        'key' => 'group_respublica_article',
        'title' => 'Res.Publica – Artikel',
        'fields' => [
            [
                'key' => 'field_res_breaking',
                'label' => 'Breaking',
                'name' => 'breaking',
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 0,
            ],
            [
                'key' => 'field_res_deck',
                'label' => 'Deck',
                'name' => 'deck',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key' => 'field_res_artikel_typ',
                'label' => 'Artikel-Typ',
                'name' => 'artikel_typ',
                'type' => 'select',
                'choices' => [
                    'standard' => 'Standard',
                    'breaking' => 'Breaking',
                    'interview' => 'Interview',
                    'data' => 'Data',
                ],
                'default_value' => 'standard',
                'ui' => 1,
            ],
            [
                'key' => 'field_res_pullquote_text',
                'label' => 'Pullquote Text',
                'name' => 'pullquote_text',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key' => 'field_res_pullquote_attr',
                'label' => 'Pullquote Attribution',
                'name' => 'pullquote_attribution',
                'type' => 'text',
            ],
            [
                'key' => 'field_res_factbox_titel',
                'label' => 'Factbox Titel',
                'name' => 'factbox_titel',
                'type' => 'text',
                'default_value' => 'Auf einen Blick',
            ],
            [
                'key' => 'field_res_factbox_items',
                'label' => 'Factbox Items',
                'name' => 'factbox_items',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Punkt hinzufügen',
                'sub_fields' => [
                    [
                        'key' => 'field_res_factbox_item_text',
                        'label' => 'Punkt',
                        'name' => 'item_text',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'key' => 'field_res_infobox_titel',
                'label' => 'Infobox Titel',
                'name' => 'infobox_titel',
                'type' => 'text',
            ],
            [
                'key' => 'field_res_infobox_text',
                'label' => 'Infobox Text',
                'name' => 'infobox_text',
                'type' => 'textarea',
                'rows' => 4,
            ],
            [
                'key' => 'field_res_embed_code',
                'label' => 'Embed Code',
                'name' => 'embed_code',
                'type' => 'textarea',
                'rows' => 4,
            ],
            [
                'key' => 'field_res_autor_bio',
                'label' => 'Autor-Bio',
                'name' => 'autor_bio',
                'type' => 'textarea',
                'rows' => 4,
            ],
            [
                'key' => 'field_res_autor_foto',
                'label' => 'Autor-Foto',
                'name' => 'autor_foto',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ],
            ],
        ],
        'position' => 'acf_after_title',
        'style' => 'seamless',
        'active' => true,
    ]);

    // Reddit-Felder
    acf_add_local_field_group([
        'key' => 'group_respublica_reddit',
        'title' => 'Res.Publica – Reddit',
        'fields' => [
            [
                'key' => 'field_res_reddit_share',
                'label' => 'Reddit Share aktivieren',
                'name' => 'reddit_share',
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 0,
            ],
            [
                'key' => 'field_res_reddit_post_url',
                'label' => 'Reddit Post URL',
                'name' => 'reddit_post_url',
                'type' => 'text',
            ],
            [
                'key' => 'field_res_reddit_comments',
                'label' => 'Reddit Kommentare einbetten',
                'name' => 'reddit_comments',
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 0,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ],
            ],
        ],
        'position' => 'normal',
        'style' => 'seamless',
        'active' => true,
    ]);
});

// Ensure required static pages exist (about, impressum, datenschutz)
add_action('init', function () : void {
    if (!function_exists('wp_insert_post') || !function_exists('get_page_by_path')) {
        return;
    }

    $pages = [
        'about' => [
            'title' => 'Über uns',
            'content' => '',
        ],
        'impressum' => [
            'title' => 'Impressum',
            'content' => '',
        ],
        'datenschutz' => [
            'title' => 'Datenschutzerklärung',
            'content' => '',
        ],
    ];

    foreach ($pages as $slug => $data) {
        $exists = get_page_by_path($slug, OBJECT, 'page');
        if ($exists) {
            continue;
        }

        wp_insert_post([
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_name' => $slug,
            'post_title' => $data['title'],
            'post_content' => $data['content'],
        ]);
    }
});

register_nav_menus([
  'primary'  => 'Hauptnavigation',
  'external' => 'Externe Links (WorldMonitor etc.)'
]);

function respublica_options_page() {
  add_theme_page(
    'Res.Publica Einstellungen',
    'Res.Publica',
    'manage_options',
    'respublica-settings',
    'respublica_options_render'
  );
}
add_action('admin_menu', 'respublica_options_page');

function respublica_options_render() {
  if (isset($_POST['respublica_save'])) {
    check_admin_referer('respublica_options');
    $fields = [
      'substack_url','worldmonitor_url','electionmonitor_url',
      'reddit_url','breaking_global','show_substack_nav',
      'show_reddit_nav','electionmonitor_badge','logo_url','hero_mode'
    ];
    foreach ($fields as $f) {
      update_option('respublica_' . $f, sanitize_text_field($_POST[$f] ?? ''));
    }
    echo '<div class="notice notice-success"><p>Gespeichert.</p></div>';
  }
  $get = fn($k, $d = '') => get_option('respublica_'.$k, $d);
  ?>
  <div class="wrap">
    <h1 style="font-family:Georgia,serif;">Res<span style="color:#C8102E">.</span>Publica — Einstellungen</h1>
    <form method="post">
      <?php wp_nonce_field('respublica_options'); ?>
      <table class="form-table">
        <tr><th>Substack URL</th><td><input name="substack_url" type="url" class="regular-text" value="<?php echo esc_attr($get('substack_url','https://respublica.substack.com')); ?>"></td></tr>
        <tr><th>WorldMonitor URL</th><td><input name="worldmonitor_url" type="url" class="regular-text" value="<?php echo esc_attr($get('worldmonitor_url','https://www.worldmonitor.app/')); ?>"></td></tr>
        <tr><th>ElectionMonitor URL</th><td><input name="electionmonitor_url" type="url" class="regular-text" value="<?php echo esc_attr($get('electionmonitor_url','/election-monitor/')); ?>"></td></tr>
        <tr><th>Reddit URL</th><td><input name="reddit_url" type="url" class="regular-text" value="<?php echo esc_attr($get('reddit_url','https://www.reddit.com/r/Res_Publica_DE/')); ?>"></td></tr>
        <tr><th>Breaking-Banner global</th><td><select name="breaking_global"><option value="0" <?php selected($get('breaking_global','0'),'0'); ?>>Aus</option><option value="1" <?php selected($get('breaking_global','0'),'1'); ?>>An</option></select></td></tr>
        <tr><th>Substack in Nav zeigen</th><td><select name="show_substack_nav"><option value="1" <?php selected($get('show_substack_nav','1'),'1'); ?>>Ja</option><option value="0" <?php selected($get('show_substack_nav','1'),'0'); ?>>Nein</option></select></td></tr>
        <tr><th>Reddit in Nav zeigen</th><td><select name="show_reddit_nav"><option value="1" <?php selected($get('show_reddit_nav','1'),'1'); ?>>Ja</option><option value="0" <?php selected($get('show_reddit_nav','1'),'0'); ?>>Nein</option></select></td></tr>
        <tr><th>ElectionMonitor "NEU"-Badge</th><td><select name="electionmonitor_badge"><option value="1" <?php selected($get('electionmonitor_badge','1'),'1'); ?>>Ja</option><option value="0" <?php selected($get('electionmonitor_badge','1'),'0'); ?>>Nein</option></select></td></tr>
        <tr><th>Logo URL</th><td><input name="logo_url" type="url" class="regular-text" value="<?php echo esc_attr($get('logo_url','https://staging.respublica.media/wp-content/uploads/2026/03/Logo-e1772801257878.jpg')); ?>"></td></tr>
        <tr><th>Hero-Artikel</th><td><select name="hero_mode"><option value="auto" <?php selected($get('hero_mode','auto'),'auto'); ?>>Automatisch (neuester)</option><option value="featured" <?php selected($get('hero_mode','auto'),'featured'); ?>>Kategorie "featured"</option></select></td></tr>
      </table>
      <p><input type="submit" name="respublica_save" class="button button-primary" value="Einstellungen speichern"></p>
    </form>
  </div>
  <?php
}
/* ── PERFORMANCE ── */

// Lazy Loading für alle Bilder
function respublica_add_lazy_loading($content) {
  return str_replace('<img ', '<img loading="lazy" decoding="async" ', $content);
}
add_filter('the_content', 'respublica_add_lazy_loading');
add_filter('post_thumbnail_html', 'respublica_add_lazy_loading');

// CSS und JS nur laden wenn nötig
function respublica_dequeue_unnecessary() {
  if (!is_admin()) {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
  }
}
add_action('wp_enqueue_scripts', 'respublica_dequeue_unnecessary', 100);

// Preconnect für Google Fonts
function respublica_preconnect_fonts() {
  echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
  echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action('wp_head', 'respublica_preconnect_fonts', 1);

// Emoji-Script entfernen
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// oEmbed entfernen (weniger HTTP-Requests)
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');

// Bild-Größen optimieren
add_image_size('respublica-card', 600, 400, true);
add_image_size('respublica-hero', 1200, 700, true);
add_image_size('respublica-thumb', 150, 100, true);

// WordPress-Version aus Header entfernen (Security)
remove_action('wp_head', 'wp_generator');

function respublica_reddit_icon($size = 20, $color = '#FF4500') {
  $color = (string) $color;
  $circle = $color;
  $fg = '#fff';

  // Special cases for icon usage inside colored buttons.
  if ($color === 'currentColor') {
    $circle = '#FF4500';
    $fg = 'currentColor';
  } elseif (in_array(strtolower($color), ['white', '#fff', '#ffffff'], true)) {
    $circle = '#FF4500';
    $fg = 'white';
  }

  return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <circle cx="10" cy="10" r="10" fill="'.esc_attr($circle).'"/>
    <path fill="'.esc_attr($fg).'" d="M16.67 10a1.46 1.46 0 00-2.47-1 7.12 7.12 0 00-3.85-1.23l.65-3.07 2.13.45a1 1 0 101.07-1 1 1 0 00-.96.68l-2.38-.5a.16.16 0 00-.19.12l-.73 3.44a7.14 7.14 0 00-3.89 1.23 1.46 1.46 0 10-1.61 2.39 2.87 2.87 0 000 .44c0 2.24 2.61 4.06 5.83 4.06s5.83-1.82 5.83-4.06a2.87 2.87 0 000-.44 1.46 1.46 0 00.47-1.01zM7.5 11a1 1 0 111 1 1 1 0 01-1-1zm5.63 2.71a3.58 3.58 0 01-2.13.55 3.58 3.58 0 01-2.13-.55.22.22 0 01.31-.31 3.15 3.15 0 001.82.44 3.15 3.15 0 001.82-.44.22.22 0 01.31.31zm-.13-1.71a1 1 0 111-1 1 1 0 01-1 1z"/>
  </svg>';
}

function rp_t($de, $en) {
  $lang = 'de';
  if (isset($_COOKIE['rp-lang'])) {
    $lang = $_COOKIE['rp-lang'] === 'en' ? 'en' : 'de';
  } elseif (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $lang = strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'], 'de') === 0 ? 'de' : 'en';
  }
  return $lang === 'en' ? $en : $de;
}

// Site Kit Consent Mode komplett deaktivieren
add_filter('googlesitekit_consent_mode_status', '__return_false');
add_action('wp_enqueue_scripts', function() {
    wp_dequeue_script('google_gtagjs-js-consent-mode-data-layer');
    wp_deregister_script('google_gtagjs-js-consent-mode-data-layer');
    wp_dequeue_script('googlesitekit-consent-mode');
    wp_deregister_script('googlesitekit-consent-mode');
}, 999);
// Inline Consent-Mode Snippet per Output Buffer entfernen
add_action('template_redirect', function() {
    ob_start(function($html) {
        $html = preg_replace(
            '/<script[^>]*id=["\']google_gtagjs-js-consent-mode-data-layer["\'][^>]*>.*?<\/script>/s',
            '',
            $html
        );
        return $html;
    });
});

?>
