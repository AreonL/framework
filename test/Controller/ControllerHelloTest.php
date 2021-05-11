<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use AreonL\Dice\{
    Dice,
    DiceHand,
    DiceGraphic
};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Http\Request;

/**
 * Test cases for the controller Session.
 */
class ControllerHelloWorldTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new HelloWorldController();
        $this->assertInstanceOf("App\Http\Controllers\HelloWorldController", $controller);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testHelloResponse()
    {
        $controller = new HelloWorldController();
        $this->assertInstanceOf("App\Http\Controllers\HelloWorldController", $controller);

        $response = $this->get('/hello');

        $response->assertStatus(200);
    }

     /**
     * Check that the controller returns a response.
     */
    public function testMessageResponse()
    {
        $controller = new HelloWorldController();
        $this->assertInstanceOf("App\Http\Controllers\HelloWorldController", $controller);

        $response = $this->get('/hello/thismessage');

        $response->assertStatus(200);
    }
}
