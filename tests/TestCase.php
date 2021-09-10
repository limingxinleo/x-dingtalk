<?php
// +----------------------------------------------------------------------
// | TestCase.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests;

use PHPUnit\Framework\TestCase as UnitTestCase;
use Fan\DingTalk\Application;

class TestCase extends UnitTestCase
{
    /** @var Application */
    public $ding;

    public $config;

    public function setUp(): void
    {
        $url = file_get_contents('url');

        $this->config = [
            // HTTP 请求的超时时间（秒）
            'timeout' => 5.0,
            // 机器人模块
            'robot' => [
                'gateways' => [
                    'test' => [
                        'url' => $url,
                    ],
                    'test2' => [
                        'url' => $url,
                    ],
                ],
            ],
        ];

        $this->ding = new Application($this->config);
    }
}
