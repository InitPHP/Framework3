<?php

namespace App\Providers;

use InitPHP\Framework\HTTP\Route;
use InitPHP\Framework\Providers\AbstractProvider;

class RouterServiceProvider extends AbstractProvider
{

    /**
     * @inheritDoc
     */
    public function boot(): void
    {

        Route::link('/storage', STORAGE_DIR . 'public');
        Route::path(BASE_DIR . 'routes/web.php', [
            'as'        => 'web.'
        ]);

        Route::path(BASE_DIR . 'routes/api.php', [
            'as'            => 'api.',          // Name Prefix
            'prefix'        => '/api/',         // Path Prefix
            'middleware'    => [],              // Middlewares
        ]);
    }

}
