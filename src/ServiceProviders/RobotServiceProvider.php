<?php
// +----------------------------------------------------------------------
// | RobotServiceProvider.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\DingTalk\ServiceProviders;

use Xin\DingTalk\Robot\RobotFactory;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class RobotServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['robot'] = function ($pimple) {
            $config = $pimple['config'];
            return new RobotFactory($config);
        };
    }
}