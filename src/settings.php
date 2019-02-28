<?php
// Define root path
defined('DS') ?: define('DS', DIRECTORY_SEPARATOR);
defined('ROOT') ?: define('ROOT', dirname(__DIR__) . DS);
// Load .env file
if (file_exists(ROOT . '.env')) {
    $dotenv = new \Dotenv\Dotenv(ROOT);
    $dotenv->load();
}

return [
    'settings' => [
        'displayErrorDetails' => getenv('APP_DEBUG') === 'true' ? true : false,
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // App Settings
        'app' => [
            'name' => getenv('APP_NAME'),
            'url'  => getenv('APP_URL'),
            'env'  => getenv('APP_ENV'),
        ],
        // Renderer settings
        'renderer' => [
            'template_path' => ROOT . 'templates/',
        ],
    ]
];
