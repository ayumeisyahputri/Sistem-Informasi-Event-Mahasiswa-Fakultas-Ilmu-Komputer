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
    /**
     * Filter Aliases
     */
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

        // === CUSTOM FILTERS ===
        'authGuard'     => \App\Filters\AuthGuard::class,
        'adminGuard'    => \App\Filters\AdminGuard::class,
    ];

    /**
     * Required global filters
     */
    public array $required = [
        'before' => [
            'forcehttps',
            'pagecache',
        ],
        'after' => [
            'pagecache',
            'performance',
            'toolbar',
        ],
    ];

    /**
     * Global filters
     */
    public array $globals = [
        'before' => [
            // Tidak pakai csrf global agar login tidak error
        ],
        'after' => [
            // 'secureheaders',
        ],
    ];

    /**
     * Per method?
     */
    public array $methods = [];

    /**
     * Filter berbasis URL
     */
    public array $filters = [
        // Semua halaman setelah login wajib login
        'authGuard' => [
            'before' => [
                'dashboard',
                'event',
                'event/*',
                'mahasiswa',
                'mahasiswa/*',
                'pendaftaran',
                'pendaftaran/*',
                'notifikasi',
                'notifikasi/*',
            ]
        ],

        // Admin Guard untuk halaman admin
        'adminGuard' => [
            'before' => [
                'event/create',
                'event/store',
                'event/edit/*',
                'event/update/*',
                'event/delete/*',

                'mahasiswa',
                'mahasiswa/*',

                'pendaftaran/edit/*',
                'pendaftaran/update/*',
                'pendaftaran/delete/*',
            ]
        ]
    ];
}

