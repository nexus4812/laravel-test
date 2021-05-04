<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;
use Tests\Feature\Helpers\routeUrl;

abstract class MyTestCase extends TestCase
{
    use routeUrl;

    protected function routePost(array $data = [], array $headers = []): TestResponse
    {
        return $this->post($this->getUrl(), $data, $headers);
    }

    protected function routeGet(array $headers = []): TestResponse
    {
        return $this->get($this->getUrl(), $headers);
    }
}
