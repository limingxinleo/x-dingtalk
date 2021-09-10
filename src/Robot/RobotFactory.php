<?php
// +----------------------------------------------------------------------
// | Client.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Fan\DingTalk\Robot;

use Fan\DingTalk\Config;
use Fan\DingTalk\Exceptions\DingTalkException;

class RobotFactory implements \ArrayAccess
{
    /** @var RobotClient[] $gateways */
    public $gateways;

    public function __construct(Config $config)
    {
        foreach ($config->robot['gateways'] as $key => $gateway) {
            $this->gateways[$key] = new RobotClient($gateway);
        }
    }

    public function __call($name, $arguments)
    {
        $gws = array_pop($arguments);

        $result = [];

        foreach ($gws as $key) {

            if (isset($this->gateways[$key])) {
                $result[$key] = $this->gateways[$key]->$name(...$arguments);
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
