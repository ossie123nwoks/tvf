<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Blog Settings
    |--------------------------------------------------------------------------
    |
    | Configuration values specific to your blog functionality.
    |
    */

    'comments' => [
        'auto_approve' => env('BLOG_COMMENTS_AUTO_APPROVE', false),
        'min_length' => env('BLOG_COMMENTS_MIN_LENGTH', 10),
        'max_length' => env('BLOG_COMMENTS_MAX_LENGTH', 1000),
    ],
    
    'posts' => [
        'items_per_page' => env('BLOG_POSTS_PER_PAGE', 10),
        'reading_speed' => env('BLOG_READING_SPEED', 200), // words per minute
    ],
    
    'featured_image' => [
        'width' => env('BLOG_FEATURED_IMAGE_WIDTH', 1200),
        'height' => env('BLOG_FEATURED_IMAGE_HEIGHT', 630),
    ],
];