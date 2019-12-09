<?php
namespace Melody;

class Log
{
    private $logPath;

    public function __construct()
    {
        $logPath = ROOT . "/log/";
        if (!file_exists($logPath)) {
            mkdir($logPath);
        }
        $this->logPath = $logPath;
    }

    public function setLog($content, $tag, $namespace, $file = '')
    {
        $date = date('Y-m-d H:i:s');
        $data = "[{$date}]{$namespace}: {$content} || {$tag}\n";

        if (empty($file)) {

        }

    }
}