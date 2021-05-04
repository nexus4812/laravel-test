<?php


namespace Tests\Feature\Helpers;


trait routeUrl
{
    protected string $routeName;

    protected function getUrl():string
    {
        return route($this->routeName);
    }
}
