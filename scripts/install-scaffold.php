<?php

declare(strict_types=1);

// The Composer package supplies the official, version-matched default config
// classes. Copy only missing ones so our application files are never overwritten.
$root   = dirname(__DIR__);
$source = $root . '/vendor/codeigniter4/framework/app/Config';
$target = $root . '/app/Config';

if (! is_dir($source)) {
    fwrite(STDERR, "CodeIgniter framework is missing. Run composer install.\n");
    exit(1);
}

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS)
);

foreach ($iterator as $file) {
    if ($file->getExtension() !== 'php') {
        continue;
    }

    $relative    = substr($file->getPathname(), strlen($source) + 1);
    $destination = $target . '/' . $relative;

    if (is_file($destination)) {
        continue;
    }

    if (! is_dir(dirname($destination)) && ! mkdir(dirname($destination), 0775, true)) {
        throw new RuntimeException('Cannot create ' . dirname($destination));
    }
    if (! copy($file->getPathname(), $destination)) {
        throw new RuntimeException('Cannot copy ' . $relative);
    }
    echo 'Installed default config: ' . $relative . PHP_EOL;
}
