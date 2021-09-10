<?php

namespace Fan\DingTalk\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use GuzzleHttp\Client;

class HttpClientServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['httpClient'] = function ($pimple) {
            $config = $pimple['config'];
            $timeout = isset($config->timeout) ? $config->timeout : 5.0;
            return new Client([
                'timeout' => $timeout
            ]);
        };
    }
}
