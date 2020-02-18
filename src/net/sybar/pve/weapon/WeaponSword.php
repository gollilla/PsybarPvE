<?php
namespace net\sybar\pve\weapon;

use pocketmine\item\Sword;
use pocketmine\item\Item;
use net\sybar\pve\weapon\exp\ExpTbl;

abstract class WeaponSword extends Sword implements Weapon
{

    /** @var int */
    public $xp = 0;
    /** @var int */
    private $baseAttackPoint = 5;

    public function __construct($id = Item::WOODEN_SWORD, $meta = 0, $tier = Sword::TIER_WOODEN)
    {
        parent::__construct($id, $meta, $this->getWeaponName(), $tier);
        $this->setUnbreakable();
        $this->exp_tbl = new ExpTbl($this);
    }


    public function getXp(): int
    {
        return $this->xp;
    }


    public function getWeaponLevel(): int
    {
        return $this->exp_tbl->getLevel($this->getXp());
    }


    public function addXp(int $xp): array
    {
        $bf = $this->getWeaponLevel();
        $this->xp += $xp;
        $af = $this->getWeaponLevel();
        if($bf != $af){
            return [$bf, $af];
        }
        return [];
    }

    public function getWeaponName(): string
    {
        return "";
    }

    public function getWeaponId(): int
    {
        return -1;
    }

    public function getAttackPoints(): int
    {
        return $this->baseAttackPoint;
    }

    public function setAttackPoints(int $point)
    {
        $this->baseAttackPoint = $point;
    }
}
