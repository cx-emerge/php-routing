<?php
namespace Emerge;

/**
 * Emerge Routing
 *
 * 路由
 */
class Routing
{
    /** @var mixed[] 路由数据 */
    private $routeData = [];

    /**
     * 路由设置
     *
     * @param string $route 路由路径
     * @param array|callable $callback 路由回调
     * @param mixed[] $options 路由选项
     *
     * @return mixed[] 添加的路由数据
     */
    public function get($route, $callback, array $options = [])
    {
        if (!isset($options['method'])) {
            $options['method'] = 'GET';
        }

        $routeData = [$route, $callback, $options];

        $this->routeData[] = $routeData;

        return $routeData;
    }

    /**
     * 分派路由
     *
     * @param string $method HTTP方法
     * @param string $uri URI
     *
     * @return mixed[] 分派结果
     */
    public function dispatch($method, $uri)
    {

    }
}
