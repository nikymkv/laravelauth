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
    ],
    'user' => [
        'App\\Models\\Post' => [
            // 'view',
            'view-any',
        ],
    ],
];