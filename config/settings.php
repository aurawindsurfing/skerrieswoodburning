<?php

return [

    'cloudinary_hotel' => [
        'format' => 'jpg',
        'width'  => 500,
        'height' => 500,
        'quality' => 'auto',
        'crop' => 'fill',
        // 'aspect_ratio' => '1.09'
    ],

    'cloudinary_gear' => [
        'format' => 'png',
        'width'  => 350,
        'height' => 620,
        'quality' => 'auto',
        'crop' => 'mpad',
        // 'aspect_ratio' => '1.09'
    ],

    'cloudinary_team' => [
        'format' => 'jpg',
        'width'  => 500,
        'height' => 500,
        'quality' => 'auto',
        'crop' => 'fill',
        // 'aspect_ratio' => '1.09'
    ],

    'cloudinary_optimised_jpg' => [
        'format' => 'jpg',
        'width'  => 1920,
        'height' => 1080,
        'quality' => 'auto',
        'dpr' => 'auto',
        'effect' => 'sharpen',
        'responsive' => true,
        'x' => -200,
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
