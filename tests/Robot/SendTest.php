<?php

namespace Tests\Test;

use Tests\TestCase;

class SendTest extends TestCase
{
    public function testSend()
    {
        $data = [
            'msgtype' => 'text',
            'text' => [
                "content" => "测试send方法"
            ],
        ];

        $key = 'test';
        /** @var \Psr\Http\Message\ResponseInterface[] $res */
        $res = $this->ding->robot->send($data, [$key]);
        foreach ($res as $item) {
            $result = $item->getBody()->getContents();
            $this->assertEquals(
                [
                    'errcode' => 0,
                    'errmsg' => 'ok'
                ],
                json_decode($result, true)
            );
        }
    }

    public function testSendText()
    {
        /** @var \Psr\Http\Message\ResponseInterface[] $res */
        $res = $this->ding->robot->sendText('测试sendText方法', [], ['test']);

        foreach ($res as $item) {
            $result = $item->getBody()->getContents();
            $this->assertEquals(
                [
                    'errcode' => 0,
                    'errmsg' => 'ok'
                ],
                json_decode($result, true)
            );
        }
    }

    public function testSendLink()
    {
        /** @var \Psr\Http\Message\ResponseInterface[] $res */
        $res = $this->ding->robot->sendLink([
            'text' => '这个即将发布的新版本，创始人陈航（花名“无招”）称它为“红树林”。
而在此之前，每当面临重大升级，产品经理们都会取一个应景的代号，这一次，为什么是“红树林”？',
            'title' => '时代的火车向前开',
            'picUrl' => '',
            'messageUrl' => 'https://mp.weixin.qq.com/s?__biz=MzA4NjMwMTA2Ng==&mid=2650316842&idx=1&sn=60da3ea2b29f1dcc43a7c8e4a7c97a16&scene=2&srcid=09189AnRJEdIiWVaKltFzNTw&from=timeline&isappinstalled=0&key=&ascene=2&uin=&devicetype=android-23&version=26031933&nettype=WIFI'
        ], [
            'test'
        ]);

        foreach ($res as $item) {
            $result = $item->getBody()->getContents();
            $this->assertEquals(
                [
                    'errcode' => 0,
                    'errmsg' => 'ok'
                ],
                json_decode($result, true)
            );
        }
    }

    public function testSendMarkdown()
    {
        /** @var \Psr\Http\Message\ResponseInterface[] $res */
        $res = $this->ding->robot->sendMarkdown(
            '杭州天气',
            "#### 杭州天气 @156xxxx8827\n" .
            "> 9度，西北风1级，空气良89，相对温度73%\n\n" .
            "> ![screenshot](https://avatars0.githubusercontent.com/u/16648551?s=460&v=4)\n" .
            "> ###### 10点20分发布 [天气](http://www.thinkpage.cn/) \n",
            [],
            ['test']
        );

        foreach ($res as $item) {
            $result = $item->getBody()->getContents();
            $this->assertEquals(
                [
                    'errcode' => 0,
                    'errmsg' => 'ok'
                ],
                json_decode($result, true)
            );
        }
    }
}
