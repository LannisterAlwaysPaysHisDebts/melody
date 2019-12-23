<?php

namespace Melody\Model;

use Melody\Model;

class CliModel extends Model
{
    public static function exit(string $string)
    {
        exit($string . PHP_EOL);
    }

    public static function table(array $array, array $title)
    {
        $maxSpace = self::_findArr([$array, $title]);
        $maxSpace += 4;
        $data = array_merge([$title], $array);
        foreach ($data as $item) {
            if (is_string($item)) {
                echo $item . PHP_EOL;
            }elseif (is_array($item)) {
                echo self::_appendSpace($item, $maxSpace) . PHP_EOL;
            }
        }
    }

    private static function _appendSpace(array $array, int $maxSpace)
    {
        if ($maxSpace <= 0) return "";

        $str = "";
        foreach ($array as $item) {
            if (is_string($item)) {
                $length = mb_strlen($item);
                if ($length <= $maxSpace) {
                    $addLength = $maxSpace - $length;
                    for (; $addLength > 0; $addLength--) {
                        $item .= " ";
                    }
                    $str .= $item;
                } else {
                    $childItem = mb_substr($item, 0, $maxSpace - 6);
                    $str .= $childItem . '..    ';
                }
            }
        }
        return $str;
    }

    private static function _findArr(array $array, $flag = 0)
    {
        $length = 0;
        $flag++;
        foreach ($array as $item) {
            $strLen = 0;
            if (is_array($item) && $flag <= 10) {
                $strLen = self::_findArr($item, $flag);
            } elseif (is_string($item)) {
                $strLen = mb_strlen($item);
            }
            if ($strLen > $length) $length = $strLen;
        }
        return $length;
    }
}