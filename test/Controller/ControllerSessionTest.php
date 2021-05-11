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
class ControllerSessionTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new SessionController();
        $this->assertInstanceOf("App\Http\Controllers\SessionController", $controller);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testReturnsResponse()
    {
        $controller = new SessionController();
        $this->assertInstanceOf("App\Http\Controllers\SessionController", $controller);
        $response = $this->get('/session');

        $response->assertStatus(200);
    }

    // /**
    //  * Destroy the session.
    //  * @runInSeparateProcess
    //  */
    // public function testDestroySession()
    // {
    //     session_start();
    //     $controller = new Session();

    //     $_SESSION = [
    //         "key" => "value"
    //     ];

    //     $exp = "\Psr\Http\Message\ResponseInterface";
    //     $res = $controller->destroy();
    //     $this->assertInstanceOf($exp, $res);
    //     $this->assertEmpty($_SESSION);
    // }
}
