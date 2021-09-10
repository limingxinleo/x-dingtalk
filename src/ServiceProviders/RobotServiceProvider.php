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
