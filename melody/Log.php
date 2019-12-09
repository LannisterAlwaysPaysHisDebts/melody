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
        $data = "[{$date}]{$namespace}[{$tag}]: {$content}\n";

        if (empty($file)) {
            $file = $this->logPath . $namespace;
        }

        if (!file_exists($file)) {
            $path = $this->logPath;
            $pathArr = explode('/', $namespace);
            $count = count($pathArr);
            foreach ($pathArr as $k => $v) {
                if (!empty($v) && $k != $count - 1) {
                    $path .= $v . "/";
                    if (!file_exists($path)) {
                        mkdir($path);
                    }
                }
            }
            file_put_contents($file, $data);
        } else {
            file_put_contents($file, $data, FILE_APPEND);
        }
    }
}