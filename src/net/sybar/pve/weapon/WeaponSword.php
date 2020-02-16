<?php
namespace net\sybar\pve\weapon;

use pocketmine\item\Sword;

abstract class WeaponSword extends Sword implements Weapon
{
    /** @var int */
    public $xp = 0;
    /** @var float */
    private $baseAttackPoint = 5.0;

    public function __construct($id, $meta)
    {
        parent::__construct($id, $meta, $this->getWeaponName());
        $this->setUnbreakable();
    }

    public function getXp(): int
    {
        return $this->xp;
    }

    public function calcLevel()
    {
        $xp = $this->getXp();
    }

    public function addXp(int $xp)
    {
        $this->xp += $xp;
    }

    public function getWeaponName(): string
    {
        return "";
    }

    public function getWeaponId(): int
    {
        return -1;
    }

    public function getAttackPoints(): float
    {
        return $this->baseAttackPoint;
    }

    public function setAttackPoints(int $point)
    {
        $this->baseAttackPoint = $point;
    }
}
