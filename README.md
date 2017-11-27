# 钉钉组件

## 自定义机器人
1. 初始化
~~~php
<?php 
use Xin\DingTalk\Application;

$config = [
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

$ding = new Application($config);
~~~

2. 发送消息
~~~php
<?php

/** @var \Psr\Http\Message\ResponseInterface[] $res */
$res = $ding->robot->sendText('测试sendText方法', [], ['test']);

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
~~~
