<?php

namespace Melody\Facade;


use Melody\Facade;

/**
 * @see \Melody\Config
 * @mixin \Melody\Config
 * @method load(string $file)
 *
 */
class Config extends Facade
{
    protected static function getFacade()
    {
        return "Config";
    }
}