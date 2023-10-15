<?php

namespace App\Middleware;

use App\Middleware\Contract\MiddlewareInterface;
use hisorange\BrowserDetect\Parser as Browser;

class BlockFirefox implements MiddlewareInterface
{
    public function handle()
    {
        if (Browser::isFirefox()) {
            dd('Block Firefox Browser');
        }
    }
}
