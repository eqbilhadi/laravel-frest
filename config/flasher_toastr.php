<?php

/*
 * This file is part of the PHPFlasher package.
 * (c) Younes KHOUBZA <younes.khoubza@gmail.com>
 */

return array(
    'scripts' => array(
        'cdn' => array(
            'https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js',
            'https://cdn.jsdelivr.net/npm/@flasher/flasher-toastr@1.3.2/dist/flasher-toastr.min.js',
        ),
        'local' => array(
            '/assets/js/libs/toastr.min.js'
        ),
    ),
    'styles' => array(
        'cdn' => array(
            'https://cdn.jsdelivr.net/npm/@flasher/flasher-toastr@1.3.2/dist/flasher-toastr.min.css',
        ),
        'local' => array(
            '/assets/css/libs/laravel-toastr.css'
        ),
    ),
);
