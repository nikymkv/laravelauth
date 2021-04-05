<?php

return [
    'admin' => [
        'App\\Models\\Post' => [
            'view',
            'view-any',
            'create',
            'update',
            'delete',
            'import',
            'export',
        ],
        'App\\Models\\Admin' => [
            'view',
            'view-any',
            'create',
            'update',
            'delete',
        ],
    ],
    'manager' => [

    ],
    'support' => [

    ],
];