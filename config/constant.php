<?php

return [
    'type_image' => ['image/png', 'image/jpeg', 'image/jpg', 'jpeg', 'jpg', 'png', 'gif'],
    'language_image_default' => 'assets/img/languages/vn.png',
    'max_size_image' => 10485760,
    'roles' => [
        0 => 'Admin',
        1 => 'SubAdmin',
    ],
    'user_status' => [
        0 => 'Unactive',
        1 => 'Active',
    ],
    'language_default_code' => 'en',
    'publish' => [
        'text' => [
            0 => 'Unpublish',
            1 => 'Publish'
        ],
        'key' => [
            'unpublish' => 0,
            'publish' => 1,
        ],
    ],
    'post_type' => [
        'page' => 0,
        'post' => 1,
    ]
];
