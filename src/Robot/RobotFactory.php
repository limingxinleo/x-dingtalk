<?php
// +----------------------------------------------------------------------
// | Client.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\DingTalk\Robot;

use Xin\DingTalk\Config;

class RobotFactory
{
    /** @var RobotClient[] $robots */
    public $robots;

    public function __construct(Config $config)
    {

    }
}