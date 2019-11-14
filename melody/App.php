<?php
/**
 * 应用容器
 */

namespace Melody;

class App
{
    public function run()
    {
        require 'Load.php';
        $load = Load::autoloadRegister();
    }
}