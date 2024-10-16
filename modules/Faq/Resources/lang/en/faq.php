<?php

use Modules\Faq\Entities\Faq;

return [
    'items' => [
        'name' => 'Faq list',
        'groups' => [
            'publish' => 'Publish',
            'general' => 'General',
        ],
        'form' => [
            'publish_status' => [
                Faq::PUBLISHED => 'Published',
                Faq::UNPUBLISHED => 'Unpublished'
            ],
        ],
    ],
];
