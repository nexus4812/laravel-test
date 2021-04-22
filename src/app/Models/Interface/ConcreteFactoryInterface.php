<?php


namespace App\Models\Interface;


interface ConcreteFactoryInterface
{
    /**
     * @param mixed ...$parameters
     * @return mixed
     */
    public static function concreteFactory(...$parameters);
}
