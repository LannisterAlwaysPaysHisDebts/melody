<?php

namespace Melody\Facade;


use Melody\Facade;

/**
 * @see \Melody\Router
 * @mixin \Melody\Router
 *
 */
class Router extends Facade
{
    protected static function getFacade()
    {
        return "Router";
    }
}