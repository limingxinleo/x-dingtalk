<?php

namespace Tests\Test;

use limx\Support\Collection;
use Tests\TestCase;
use Fan\DingTalk\Application;
use Fan\DingTalk\Robot\RobotClient;

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
