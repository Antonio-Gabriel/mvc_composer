<?php

    define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
    require ROOT . 'vendor/autoload.php';
    
    use MyApp\core\Configuration;
    $api = new Configuration();