<?php
// +----------------------------------------------------------------------
// | Client.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\DingTalk\Robot;

use Xin\DingTalk\Config;

class RobotFactory
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
        $data = array_shift($arguments);

        $result = [];

        if (empty($arguments)) {
            foreach ($this->gateways as $gateway) {
                $result[] = $gateway->$name($data);
            }
        } else {
            foreach ($arguments as $key) {
                if (isset($this->gateways[$key])) {
                    $result[] = $this->gateways[$key]->$name($data);
                }
            }
        }

        return $result;
    }
}