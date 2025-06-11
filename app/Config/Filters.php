<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        'auth'          => \App\Filters\AuthFilter::class,  // Filter untuk autentikasi umum
        'admin'         => \App\Filters\AdminFilter::class, // Filter khusus admin
    ];

    public array $globals = [
        'before' => [
            'csrf' => ['except' => ['api/*']], // Proteksi CSRF untuk semua route kecuali API
            'forcehttps' // Optional: Hanya jika perlu HTTPS
        ],
        'after' => [
            'toolbar', // Debug toolbar hanya untuk environment development
        ],
    ];

    public array $methods = [];

    public array $filters = [
        'auth' => [
            'before' => [
                '/dashboard',
                '/diagnosa*',
                '/sparepart*',
                '/history*'
            ]
        ],
        'admin' => [
            'before' => [
                '/admin*'
            ]
        ]
    ];
}