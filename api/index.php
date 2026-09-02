<?php

$_ENV['APP_STORAGE'] = '/tmp/storage';

$storagePaths = [
    '/tmp/storage/logs',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/testing',
    '/tmp/storage/app/public',
];

foreach ($storagePaths as $path) {
    if (!is_dir($path)) {
        mkdir($path, 0775, true);
    }
}

require __DIR__ . '/../public/index.php';
