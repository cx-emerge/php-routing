<?php
use PHPUnit\Framework\TestCase;
use Emerge\Routing;

class RoutingTest extends TestCase
{
    public function testVERSION()
    {
        $this->assertEquals('0.1.2', Routing::VERSION);
    }

    public function testGet()
    {
        $routing = new Routing();

        $routeData = $routing->get(
            '/admin',
            ['App\Admin', 'index']
        );

        $this->assertEquals([
            '/admin',
            ['App\Admin', 'index'],
            ['method' => ['GET']]
        ], $routeData);
    }

    public function testDispatch()
    {
        $routing = new Routing();

        $routing->get(
            '/admin',
            ['App\Admin', 'index']
        );

        $routing->get(
            '/admin/user/$id',
            ['App\Admin', 'index'],
            [
                'requirements' => [
                    'id' => '\d+'
                ]
            ]
        );

        $result = $routing->dispatch('GET', '/admin/user/1');

        $this->assertEquals([
            'route' => '/admin/user/$id',
            'callback' => [
                'App\Admin',
                'index'
            ],
            'options' => [
                'requirements' => [
                    'id' => '\d+'
                ],
                'method' => [
                    'GET'
                ]
            ],
            'parameters' => [
                0 => '/admin/user/1',
                'id' => 1,
                1 => 1
            ]
        ], $result);
    }
}
