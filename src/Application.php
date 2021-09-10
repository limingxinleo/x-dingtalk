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
namespace Fan\DingTalk;

use Fan\DingTalk\Exceptions\DingTalkException;
use Fan\DingTalk\Robot\RobotFactory;
use GuzzleHttp\Client;
use Pimple\Container;

/**
 * Class Application.
 * @property Config $config
 * @property Client $httpClient
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
     * @param mixed $value
     */
    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }

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
     * Register providers.
     */
    private function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }
}
