<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/27/2018
 * Time: 4:13 PM
 */

namespace App\Http;


class SessionHandler
{

    public static function get($key)
    {
        return session($key);
    }

    public static function set($key, $value)
    {
        return session([$key => $value]);
    }
}
