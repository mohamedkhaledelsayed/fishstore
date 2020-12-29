<?php

return [
    'role_structure' => [
        'administrator' => [
            'customers' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'admin_users' => 'c,r,u,d',
            'governments' => 'c,r,u,d',
            'cities' => 'c,r,u,d',
            'notifications' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'attributes' => 'c,r,u,d',
            'home'  => 'r',
        ],
        'user' => [
            'home'  => 'r',
            'roles' => 'r,u',
            'admin_users' => 'c,r,u',
            'countries' => 'c,r,u',
            'cities' => 'c,r,u',
            'regions' => 'c,r,u',
            'vendors' => 'c,r,u',

        ],
        'no-role' => [
            'home'  => 'r',
        ]
    ],
    'permission_structure' => [
        'cru_user' => [
            'profile' => 'c,r,u'
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];