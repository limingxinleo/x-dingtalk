<?php
// +----------------------------------------------------------------------
// | BaseTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Test;

use limx\Support\Collection;
use Tests\TestCase;
use Xin\DingTalk\Application;
use Xin\DingTalk\Robot\RobotClient;

class BaseTest extends TestCase
{

    public function testInstance()
    {
        $this->assertEquals($this->ding, Application::getInstance());
    }

    public function testConfig()
    {
        $config = new Collection($this->config);
        $this->assertEquals($config->toArray(), $this->ding->config->toArray());
    }

    public function testHttpClient()
    {
        $client = $this->ding->httpClient;
        $response = $client->post('https://demo.phalcon.lmx0536.cn/test/api/api');
        $result = $response->getBody()->getContents();
        $result = json_decode($result, JSON_UNESCAPED_UNICODE);
        $this->assertEquals(1, $result['status']);
    }

    public function testSet()
    {
        $url = file_get_contents('url');

        $set = new RobotClient([
            'url' => $url
        ]);

        $this->ding->setTest = $set;

        $this->assertEquals($set, $this->ding->setTest);

        /** @var \Psr\Http\Message\ResponseInterface $res */
        $res = $this->ding->setTest->sendText('Hello World');
        $result = $res->getBody()->getContents();
        $this->assertEquals(
            [
                'errcode' => 0,
                'errmsg' => 'ok'
            ],
            json_decode($result, true)
        );
    }
}