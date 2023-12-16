<?php
/**
 * InitPHP Framework
 *
 * This file is part of InitPHP.
 *
 * @author     Muhammet ŞAFAK <info@muhammetsafak.com.tr>
 * @copyright  Copyright © 2023 InitPHP Framework
 * @license    http://initphp.github.io/license.txt  MIT
 * @version    3.0
 * @link       https://www.muhammetsafak.com.tr
 */

declare(strict_types=1);
namespace InitPHP\Framework\Providers;

use InitORM\Database\Facade\DB;
use InitORM\DBAL\Connection\Connection;
use InitPHP\Framework\Base;
use InitPHP\Framework\Database\Database;
use InitPHP\Framework\Libraries\{Encryption, Logger, Translator, Upload};

class BootstrapServiceProvider extends AbstractProvider
{

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        // Database
        $defaultCredentials = config('database.default');
        DB::createImmutable(new Connection($defaultCredentials));
        !Base::hasProperty('db') && Base::setProperty('db', new Database());

        // Encryption
        !Base::hasProperty('encrypt') && Base::setProperty('encrypt', new Encryption());

        // Logger
        !Base::hasProperty('logger') && Base::setProperty('logger', new Logger(env("LOGGER_DRIVER")));

        // Languages & Translator
        !Base::hasProperty('lang') && Base::setProperty('lang', new Translator());

        // Upload
        !Base::hasProperty('upload') && Base::setProperty('upload', new Upload());
    }



}
