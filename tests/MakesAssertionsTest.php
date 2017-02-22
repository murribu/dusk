<?php

use Laravel\Dusk\Browser;

class MakesAssertionsTest extends PHPUnit_Framework_TestCase
{
    public function test_assert_has_query_string_param()
    {
        $driver = Mockery::mock(StdClass::class);
        $driver->shouldReceive('navigate->to')->with('http://laravel.dev/login?param1=value1&param2=value2');
        $driver->shouldReceive('getCurrentURL')->andReturn('http://laravel.dev/login?param1=value1&param2=value2');
        $browser = new Browser($driver);

        $browser->visit('/login?param1=value1&param2=value2');
        $this->assertTrue(
            $browser->assertHasQueryStringParam('param1')
        );
        $this->assertFalse(
            $browser->assertHasQueryStringParam('foo')
        );
    }
    public function test_assert_query_string_value()
    {
        $driver = Mockery::mock(StdClass::class);
        $driver->shouldReceive('navigate->to')->with('http://laravel.dev/login?param1=value1&param2=value2');
        $driver->shouldReceive('getCurrentURL')->andReturn('http://laravel.dev/login?param1=value1&param2=value2');
        $browser = new Browser($driver);

        $browser->visit('/login?param1=value1&param2=value2');
        $this->assertTrue(
            $browser->assertQueryStringValue('param2', 'value2')
        );
        $this->assertFalse(
            $browser->assertHasQueryStringParam('foo', 'bar')
        );
    }
}
