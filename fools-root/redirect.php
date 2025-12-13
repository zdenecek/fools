<?php
$versions = [];
$dirs = glob('*', GLOB_ONLYDIR);

foreach ($dirs as $dir) {
    $metaFile = $dir . '/metadata.json';
    if (file_exists($metaFile)) {
        $meta = json_decode(file_get_contents($metaFile), true);
        if ($meta) {
            $versions[] = $meta;
        }
    }
}

if (empty($versions)) {
    http_response_code(404);
    die('No versions found');
}

usort($versions, fn($a, $b) => version_compare($b['tag'], $a['tag']));
$newest = $versions[0];
header('Location: ' . $newest['tag'] . '/', true, 302);
exit;

