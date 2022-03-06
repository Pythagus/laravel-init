<?php

return [
    // The database table name
    // You can change this if the database keys get too long for your driver
    'table_name' => 'user_auth_logs',

    // The events the package listens for to log
    'events' => [
        'login' => \Illuminate\Auth\Events\Login::class,
        'failed' => \Illuminate\Auth\Events\Failed::class,
        'logout' => \Illuminate\Auth\Events\Logout::class,
        'logout-other-devices' => \Illuminate\Auth\Events\OtherDeviceLogout::class,
    ],

    'notifications' => [
        'new-device' => [
            'enabled' => false,
            'location' => false,
        ],
        'failed-login' => [
            'enabled' => false,
            'location' => false,
        ],
    ],

    // When the clean-up command is run, delete old logs greater than `purge` days
    // Don't schedule the clean-up command if you want to keep logs forever.
    'purge' => 365,
];
