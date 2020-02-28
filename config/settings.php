<?php

return [

    'cloudinary_logo' => [
        'format'  => 'png',
        'width'   => 105,
        'height'  => 80,
        'crop'    => 'scale',
        'quality' => 'auto',
        'effect'  => 'grayscale',
        'effect'  => 'bgremoval',
        'opacity' => '80',
//        'aspect_ratio' => '1.09'
    ],

    'cloudinary_optimised_jpg' => [
        'format' => 'jpg',
        'width'  => 1920,
        'height' => 1080,
        'quality' => 'auto',
        'dpr' => 'auto',
        'effect' => 'sharpen',
        'responsive' => true,
//        'x' => -200,
        // 'y' => -500
        // 'width' => 'auto',
        // 'height' => 'auto',
        // 'crop' => 'scale',
        // 'aspect_ratio' => '1.09'
    ],

    'cloudinary_png' => [
        'format' => 'png',
        'quality' => 'auto',
        'dpr' => 'auto',
        'width' => 'auto',
    ],

    'cloudinary_jpg' => [
        'format' => 'jpg',
        'quality' => 'auto',
        'dpr' => 'auto',
        'width' => 'auto',
    ],

];
