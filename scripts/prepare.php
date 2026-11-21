<?php
// Run from any directory. Existing configuration and databases are preserved.
$root = dirname(__DIR__);
chdir($root);
if (PHP_VERSION_ID < 80200) { fwrite(STDERR, "PHP 8.2 or newer is required.\n"); exit(1); }
foreach (['openssl','pdo','mbstring','tokenizer','xml','ctype','fileinfo','dom'] as $extension) {
    if (! extension_loaded($extension)) { fwrite(STDERR, "Enable PHP extension: $extension\n"); exit(1); }
}
if (! is_file('.env') && ! copy('.env.example', '.env')) { exit(1); }
foreach (['bootstrap/cache','storage/framework/cache/data','storage/framework/sessions','storage/framework/views','storage/logs'] as $directory) {
    if (! is_dir($directory) && ! mkdir($directory, 0775, true)) { exit(1); }
}
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
if (config('database.default') === 'sqlite') {
    if (! extension_loaded('pdo_sqlite')) { fwrite(STDERR, "Enable pdo_sqlite in php.ini.\n"); exit(1); }
    $file = config('database.connections.sqlite.database');
    if ($file !== ':memory:' && ! is_file($file) && ! touch($file)) { exit(1); }
}
if (! config('app.key')) {
    $exit = Illuminate\Support\Facades\Artisan::call('key:generate', ['--force' => true]);
    echo Illuminate\Support\Facades\Artisan::output();
    if ($exit !== 0) { exit($exit); }
}
echo "Configuration prepared.\n";
