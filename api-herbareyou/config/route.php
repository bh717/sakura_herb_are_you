<?php

return [
    'base_only' => [
        'store', 'index', 'show', 'update', 'destroy'
    ],
    'admin_adminers_resource' => [
        'store' => 'admin.adminers.store',
        'index' => 'admin.adminers.index',
        'show' => 'admin.adminers.show',
        'update' => 'admin.adminers.update',
        'destroy'=> 'admin.adminers.destroy',
    ],
    'admin_user_resource' => [
        'store' => 'admin.users.store',
        'index' => 'admin.users.index',
        'show' => 'admin.users.show',
        'update' => 'admin.users.update',
        'destroy'=> 'admin.users.destroy',
    ],
];
