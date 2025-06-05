<?php

namespace Tests\Perry;

use Perry\Attributes\Info;
use Perry\Attributes\Server;
use Perry\Attributes\Servers;
use Perry\PerryHttp\PerryHttpRequest;
use Illuminate\Foundation\Testing\TestCase as LaravelTestCase;

#[Servers(
    new Server(description: 'Example server local', url: 'http://localhost:8000')
)]
#[Info(
    version: '1.0.0',
    title: 'Example server title',
    description: 'Example server description',
)]
abstract class BaseTestCase extends LaravelTestCase
{
    use PerryHttpRequest;
}
