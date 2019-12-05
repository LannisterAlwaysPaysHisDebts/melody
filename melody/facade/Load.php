<?php
namespace Melody\Facade;


use Melody\Facade;

/**
 * @see \Melody\Load
 * @mixin \Melody\Load
 *
 */
class Load extends Facade
{
    protected static function getFacade()
    {
        return "Load";
    }
}