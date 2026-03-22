<?php
declare(strict_types=1);

if (!function_exists('get_field')) {
    return;
}

$post_url = (string) (get_field('reddit_post_url') ?? '');
if (trim($post_url) === '') {
    return;
}

$oembed_url = 'https://www.reddit.com/oembed?url=' . rawurlencode($post_url);

$title = '';
$embed_html = '';

if (function_exists('wp_remote_get')) {
    $res = wp_remote_get($oembed_url, [
        'timeout' => 5,
        'headers' => [
            'Accept' => 'application/json',
        ],
    ]);

    if (!is_wp_error($res)) {
        $body = (string) wp_remote_retrieve_body($res);
        $data = json_decode($body, true);
        if (is_array($data)) {
            $title = (string) ($data['title'] ?? '');
            $embed_html = (string) ($data['html'] ?? '');
        }
    }
}
?>

<section class="rp-reddit-preview" aria-label="Reddit Vorschau">
  <?php if (trim($embed_html) !== '') : ?>
    <div class="rp-reddit-preview__inner">
      <?php echo $embed_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    </div>
  <?php else : ?>
    <p style="margin:0 0 10px; font-family:'IBM Plex Mono', ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', monospace; font-size:11px; text-transform:uppercase; letter-spacing:0.10em; color:var(--mid);">
      Reddit Diskussion
    </p>
    <p style="margin:0;">
      <a href="<?php echo esc_url($post_url); ?>" target="_blank" rel="noopener noreferrer">
        <?php echo esc_html($title !== '' ? $title : 'Zum Reddit-Post'); ?>
      </a>
    </p>
  <?php endif; ?>
</section>

