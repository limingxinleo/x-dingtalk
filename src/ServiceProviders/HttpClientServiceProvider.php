<?php
// +----------------------------------------------------------------------
// | RobotServiceProvider.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
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
