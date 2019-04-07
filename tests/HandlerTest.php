<?php

namespace Ldoc\Tests;

use PHPUnit\Framework\TestCase;
use Ldoc\Handler;

class HandlerTest extends TestCase
{
    public function testHandler()
    {
        $handler = new Handler(__DIR__.'/../storage/docs');
        $data = $handler->handle('index.html');

        $this->assertTrue(isset($data['sidebar']));
        $this->assertTrue(isset($data['content']));
    }
}
