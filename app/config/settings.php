<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Database connection settings
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'africanm_data1',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],

        // Database connection settings
        'token' => [
            'secret' => 'afromoths1984'
        ],
    ],
];
?>
