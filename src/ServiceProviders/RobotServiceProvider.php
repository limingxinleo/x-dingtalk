<?php

namespace Fan\DingTalk\ServiceProviders;

use Fan\DingTalk\Robot\RobotFactory;
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
