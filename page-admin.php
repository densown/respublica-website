<?php
/**
 * Template Name: Admin Dashboard
 * Description: Standalone admin status dashboard for Res.Publica.
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!is_user_logged_in() || !current_user_can('administrator')) {
    wp_die('Zugriff verweigert. Nur Administratoren erlaubt.', '403 Forbidden', ['response' => 403]);
}

function rp_admin_format_bytes($bytes)
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max(0, (float) $bytes);
    $pow = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
    $pow = (int) min($pow, count($units) - 1);
    $value = $bytes / pow(1024, $pow);
    return number_format($value, 2, ',', '.') . ' ' . $units[$pow];
}

function rp_admin_badge_class($ok)
{
    return $ok ? 'badge-ok' : 'badge-fail';
}

function rp_admin_format_uptime_pm2($seconds)
{
    $sec = max(0, (int) $seconds);
    $d = intdiv($sec, 86400);
    $sec %= 86400;
    $h = intdiv($sec, 3600);
    $sec %= 3600;
    $m = intdiv($sec, 60);
    $parts = [];
    if ($d > 0) {
        $parts[] = $d . ' T';
    }
    if ($h > 0) {
        $parts[] = $h . ' Std';
    }
    if ($m > 0) {
        $parts[] = $m . ' Min';
    }
    if ($parts === []) {
        $parts[] = '0 Min';
    }
    return implode(' ', $parts);
}

function rp_admin_read_env($path)
{
    $vars = [];
    if (!is_readable($path)) {
        return $vars;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return $vars;
    }

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || strpos($line, '=') === false) {
            continue;
        }
        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        $value = trim($value, "\"'");
        $vars[$key] = $value;
    }

    return $vars;
}

function rp_admin_send_smtp_email($host, $port, $username, $password, $from, $to, $subject, $body)
{
    $socket = fsockopen($host, $port, $errno, $errstr, 15);
    if (!$socket) {
        return 'SMTP Verbindungsfehler: ' . $errstr . ' (' . $errno . ')';
    }

    stream_set_timeout($socket, 20);

    $readResponse = static function () use ($socket) {
        $response = '';
        while (!feof($socket)) {
            $line = fgets($socket, 512);
            if ($line === false) {
                break;
            }
            $response .= $line;
            if (preg_match('/^\d{3}\s/', $line)) {
                break;
            }
        }
        return $response;
    };

    $sendCommand = static function ($command, $expectedCodes) use ($socket, $readResponse) {
        fwrite($socket, $command . "\r\n");
        $response = $readResponse();
        $code = (int) substr($response, 0, 3);
        if (!in_array($code, (array) $expectedCodes, true)) {
            return [false, trim($response)];
        }
        return [true, trim($response)];
    };

    $banner = $readResponse();
    if ((int) substr($banner, 0, 3) !== 220) {
        fclose($socket);
        return 'Ungueltiger SMTP Banner: ' . trim($banner);
    }

    [$ok, $msg] = $sendCommand('EHLO respublica.media', [250]);
    if (!$ok) {
        fclose($socket);
        return 'EHLO fehlgeschlagen: ' . $msg;
    }

    [$ok, $msg] = $sendCommand('STARTTLS', [220]);
    if (!$ok) {
        fclose($socket);
        return 'STARTTLS fehlgeschlagen: ' . $msg;
    }

    if (!stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
        fclose($socket);
        return 'TLS Aktivierung fehlgeschlagen.';
    }

    [$ok, $msg] = $sendCommand('EHLO respublica.media', [250]);
    if (!$ok) {
        fclose($socket);
        return 'EHLO nach TLS fehlgeschlagen: ' . $msg;
    }

    [$ok, $msg] = $sendCommand('AUTH LOGIN', [334]);
    if (!$ok) {
        fclose($socket);
        return 'AUTH LOGIN fehlgeschlagen: ' . $msg;
    }

    [$ok, $msg] = $sendCommand(base64_encode($username), [334]);
    if (!$ok) {
        fclose($socket);
        return 'SMTP Username abgelehnt: ' . $msg;
    }

    [$ok, $msg] = $sendCommand(base64_encode($password), [235]);
    if (!$ok) {
        fclose($socket);
        return 'SMTP Passwort abgelehnt: ' . $msg;
    }

    [$ok, $msg] = $sendCommand('MAIL FROM:<' . $from . '>', [250]);
    if (!$ok) {
        fclose($socket);
        return 'MAIL FROM fehlgeschlagen: ' . $msg;
    }

    [$ok, $msg] = $sendCommand('RCPT TO:<' . $to . '>', [250, 251]);
    if (!$ok) {
        fclose($socket);
        return 'RCPT TO fehlgeschlagen: ' . $msg;
    }

    [$ok, $msg] = $sendCommand('DATA', [354]);
    if (!$ok) {
        fclose($socket);
        return 'DATA fehlgeschlagen: ' . $msg;
    }

    $headers = [];
    $headers[] = 'From: Res.Publica Alert <' . $from . '>';
    $headers[] = 'To: <' . $to . '>';
    $headers[] = 'Subject: =?UTF-8?B?' . base64_encode($subject) . '?=';
    $headers[] = 'Date: ' . date('r');
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: text/plain; charset=UTF-8';
    $headers[] = 'Content-Transfer-Encoding: 8bit';

    $data = implode("\r\n", $headers) . "\r\n\r\n" . str_replace("\n.", "\n..", $body) . "\r\n.";
    fwrite($socket, $data . "\r\n");
    $response = $readResponse();
    if ((int) substr($response, 0, 3) !== 250) {
        fclose($socket);
        return 'E-Mail Versand fehlgeschlagen: ' . trim($response);
    }

    $sendCommand('QUIT', [221, 250]);
    fclose($socket);

    return true;
}

$dashboardData = [
    'api_ok' => false,
    'api_http_code' => 0,
    'api_response_ms' => null,
    'ssl_ok' => false,
    'ssl_expiry' => null,
    'ssl_days_left' => null,
    'disk_percent_used' => null,
    'disk_free' => null,
    'disk_total' => null,
    'pm2_processes' => [],
    'pm2_error' => null,
];

$apiUrl = 'https://api.respublica.media/api/gesetze';
$start = microtime(true);
$apiResponse = wp_remote_get($apiUrl, ['timeout' => 10]);
$dashboardData['api_response_ms'] = (int) round((microtime(true) - $start) * 1000);
if (!is_wp_error($apiResponse)) {
    $dashboardData['api_http_code'] = (int) wp_remote_retrieve_response_code($apiResponse);
    $dashboardData['api_ok'] = $dashboardData['api_http_code'] >= 200 && $dashboardData['api_http_code'] < 300;
}

$sslContext = stream_context_create([
    'ssl' => [
        'capture_peer_cert' => true,
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
]);
$sslClient = @stream_socket_client('ssl://respublica.media:443', $sslErrNo, $sslErrStr, 8, STREAM_CLIENT_CONNECT, $sslContext);
if ($sslClient) {
    $params = stream_context_get_params($sslClient);
    if (!empty($params['options']['ssl']['peer_certificate'])) {
        $certData = openssl_x509_parse($params['options']['ssl']['peer_certificate']);
        if (!empty($certData['validTo_time_t'])) {
            $dashboardData['ssl_ok'] = true;
            $dashboardData['ssl_expiry'] = (int) $certData['validTo_time_t'];
            $dashboardData['ssl_days_left'] = (int) floor(($dashboardData['ssl_expiry'] - time()) / 86400);
        }
    }
    fclose($sslClient);
}

$diskTotal = @disk_total_space('/');
$diskFree = @disk_free_space('/');
if ($diskTotal && $diskFree !== false) {
    $used = $diskTotal - $diskFree;
    $dashboardData['disk_total'] = $diskTotal;
    $dashboardData['disk_free'] = $diskFree;
    $dashboardData['disk_percent_used'] = $diskTotal > 0 ? ($used / $diskTotal) * 100 : 0;
}

$pm2StatusPath = '/root/apps/gesetze/data/pm2-status.json';
if (!is_readable($pm2StatusPath)) {
    $dashboardData['pm2_error'] = 'pm2-status.json ist nicht lesbar oder existiert nicht.';
} else {
    $pm2Raw = file_get_contents($pm2StatusPath);
    if ($pm2Raw === false || $pm2Raw === '') {
        $dashboardData['pm2_error'] = 'pm2-status.json konnte nicht gelesen werden.';
    } else {
        $pm2List = json_decode($pm2Raw, true);
        if ($pm2List === null && json_last_error() !== JSON_ERROR_NONE) {
            $dashboardData['pm2_error'] = 'pm2-status.json: ungueltiges JSON (' . json_last_error_msg() . ').';
        } elseif (!is_array($pm2List)) {
            $dashboardData['pm2_error'] = 'pm2-status.json: erwartet ein JSON-Array.';
        } else {
            $nowMs = (int) round(microtime(true) * 1000);
            foreach ($pm2List as $proc) {
                if (!is_array($proc)) {
                    continue;
                }
                $env = isset($proc['pm2_env']) && is_array($proc['pm2_env']) ? $proc['pm2_env'] : [];
                $name = (string) ($proc['name'] ?? $env['name'] ?? 'unbekannt');
                $statusRaw = (string) ($env['status'] ?? 'unknown');
                $statusLower = strtolower($statusRaw);
                if ($statusLower === 'online') {
                    $statusDisplay = 'online';
                } elseif ($statusLower === 'stopped' || $statusLower === 'stopping') {
                    $statusDisplay = 'stopped';
                } else {
                    $statusDisplay = $statusLower !== '' ? $statusLower : 'unknown';
                }
                $pid = isset($proc['pid']) ? (int) $proc['pid'] : 0;
                $pmUptime = isset($env['pm_uptime']) ? (int) $env['pm_uptime'] : 0;
                $uptimeSec = $pmUptime > 0 ? (int) max(0, floor(($nowMs - $pmUptime) / 1000)) : 0;
                $memBytes = 0;
                if (isset($proc['monit']) && is_array($proc['monit']) && isset($proc['monit']['memory'])) {
                    $memBytes = (int) $proc['monit']['memory'];
                }
                $memoryMb = $memBytes > 0 ? round($memBytes / 1048576, 2) : 0.0;
                $dashboardData['pm2_processes'][] = [
                    'name' => $name,
                    'status' => $statusDisplay,
                    'status_ok' => $statusDisplay === 'online',
                    'pid' => $pid,
                    'uptime_seconds' => $uptimeSec,
                    'uptime_human' => rp_admin_format_uptime_pm2($uptimeSec),
                    'memory_mb' => $memoryMb,
                ];
            }
        }
    }
}

$dbStats = [
    'aenderungen_gesamt' => null,
    'aenderungen_heute' => null,
    'urteile_gesamt' => null,
    'urteile_heute' => null,
    'ohne_ki_sum' => null,
    'mit_poll' => null,
    'ohne_poll' => null,
    'urteil_gesetze_links' => null,
    'letzte_aenderungen' => [],
    'letzte_urteile' => [],
    'letzte_aenderungen_error' => null,
    'letzte_urteile_error' => null,
    'db_error' => null,
];

$mysqli = @new mysqli('127.0.0.1', 'respublica', 'hallopizza123', 'respublica_gesetze', 3306);
if ($mysqli->connect_errno) {
    $dbStats['db_error'] = 'MySQL Verbindung fehlgeschlagen (' . $mysqli->connect_errno . '): ' . $mysqli->connect_error;
} else {
    $mysqli->set_charset('utf8mb4');

    $countQueryMap = [
        'aenderungen_gesamt' => "SELECT COUNT(*) AS c FROM aenderungen",
        'aenderungen_heute' => "SELECT COUNT(*) AS c FROM aenderungen WHERE DATE(COALESCE(updated_at, created_at, datum)) = CURDATE()",
        'urteile_gesamt' => "SELECT COUNT(*) AS c FROM urteile",
        'urteile_heute' => "SELECT COUNT(*) AS c FROM urteile WHERE DATE(COALESCE(updated_at, created_at, datum)) = CURDATE()",
        'ohne_ki_aenderungen' => "SELECT COUNT(*) AS c FROM aenderungen WHERE ki_zusammenfassung IS NULL OR TRIM(ki_zusammenfassung) = ''",
        'ohne_ki_urteile' => "SELECT COUNT(*) AS c FROM urteile WHERE ki_zusammenfassung IS NULL OR TRIM(ki_zusammenfassung) = ''",
        'mit_poll' => "SELECT COUNT(*) AS c FROM aenderungen WHERE poll_id IS NOT NULL AND poll_id != ''",
        'ohne_poll' => "SELECT COUNT(*) AS c FROM aenderungen WHERE poll_id IS NULL OR poll_id = ''",
        'urteil_gesetze_links' => "SELECT COUNT(*) AS c FROM urteil_gesetze",
    ];

    $tmpWithoutKi = 0;
    foreach ($countQueryMap as $key => $sql) {
        $res = $mysqli->query($sql);
        if ($res instanceof mysqli_result) {
            $row = $res->fetch_assoc();
            $value = isset($row['c']) ? (int) $row['c'] : 0;
            if ($key === 'ohne_ki_aenderungen' || $key === 'ohne_ki_urteile') {
                $tmpWithoutKi += $value;
            } elseif (array_key_exists($key, $dbStats)) {
                $dbStats[$key] = $value;
            }
            $res->free();
        }
    }
    $dbStats['ohne_ki_sum'] = $tmpWithoutKi;

    $recentGesetze = $mysqli->query(
        'SELECT a.id, g.kuerzel, a.datum, a.zusammenfassung, a.poll_id
         FROM aenderungen a
         JOIN gesetze g ON g.id = a.gesetz_id
         ORDER BY a.id DESC
         LIMIT 5'
    );
    if (!$recentGesetze) {
        $dbStats['letzte_aenderungen_error'] = $mysqli->error;
        $dbStats['letzte_aenderungen'] = [];
    } else {
        $dbStats['letzte_aenderungen'] = $recentGesetze->fetch_all(MYSQLI_ASSOC);
        $recentGesetze->free();
    }

    $recentUrteile = $mysqli->query(
        'SELECT id, gericht, aktenzeichen, datum, zusammenfassung, rechtsgebiet
         FROM urteile
         ORDER BY id DESC
         LIMIT 5'
    );
    if (!$recentUrteile) {
        $dbStats['letzte_urteile_error'] = $mysqli->error;
        $dbStats['letzte_urteile'] = [];
    } else {
        $dbStats['letzte_urteile'] = $recentUrteile->fetch_all(MYSQLI_ASSOC);
        $recentUrteile->free();
    }

    $mysqli->close();
}

$cronLogPath = '/root/apps/gesetze/logs/cron.log';
$cronLines = [];
if (is_readable($cronLogPath)) {
    $allLines = @file($cronLogPath, FILE_IGNORE_NEW_LINES);
    if (is_array($allLines)) {
        $cronLines = array_slice($allLines, -30);
    }
}

$koalitionPath = '/root/apps/gesetze/data/koalitionsvertrag.json';
$koalitionData = [];
if (is_readable($koalitionPath)) {
    $raw = file_get_contents($koalitionPath);
    if ($raw !== false) {
        $parsed = json_decode($raw, true);
        if (is_array($parsed)) {
            $koalitionData = $parsed;
        }
    }
}

$emailResult = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_admin_referer('rp_admin_dashboard_action', 'rp_admin_nonce');
    $action = isset($_POST['rp_action']) ? sanitize_text_field(wp_unslash($_POST['rp_action'])) : '';

    if ($action === 'update_koalition') {
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $newStatus = isset($_POST['status']) ? sanitize_text_field(wp_unslash($_POST['status'])) : '';
        $allowed = ['ausstehend', 'in_arbeit', 'umgesetzt', 'gescheitert'];

        if ($id > 0 && in_array($newStatus, $allowed, true)) {
            $updated = false;
            foreach ($koalitionData as &$entry) {
                if (isset($entry['id']) && (int) $entry['id'] === $id) {
                    $entry['status'] = $newStatus;
                    $updated = true;
                    break;
                }
            }
            unset($entry);

            if ($updated) {
                @file_put_contents($koalitionPath, json_encode($koalitionData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }
        }

        wp_safe_redirect(add_query_arg('k_saved', '1', get_permalink()));
        exit;
    }

    if ($action === 'test_alert') {
        $env = rp_admin_read_env('/root/apps/gesetze/.env');
        $smtpUser = $env['SMTP_USER'] ?? '';
        $smtpPass = $env['SMTP_PASS'] ?? '';
        $alertEmail = $env['ALERT_EMAIL'] ?? 'res.publica.magazin@gmail.com';
        $to = 'res.publica.magazin@gmail.com';

        if ($smtpUser === '' || $smtpPass === '') {
            $emailResult = ['ok' => false, 'message' => 'SMTP_USER oder SMTP_PASS fehlt in .env'];
        } else {
            $subject = 'Res.Publica Admin Dashboard Test-Alert';
            $body = "Dies ist ein Test-Alert vom Admin Dashboard.\n\nZeit: " . date('Y-m-d H:i:s') . "\nHost: " . ($_SERVER['HTTP_HOST'] ?? 'unbekannt');
            $send = rp_admin_send_smtp_email('smtp.gmail.com', 587, $smtpUser, $smtpPass, $alertEmail, $to, $subject, $body);
            if ($send === true) {
                $emailResult = ['ok' => true, 'message' => 'Test-Alert erfolgreich gesendet.'];
            } else {
                $emailResult = ['ok' => false, 'message' => (string) $send];
            }
        }
    }
}

$kSaved = isset($_GET['k_saved']) && $_GET['k_saved'] === '1';
$totalPromises = count($koalitionData);
$implementedPromises = 0;
foreach ($koalitionData as $entry) {
    if (($entry['status'] ?? '') === 'umgesetzt') {
        $implementedPromises++;
    }
}
$progressPercent = $totalPromises > 0 ? ($implementedPromises / $totalPromises) * 100 : 0;

$statusMeta = [
    'ausstehend' => ['label' => 'Ausstehend', 'class' => 'status-ausstehend'],
    'in_arbeit' => ['label' => 'In Arbeit', 'class' => 'status-in-arbeit'],
    'umgesetzt' => ['label' => 'Umgesetzt', 'class' => 'status-umgesetzt'],
    'gescheitert' => ['label' => 'Gescheitert', 'class' => 'status-gescheitert'],
];
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Res.Publica Admin Dashboard</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;700&display=swap');
        :root {
            --bg: #0f1115;
            --panel: #171a21;
            --panel-2: #1d212b;
            --text: #e5e7eb;
            --muted: #9aa3b2;
            --accent: #c0392b;
            --ok: #27ae60;
            --fail: #e74c3c;
            --warn: #f39c12;
            --border: #2b3240;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: "IBM Plex Mono", monospace;
            line-height: 1.45;
            padding: 24px;
        }
        .container {
            max-width: 1280px;
            margin: 0 auto;
        }
        h1, h2, h3 { margin-top: 0; }
        h1 {
            font-size: 26px;
            border-left: 4px solid var(--accent);
            padding-left: 10px;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 18px;
            margin-bottom: 14px;
            color: #fff;
        }
        section {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 18px;
        }
        .grid {
            display: grid;
            gap: 12px;
        }
        .grid-2 { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
        .grid-4 { grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); }
        .card {
            background: var(--panel-2);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 12px;
        }
        .label {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 8px;
        }
        .value {
            font-size: 24px;
            font-weight: 700;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid transparent;
        }
        .badge-ok {
            background: rgba(39, 174, 96, 0.15);
            color: #9cf5bf;
            border-color: rgba(39, 174, 96, 0.35);
        }
        .badge-fail {
            background: rgba(231, 76, 60, 0.15);
            color: #ffb2aa;
            border-color: rgba(231, 76, 60, 0.35);
        }
        .badge-info {
            background: rgba(192, 57, 43, 0.15);
            color: #ffb9b2;
            border-color: rgba(192, 57, 43, 0.35);
        }
        .progress-wrap {
            height: 12px;
            background: #12151b;
            border: 1px solid var(--border);
            border-radius: 999px;
            overflow: hidden;
        }
        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--accent), #e74c3c);
            width: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        th, td {
            text-align: left;
            border-bottom: 1px solid var(--border);
            padding: 8px 6px;
            vertical-align: top;
        }
        th {
            color: var(--muted);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .scroll-log {
            max-height: 300px;
            overflow: auto;
            background: #050608;
            border: 1px solid #1f2430;
            border-radius: 8px;
            padding: 10px;
            font-size: 12px;
            color: #d5d8dd;
            white-space: pre-wrap;
            word-break: break-word;
        }
        .log-error { color: #ff6f61; font-weight: 700; }
        .log-done { color: #53d68a; font-weight: 700; }
        .muted { color: var(--muted); }
        .btn, button {
            background: var(--accent);
            color: #fff;
            border: 1px solid #cc4f44;
            border-radius: 6px;
            padding: 8px 12px;
            cursor: pointer;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
        }
        select {
            background: #11141b;
            color: #fff;
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 7px 8px;
            font-family: inherit;
            font-size: 12px;
        }
        .status-ausstehend { background: rgba(154, 163, 178, 0.2); color: #cfd7e4; border-color: rgba(154, 163, 178, 0.35); }
        .status-in-arbeit { background: rgba(243, 156, 18, 0.2); color: #ffd38a; border-color: rgba(243, 156, 18, 0.35); }
        .status-umgesetzt { background: rgba(39, 174, 96, 0.2); color: #9cf5bf; border-color: rgba(39, 174, 96, 0.35); }
        .status-gescheitert { background: rgba(231, 76, 60, 0.2); color: #ffb2aa; border-color: rgba(231, 76, 60, 0.35); }
        .row-actions {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }
        .card-pm2 {
            min-width: 280px;
        }
        .pm2-proc-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 4px;
        }
        .pm2-proc {
            background: #141820;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 14px 18px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .pm2-proc-row {
            display: flex;
            flex-wrap: nowrap;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
            min-width: min-content;
            font-size: 13px;
        }
        .pm2-proc-name {
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }
        .pm2-sep {
            color: var(--muted);
            flex-shrink: 0;
            user-select: none;
        }
        .pm2-pid {
            font-size: 11px;
            color: var(--muted);
            flex-shrink: 0;
        }
        .pm2-metric {
            flex-shrink: 0;
            color: var(--text);
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Res.Publica Admin Dashboard</h1>

    <section>
        <h2>System Status</h2>
        <div class="grid grid-2">
            <div class="card">
                <div class="label">API Health</div>
                <div>
                    <span class="badge <?php echo esc_attr(rp_admin_badge_class($dashboardData['api_ok'])); ?>">
                        <?php echo $dashboardData['api_ok'] ? 'OK' : 'FAIL'; ?>
                    </span>
                    <span class="muted">HTTP <?php echo (int) $dashboardData['api_http_code']; ?></span>
                </div>
                <div class="muted" style="margin-top:6px;">Response Time: <?php echo (int) $dashboardData['api_response_ms']; ?> ms</div>
            </div>
            <div class="card">
                <div class="label">SSL-Zertifikat respublica.media</div>
                <?php if ($dashboardData['ssl_ok'] && $dashboardData['ssl_expiry'] !== null): ?>
                    <div><?php echo esc_html(date_i18n('d.m.Y H:i', $dashboardData['ssl_expiry'])); ?></div>
                    <div class="muted"><?php echo (int) $dashboardData['ssl_days_left']; ?> Tage bis Ablauf</div>
                <?php else: ?>
                    <span class="badge badge-fail">Nicht lesbar</span>
                <?php endif; ?>
            </div>
            <div class="card">
                <div class="label">Disk Usage (/)</div>
                <?php if ($dashboardData['disk_percent_used'] !== null): ?>
                    <div class="muted"><?php echo rp_admin_format_bytes($dashboardData['disk_free']); ?> frei / <?php echo rp_admin_format_bytes($dashboardData['disk_total']); ?> gesamt</div>
                    <div class="progress-wrap" style="margin-top:8px;">
                        <div class="progress-bar" style="width: <?php echo esc_attr((string) min(100, max(0, (float) $dashboardData['disk_percent_used']))); ?>%;"></div>
                    </div>
                    <div class="muted" style="margin-top:6px;"><?php echo number_format((float) $dashboardData['disk_percent_used'], 2, ',', '.'); ?>% belegt</div>
                <?php else: ?>
                    <span class="badge badge-fail">Nicht verfuegbar</span>
                <?php endif; ?>
            </div>
            <div class="card card-pm2">
                <div class="label">PM2 Status</div>
                <?php if ($dashboardData['pm2_error']): ?>
                    <p class="muted" style="margin:0;"><span class="badge badge-fail">PM2</span> <?php echo esc_html((string) $dashboardData['pm2_error']); ?></p>
                <?php elseif (!empty($dashboardData['pm2_processes'])): ?>
                    <div class="pm2-proc-list">
                        <?php foreach ($dashboardData['pm2_processes'] as $proc): ?>
                            <div class="pm2-proc">
                                <div class="pm2-proc-row">
                                    <span class="pm2-proc-name"><?php echo esc_html((string) $proc['name']); ?></span>
                                    <span class="pm2-sep" aria-hidden="true">·</span>
                                    <span class="badge <?php echo esc_attr(rp_admin_badge_class(!empty($proc['status_ok']))); ?>">
                                        <?php echo esc_html((string) ($proc['status'] ?? 'unknown')); ?>
                                    </span>
                                    <span class="pm2-sep" aria-hidden="true">·</span>
                                    <span class="pm2-pid">PID <?php echo (int) ($proc['pid'] ?? 0); ?></span>
                                    <span class="pm2-sep" aria-hidden="true">·</span>
                                    <span class="pm2-metric"><?php echo esc_html((string) ($proc['uptime_human'] ?? '')); ?></span>
                                    <span class="pm2-sep" aria-hidden="true">·</span>
                                    <span class="pm2-metric"><?php echo esc_html(number_format((float) ($proc['memory_mb'] ?? 0), 2, ',', '.')); ?> MB</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <span class="muted">Keine Eintraege in pm2-status.json.</span>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section>
        <h2>Daten Übersicht</h2>
        <?php if ($dbStats['db_error']): ?>
            <p><span class="badge badge-fail">DB Fehler</span> <?php echo esc_html((string) $dbStats['db_error']); ?></p>
        <?php endif; ?>
        <div class="grid grid-4">
            <div class="card"><div class="label">Gesetzesänderungen gesamt</div><div class="value"><?php echo (int) $dbStats['aenderungen_gesamt']; ?></div></div>
            <div class="card"><div class="label">Gesetzesänderungen heute</div><div class="value"><?php echo (int) $dbStats['aenderungen_heute']; ?></div></div>
            <div class="card"><div class="label">Urteile gesamt</div><div class="value"><?php echo (int) $dbStats['urteile_gesamt']; ?></div></div>
            <div class="card"><div class="label">Urteile heute</div><div class="value"><?php echo (int) $dbStats['urteile_heute']; ?></div></div>
            <div class="card"><div class="label">Ohne KI-Zusammenfassung</div><div class="value"><?php echo (int) $dbStats['ohne_ki_sum']; ?></div></div>
            <div class="card"><div class="label">Mit Abstimmungsverknüpfung</div><div class="value"><?php echo (int) $dbStats['mit_poll']; ?></div></div>
            <div class="card"><div class="label">Ohne Abstimmungsverknüpfung</div><div class="value"><?php echo (int) $dbStats['ohne_poll']; ?></div></div>
            <div class="card"><div class="label">Gesetz-Urteil-Verknüpfungen</div><div class="value"><?php echo (int) $dbStats['urteil_gesetze_links']; ?></div></div>
        </div>

        <h3 style="margin-top:18px;">Letzte 5 Gesetzesänderungen</h3>
        <?php if ($dbStats['letzte_aenderungen_error']): ?>
            <p><span class="badge badge-fail">Query</span> <?php echo esc_html((string) $dbStats['letzte_aenderungen_error']); ?></p>
        <?php endif; ?>
        <table>
            <thead>
            <tr><th>Kürzel</th><th>Datum</th><th>Zusammenfassung</th><th>Poll-ID</th></tr>
            </thead>
            <tbody>
            <?php if (!empty($dbStats['letzte_aenderungen'])): ?>
                <?php foreach ($dbStats['letzte_aenderungen'] as $row): ?>
                    <tr>
                        <td><?php echo esc_html((string) ($row['kuerzel'] ?? '')); ?></td>
                        <td><?php echo esc_html((string) ($row['datum'] ?? '')); ?></td>
                        <td><?php echo esc_html(mb_strimwidth((string) ($row['zusammenfassung'] ?? ''), 0, 110, '...')); ?></td>
                        <td><?php echo !empty($row['poll_id']) ? 'Ja' : 'Nein'; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php elseif (!$dbStats['letzte_aenderungen_error']): ?>
                <tr><td colspan="4" class="muted">Keine Daten.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>

        <h3 style="margin-top:18px;">Letzte 5 Urteile</h3>
        <?php if ($dbStats['letzte_urteile_error']): ?>
            <p><span class="badge badge-fail">Query</span> <?php echo esc_html((string) $dbStats['letzte_urteile_error']); ?></p>
        <?php endif; ?>
        <table>
            <thead>
            <tr><th>Gericht</th><th>AZ</th><th>Datum</th><th>Rechtsgebiet</th><th>Zusammenfassung</th></tr>
            </thead>
            <tbody>
            <?php if (!empty($dbStats['letzte_urteile'])): ?>
                <?php foreach ($dbStats['letzte_urteile'] as $row): ?>
                    <tr>
                        <td><?php echo esc_html((string) ($row['gericht'] ?? '')); ?></td>
                        <td><?php echo esc_html((string) ($row['aktenzeichen'] ?? '')); ?></td>
                        <td><?php echo esc_html((string) ($row['datum'] ?? '')); ?></td>
                        <td><?php echo esc_html((string) ($row['rechtsgebiet'] ?? '')); ?></td>
                        <td><?php echo (!empty($row['zusammenfassung']) && trim((string) $row['zusammenfassung']) !== '') ? 'Ja' : 'Nein'; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php elseif (!$dbStats['letzte_urteile_error']): ?>
                <tr><td colspan="5" class="muted">Keine Daten.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2>Cronjob Log (letzte 30 Zeilen)</h2>
        <pre class="scroll-log"><?php
            if (empty($cronLines)) {
                echo esc_html('Logdatei nicht gefunden oder leer.');
            } else {
                foreach ($cronLines as $line) {
                    $escaped = esc_html($line);
                    $escaped = preg_replace('/(Fehler|Error)/i', '<span class="log-error">$1</span>', $escaped);
                    $escaped = preg_replace('/(Fertig)/i', '<span class="log-done">$1</span>', (string) $escaped);
                    echo wp_kses($escaped, ['span' => ['class' => []]]) . "\n";
                }
            }
            ?></pre>
    </section>

    <section>
        <h2>Email Alert Test</h2>
        <?php if ($emailResult): ?>
            <p><span class="badge <?php echo esc_attr(rp_admin_badge_class((bool) $emailResult['ok'])); ?>">
                <?php echo $emailResult['ok'] ? 'Erfolg' : 'Fehler'; ?>
            </span> <?php echo esc_html((string) $emailResult['message']); ?></p>
        <?php endif; ?>
        <form method="post">
            <?php wp_nonce_field('rp_admin_dashboard_action', 'rp_admin_nonce'); ?>
            <input type="hidden" name="rp_action" value="test_alert">
            <button type="submit">Test-Alert senden</button>
        </form>
    </section>

    <section>
        <h2>Koalitionsvertrag Tracker</h2>
        <?php if ($kSaved): ?>
            <p><span class="badge badge-ok">Gespeichert</span></p>
        <?php endif; ?>
        <p><?php echo (int) $implementedPromises; ?> von <?php echo (int) $totalPromises; ?> umgesetzt</p>
        <div class="progress-wrap" style="margin-bottom:14px;">
            <div class="progress-bar" style="width: <?php echo esc_attr((string) min(100, max(0, $progressPercent))); ?>%;"></div>
        </div>
        <table>
            <thead>
            <tr><th>ID</th><th>Versprechen</th><th>Status</th><th>Gesetz</th><th>Notiz</th><th>Aktion</th></tr>
            </thead>
            <tbody>
            <?php if (!empty($koalitionData)): ?>
                <?php foreach ($koalitionData as $entry): ?>
                    <?php
                    $entryStatus = $entry['status'] ?? 'ausstehend';
                    $meta = $statusMeta[$entryStatus] ?? $statusMeta['ausstehend'];
                    ?>
                    <tr>
                        <td><?php echo (int) ($entry['id'] ?? 0); ?></td>
                        <td><?php echo esc_html((string) ($entry['versprechen'] ?? '')); ?></td>
                        <td><span class="badge <?php echo esc_attr($meta['class']); ?>"><?php echo esc_html($meta['label']); ?></span></td>
                        <td><?php echo esc_html((string) (($entry['gesetz_kuerzel'] ?? null) ?: '-')); ?></td>
                        <td><?php echo esc_html((string) (($entry['notiz'] ?? '') ?: '-')); ?></td>
                        <td>
                            <form method="post" class="row-actions">
                                <?php wp_nonce_field('rp_admin_dashboard_action', 'rp_admin_nonce'); ?>
                                <input type="hidden" name="rp_action" value="update_koalition">
                                <input type="hidden" name="id" value="<?php echo (int) ($entry['id'] ?? 0); ?>">
                                <select name="status">
                                    <?php foreach ($statusMeta as $statusKey => $statusValue): ?>
                                        <option value="<?php echo esc_attr($statusKey); ?>" <?php selected($entryStatus, $statusKey); ?>>
                                            <?php echo esc_html($statusValue['label']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit">Speichern</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" class="muted">Keine Eintraege in koalitionsvertrag.json.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </section>
</div>
</body>
</html>
