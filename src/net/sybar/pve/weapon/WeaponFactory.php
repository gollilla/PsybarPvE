<?php
namespace net\sybar\pve\weapon;

class WeaponFactory
{
    private static $weapons = [];

    public static function init()
    {
        self::registerWeapon(new SampleWeapon());
    }

    public static function get(int $id): Weapon
    {
        if (!self::isRegistered($id)) {
            throw new \RuntimeException("Weapon(ID:{$id}) is not found");
        }

        return clone self::$weapons[$id];
    }

    private static function registerWeapon(Weapon $weapon, bool $override = false)
    {
        $id = $weapon->getWeaponId();
        if (!$override && self::isRegistered($id)) {
            throw new \RuntimeException('Trying to override an already weapon');
        }

        self::$weapons[$id] = clone $weapon;
    }

    private static function isRegistered(int $id): bool
    {
        return isset(self::$weapons[$id]);
    }
}
