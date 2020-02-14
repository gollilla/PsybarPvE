<?php

namespace net\syabr\pve\weapon;

class Weapon {

    private static $weapons = [];

    public static function register(string $name, Weapon $weapon){
        self::$weapons[$name] = $weapon;
    }


    public static function get(string $name){
        return isset(self::$weapons[$name]) ? self::$weapons[$name] : null;
    }
}