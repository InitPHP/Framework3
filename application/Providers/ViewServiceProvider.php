<?php

namespace App\Providers;

use InitPHP\Framework\Providers\AbstractProvider;
use InitPHP\Views\Adapters\BladeAdapter;
use InitPHP\Views\Adapters\PurePHPAdapter;
use InitPHP\Views\Adapters\TwigAdapter;
use InitPHP\Views\Facade\View;

class ViewServiceProvider extends AbstractProvider
{

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        $adapter = match (env('VIEW_ADAPTER')) {
            'blade'                 => new BladeAdapter(BASE_DIR . 'resources/views', STORAGE_DIR . 'cache/views'),
            'twig'                  => new TwigAdapter(BASE_DIR . 'resources/views', STORAGE_DIR . 'cache/views'),
            default                 => new PurePHPAdapter(BASE_DIR . 'resources/views')
        };
        View::via($adapter);
    }

}
