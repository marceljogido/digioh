<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$elements = config('setting_fields.instagram.elements');
foreach ($elements as $element) {
    if (($element['name'] ?? null) === 'instagram_section_enabled') {
        var_dump($element);
    }
}
