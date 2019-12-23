<?php

namespace App\Cli;


class Index
{
    public function index()
    {
        $help = <<<EOF
Usage: php artisan [options] [args...]
    -l      show articles list


EOF;
        exit($help);
    }
}