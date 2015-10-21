<?php
require implode(DIRECTORY_SEPARATOR, [
    dirname(__DIR__), 'vendor', 'autoload.php'
]);

use Emerge\Routing;

class RoutingTest extends PHPUnit_Framework_TestCase
{
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
            ['method' => 'GET']
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

        $routing->dispatch('GET', '/admin/user/1');
    }
}
