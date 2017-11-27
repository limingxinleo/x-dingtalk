<?php
// +----------------------------------------------------------------------
// | Redis类 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\DingTalk;

use Xin\DingTalk\Robot\RobotFactory;
use GuzzleHttp\Client;
use Pimple\Container;
use Xin\DingTalk\Exceptions\DingTalkException;

/**
 * Class Application
 * @package Xin\DingTalk
 * @property Config       $config
 * @property Client       $httpClient
 * @property RobotFactory $robot
 */
class Application extends Container
{
    /**
     * @var 当前实例
     */
    public static $_instance;

    /**
     * Service Providers.
     *
     * @var array
     */
    protected $providers = [
        ServiceProviders\RobotServiceProvider::class,
        ServiceProviders\HttpClientServiceProvider::class,
    ];

    /**
     * Application constructor.
     *
     * @param array $config
     */
    public function __construct($config)
    {
        parent::__construct();

        $this['config'] = function () use ($config) {
            return new Config($config);
        };

        $this->registerProviders();

        static::$_instance = $this;
    }

    /**
     * @desc   获取当前实例
     * @author limx
     * @param $config
     * @return 当前实例|static
     */
    public static function getInstance($config = null)
    {
        if (isset(static::$_instance) && static::$_instance instanceof Application) {
            return static::$_instance;
        }
        if (empty($config)) {
            throw new DingTalkException('配置文件不能为空');
        }
        return static::$_instance = new static($config);
    }

    /**
     * Magic get access.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * Magic set access.
     *
     * @param string $id
     * @param mixed  $value
     */
    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }

    /**
     * Register providers.
     */
    private function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }
}