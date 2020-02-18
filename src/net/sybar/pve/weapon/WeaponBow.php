<?php
namespace net\sybar\pve\weapon;

use pocketmine\item\Bow;
use net\sybar\pve\weapon\exp\ExpTbl;

abstract class WeaponBow extends Bow implements Weapon
{
    /** @var int */
    public $xp = 0;
    /** @var int */
    private $baseAttackPoint = 5;

    public function __construct($id, $meta)
    {
        parent::__construct($id, $meta, $this->getWeaponName());
        $this->setUnbreakable();
        $this->exp_tbl = new ExpTbl($this);
    }

    public function getXp(): int
    {
        return $this->xp;
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

    public function getWeaponLevel(): int
    {
        return $this->exp_tbl->getLevel($this->getXp());
    }

    /**
     * ダメージ値
     *
     * @return float
     */
    public function getAttackPoints(): int
    {
        return $this->baseAttackPoint;
    }

    /**
     * ダメージ値設定
     *
     * @param integer $point
     * @return void
     */
    public function setAttackPoints(int $point)
    {
        $this->baseAttackPoint = $point;
    }
}
