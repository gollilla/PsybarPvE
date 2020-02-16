<?php
namespace net\sybar\pve\weapon;

use pocketmine\item\Bow;

abstract class WeaponBow extends Bow implements Weapon
{
    /** @var int */
    public $xp = 0;
    /** @var float */
    private $baseAttackPoint = 5.0;

    public function __construct($id, $meta)
    {
        parent::__construct($id, $meta, $this->getName());
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

    /**
     * ダメージ値
     *
     * @return float
     */
    public function getAttackPoints(): float
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
