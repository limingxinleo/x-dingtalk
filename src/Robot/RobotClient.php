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
use GuzzleHttp\Client;

class RobotClient
{
    public $url;

    protected $timeout;

    public function __construct(array $gateway, Config $config)
    {
        $this->url = $gateway['url'];
        $this->timeout = $config->get('timeout', 5.0);
    }

    /**
     * @desc   发送钉钉消息
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function send($data = [])
    {
        $client = new Client([
            'timeout' => $this->timeout,
        ]);

        return $client->post($this->url, [
            'json' => $data,
        ]);
    }

    /**
     * @desc   发送Text类型数据
     * @param string $content
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendText($content, array $at = [])
    {
        $data = [
            'msgtype' => 'text',
            'text' => [
                'content' => $content,
            ],
            'at' => $at,
        ];

        return $this->send($data);
    }

    /**
     * @desc   发送link类型数据
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendLink(array $link = [])
    {
        $data = [
            'msgtype' => 'link',
            'link' => [
                'text' => $link['text'],
                'title' => $link['title'],
                'picUrl' => $link['picUrl'],
                'messageUrl' => $link['messageUrl'],
            ],
        ];

        return $this->send($data);
    }

    /**
     * @desc   发送Markdown消息
     * @param string $title
     * @param string $text
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendMarkdown($title, $text, array $at = [])
    {
        $data = [
            'msgtype' => 'markdown',
            'markdown' => [
                'text' => $text,
                'title' => $title,
            ],
            'at' => $at,
        ];

        return $this->send($data);
    }
}
