<?php

return [

    /*
     * If true, the exporter will crawl through your site's pages to determine
     * the paths that need to be exported.
     */
    'crawl' => false,

    /*
     * Add additional paths to be added to the export here. If you're using the
     * `crawl` option, you probably don't need to add anything here.
     */
    'paths' => [
        '/',
        'datos',
        'videos',
        'propiedad',
        'contactos',
        'publicaciones',
        'medios',
        'referencias',
        'monitoreo',
        'investigacion',
    ],

    /*
     * Files and folders that should be included in the build. Expects
     * key/value pairs with current paths as keys, and destination paths
     * as values.
     *
     * By default your `public` folder's contents will be added to the export.
     */
    'include_files' => [
        'public/build' => 'build',
        'public/css' => 'css',
        'public/js' => 'js',
        'public/images' => 'images',
        'public/media' => 'media',
        'public/webfonts' => 'webfonts',
        'public/data' => 'data',
        'storage/app/public/medios' => 'storage/medios',
        'storage/app/public/publicaciones' => 'storage/publicaciones',
        '.assetsignore' => '.assetsignore',
        '_headers' => '_headers',
    ],

    /*
     * File patterns that should be excluded from the included files.
     */
    'exclude_file_patterns' => [
        '/\.php$/',
        '/mix-manifest\.json$/',
    ],

    /*
     * Whether or not the destination folder should be emptied before starting
     * the export.
     */
    'clean_before_export' => true,

    /*
     * If set, the site will be exported to this disk. Disks can be configured
     * in `config/filesystems.php`.
     *
     * If empty, your site will be exported to a `dist` folder.
     */
    'disk' => "htdocs",

    /*
     * Shell commands that should be run before the export starts when running
     * `php artisan export`.
     */
    'before' => [
        // 'assets' => '/usr/local/bin/yarn production',
    ],

    /*
     * Shell commands that should be run after the export has finished when
     * running `php artisan export`.
     */
    'after' => [
        'deploy' => 'C:\xampp\htdocs\collective-view\deploy.bat',
    ],

];