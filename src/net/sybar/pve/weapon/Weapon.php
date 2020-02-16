<?php
namespace net\sybar\pve\weapon;

interface Weapon
{
    public function getXp(): int;
    public function addXp(int $xp);
    public function calcLevel();
    public function getWeaponName(): string;
    public function getWeaponId(): int;
}
