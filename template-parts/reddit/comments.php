<?php
declare(strict_types=1);

if (!function_exists('get_field')) {
    return;
}

$post_url = (string) (get_field('reddit_post_url') ?? '');
$enabled = get_field('reddit_comments');

if (trim($post_url) === '' || empty($enabled)) {
    return;
}
?>

<section class="rp-reddit-comments" aria-label="Reddit Kommentare">
  <h2 style="font-family:'IBM Plex Mono', ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', monospace; font-size:12px; text-transform:uppercase; letter-spacing:0.14em; color:var(--mid); margin: 10px 0 14px;">
    Diskussion auf Reddit
  </h2>
  <blockquote class="reddit-embed-bq" data-embed-url="<?php echo esc_url($post_url); ?>" style="margin:0;"></blockquote>
  <script async src="https://www.redditstatic.com/comment-embed.js" data-embed-url="<?php echo esc_url($post_url); ?>"></script>
</section>

