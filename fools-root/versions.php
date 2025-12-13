<?php
$versions = [];
$dirs = glob('*', GLOB_ONLYDIR);

foreach ($dirs as $dir) {
    $metaFile = $dir . '/metadata.json';
    if (file_exists($metaFile)) {
        $meta = json_decode(file_get_contents($metaFile), true);
        $versions[] = $meta;
    }
}

usort($versions, fn($a, $b) => version_compare($b['tag'], $a['tag']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Versions</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: system-ui, -apple-system, sans-serif;
            max-width: 600px;
            margin: 2rem auto;
            padding: 0 1rem;
            background: #f5f5f5;
            color: #333;
        }
        h1 { margin-bottom: 1.5rem; }
        .version {
            background: #fff;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            margin-bottom: 0.75rem;
            text-decoration: none;
            color: inherit;
            display: block;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: box-shadow 0.15s;
        }
        .version:hover {
            box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        }
        .tag {
            font-weight: 600;
            font-size: 1.1rem;
        }
        .message {
            color: #666;
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }
        .time {
            color: #999;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }
        .empty {
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h1>Versions</h1>
    <?php if (empty($versions)): ?>
        <p class="empty">No versions found.</p>
    <?php else: ?>
        <?php foreach ($versions as $v): ?>
            <a href="<?= htmlspecialchars($v['tag']) ?>/" class="version">
                <div class="tag"><?= htmlspecialchars($v['tag']) ?></div>
                <?php if (!empty($v['message'])): ?>
                    <div class="message"><?= htmlspecialchars($v['message']) ?></div>
                <?php endif; ?>
                <div class="time"><?= date('j M Y, H:i', strtotime($v['time'])) ?></div>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>

