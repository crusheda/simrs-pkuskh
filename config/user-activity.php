<?php
return [
    'middleware'       => ['web', 'auth'],
    'route_path'       => 'ashidu328yrbew9bfay8dsbfy32byrfey9fb8aywbyb3ybfesugn9fsiuagd/user-activity',
    'admin_panel_path' => 'ashidu328yrbew9bfay8dsbfy32byrfey9fb8aywbyb3ybfesugn9fsiuagd/user-activity',
    'delete_limit'     => 30,

    'model' => [
        'user' => "App\User"
    ],

    'log_events' => [
        'on_create'     => true,
        'on_edit'       => true,
        'on_delete'     => true,
        'on_login'      => true,
        'on_lockout'    => true
    ]
];