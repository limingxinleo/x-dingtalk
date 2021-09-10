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
namespace Fan\DingTalk\Robot;

use Fan\DingTalk\Config;
use Fan\DingTalk\Exceptions\DingTalkException;

class RobotFactory implements \ArrayAccess
{
    /** @var RobotClient[] */
    public $gateways;

    public function __construct(Config $config)
    {
        foreach ($config->get('robot.gateways', []) as $key => $gateway) {
            $this->gateways[$key] = new RobotClient($gateway, $config);
        }
    }

    public function __call($name, $arguments)
    {
        $gws = array_pop($arguments);

        $result = [];

        foreach ($gws as $key) {
            if (isset($this->gateways[$key])) {
                $result[$key] = $this->gateways[$key]->{$name}(...$arguments);
            }
        }

        return $result;
    }

    public function offsetExists($offset)
    {
        return isset($this->gateways[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->gateways[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if ($value instanceof RobotClient) {
            $this->gateways[$offset] = $value;
        } else {
            throw new DingTalkException('The value must instanceof \Fan\DingTalk\Robot\RobotClient');
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->gateways[$offset]);
    }
}
