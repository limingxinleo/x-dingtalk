<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Fan\DingTalk\ServiceProviders;

use GuzzleHttp\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class HttpClientServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['httpClient'] = function ($pimple) {
            $config = $pimple['config'];
            $timeout = isset($config->timeout) ? $config->timeout : 5.0;
            return new Client([
                'timeout' => $timeout,
            ]);
        };
    }
}
