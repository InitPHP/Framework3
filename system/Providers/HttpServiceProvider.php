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

use InitPHP\Framework\Base;
use InitPHP\Framework\Libraries\{Input, Cookie, Session};
use InitPHP\Framework\HTTP\{Request, Response, Router};

class HttpServiceProvider extends AbstractProvider
{

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        $request = Request::createFromGlobals();
        !Base::hasProperty('request') && Base::setProperty('request', $request);

        $response = new Response();
        !Base::hasProperty('response') && Base::setProperty('response', $response);

        if (!Base::hasProperty('router')) {
            Base::setProperty('router', new Router($request, $response));
        }

        !Base::hasProperty('cookie') && Base::setProperty('cookie', new Cookie());
        !Base::hasProperty('session') && Base::setProperty('session', new Session());
        !Base::hasProperty('input') && Base::setProperty('input', new Input());
    }
}