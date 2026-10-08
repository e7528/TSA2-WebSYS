<?php

use CodeIgniter\Boot;
use Config\Paths;

$minPhpVersion = '8.2';
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    exit('PHP 8.2 or later is required.');
}

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
chdir(FCPATH);

require FCPATH . '../app/Config/Paths.php';
$paths = new Paths();
require $paths->systemDirectory . '/Boot.php';

exit(Boot::bootWeb($paths));
