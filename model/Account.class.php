<?php


namespace model;


use Melody\Register;

class Account
{
    /**
     * @return bool
     */
    public static function checkLogin()
    {
        return isset($_SESSION["Hash"]);
    }

    /**
     * @param $userName
     * @param $passWd
     * @return bool
     */
    public static function login($userName, $passWd)
    {
        if ($userName != Register::get("Config")['user_account']) {
            return false;
        }
        if ($passWd != Register::get("Config")['user_passWd']) {
            return false;
        }

        $_SESSION["Hash"] = password_hash($passWd, PASSWORD_DEFAULT);
        return true;
    }

}