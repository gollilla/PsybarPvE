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

    private $opt = [];

    public function __construct($id = Item::WOODEN_SWORD, $meta = 0, $tier = Sword::TIER_WOODEN)
    {
        parent::__construct($id, $meta, $this->getWeaponName(), $tier);
        $this->setUnbreakable();
        $this->exp_tbl = new ExpTbl($this);
        $opt = [5,6,7,8];
        $opt = $opt[mt_rand(0,4)];
        $this->addOpt($opt);
    }


    public function getXp(): int
    {
        return $this->xp;
    }

    public function addOpt(int $atk)
    {
        $this->opt[] = $atk;
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
        $level_calc = $this->getLevel() * 1.1;
        $this->addOpt($level_calc);
        foreach($this->getOpt() as $opt){
            $this->baseAttackPoint += $opt;
        }
        return $this->baseAttackPoint + $this->getOpt();
    }

    public function setAttackPoints(int $point)
    {
        $this->baseAttackPoint = $point;
    }
}
