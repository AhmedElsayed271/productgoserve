<?php

use App\Models\Setting;

return [
    'roles' => [
        'users' => ['read', 'create', 'update', 'delete'],
        'roles' => ['read', 'create', 'update', 'delete'],
        'categories' => ['read', 'create', 'update', 'delete'],
        'products' => ['read', 'create', 'update', 'delete'],
        'sizes' => ['read', 'create', 'update', 'delete'],
    ],
]
?>