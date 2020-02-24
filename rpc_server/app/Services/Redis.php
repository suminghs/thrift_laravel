<?php
namespace App\Services;

use \Illuminate\Support\Facades\Redis as Predis;

/**
 * Class Redis
 * @package App\Services
 * Redis封装类
 */
class Redis
{

    public static function setArr($key,$val,$expire=false){
        $val = json_encode($val);
        if($expire){
            Predis::setex($key,$expire,$val);
        }else{
            Predis::set($key,$val);
        }
    }

    public static function getArr($key){
        return json_decode(Predis::get($key),true);
    }

    public static function set($key,$val,$expire=false){
        if($expire){
            Predis::setex($key,$expire,$val);
        }else{
            Predis::set($key,$val);
        }
    }

    public static function get($key){
        return Predis::get($key);
    }

    public static function exists($key){
        return Predis::exists($key);
    }

    public static function del($key){
        Predis::del($key);
    }

}