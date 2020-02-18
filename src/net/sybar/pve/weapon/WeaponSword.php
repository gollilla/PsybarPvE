<?php
namespace net\sybar\pve\weapon;

use pocketmine\item\Sword;
use net\sybar\pve\weapon\exp\ExpTbl;

abstract class WeaponSword extends Sword implements Weapon
{

    /** @var int */
    public $xp = 0;
    /** @var float */
    private $baseAttackPoint = 5.0;

    public function __construct($id = self::SWORD, $meta = 0)
    {
        parent::__construct($id, $meta, $this->getWeaponName());
        $this->setUnbreakable();
        $this->exp_tbl = new ExpTbl($this);
    }


    public function getXp(): int
    {
        return $this->xp;
    }


    public function getWeaponLevel(): int
    {
        return $this->getNamedTag()->getCompound(self::TAG_INFO)->getInt(self::TAG_INFO_LEVEL);
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
