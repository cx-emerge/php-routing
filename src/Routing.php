<?php
namespace Emerge;

/**
 * Emerge Routing
 *
 * 路由
 */
class Routing
{
    /** @var string 版本号 */
    const VERSION = '0.1.0';

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
        $this->filterRouteOptions($options);

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
        $result = [];

        foreach ($this->routeData as $routeData) {
            $pattern = preg_replace_callback(
                '~\$([\w\d-_]+)~',
                function ($matches) use ($routeData) {
                    $requirements = '\w+';
                    if (isset($routeData[2]['requirements'])) {
                        $requirement = $routeData[2]['requirements'][$matches[1]];
                        $requirements = $requirement ?: $requirements;
                    }

                    return sprintf('(?<%s>%s)', $matches[1], $requirements);
                },
                $routeData[0]
            );
            $pattern = '~^' . $pattern . '$~';

            if (preg_match($pattern, $uri, $parameters)) {
                $result['route'] = $routeData[0];
                $result['callback'] = $routeData[1];
                $result['options'] = $routeData[2];
                $result['parameters'] = $parameters;
                break;
            }
        }

        return $result;
    }

    /**
     * 过滤路由选项
     *
     * @param mixed[] &$options 路由选项
     */
    private function filterRouteOptions(&$options)
    {
        if (!isset($options['method'])) {
            $options['method'] = ['GET'];
        } elseif (is_string($options['method'])) {
            $options['method'] = [$options['method']];
        }
    }
}
