<?php

return [
    
    /*
    |------------------------------------------------------------------------
    | Autoloaded Service Providers
    |------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded. You can 
    | add your own services to this array to grant expanded functionality to 
    | your applications.
    |
    */

    'providers' => [

        /*
         * Lenevor Framework Service Providers
         */
        Syscode\Cache\CacheServiceProvider::class,
        Syscode\Database\DatabaseServiceProvider::class,
        Syscode\Filesystem\FilesystemServiceProvider::class,
        Syscode\Translation\TranslationServiceProvider::class,
        Syscode\View\ViewServiceProvider::class,


        /**
         * Application Service Providers
         */
        App\Providers\RouteServiceProvider::class,

    ],

    /*
    |------------------------------------------------------------------------
    | Class Aliases
    |------------------------------------------------------------------------
    |
    | This array of class aliases will be registered cuando an application is 
    | started. You can added the aliases loaded so they don't hinder performance. 
    |
    */

    'aliases' => [

        'App' => Syscode\Support\Facades\App::class,
        'Cache' => Syscode\Support\Facades\Cache::class,
        'Config' => Syscode\Support\Facades\Config::class,
        'File' => Syscode\Support\Facades\File::class,
        'Http' => Syscode\Support\Facades\Http::class,
        'Lang' => Syscode\Support\Facades\Lang::class,
        'Log' => Syscode\Support\Facades\Log::class,
        'Prime' => Syscode\Support\Facades\Prime::class,
        'Redirect' => Syscode\Support\Facades\Redirect::class,
        'Redis' => Syscode\Support\Facades\Redis::class,
        'Request' => Syscode\Support\Facades\Request::class,
        'Response' => Syscode\Support\Facades\Response::class,
        'Route' => Syscode\Support\Facades\Route::class,
        'URL' => Syscode\Support\Facades\URL::class,
        'View' => Syscode\Support\Facades\View::class,

    ],

];