<?php

namespace net\syabr\pve\weapon;

use pocketmine\item\Item;
use pocketmine\item\Sword;

abstract class WeaponSword extends Sword implements Weapon {

    public $xp = 0;
    private $baseAttackPoint = 5;
    private $name;

    abstract function getName();

    public function __construct($id, $meta){
        parent::__construct($id, $meta, $this->getName());
        $this->setUnbreakable();
    }

    public function getXp(){
        return $this->xp;
    }

    public function calcLevel(){
        $xp = $this->getXp();
    }


    public function getAttackPoints(){
        return $this->baseAttackPoint;
    }

    public function setAttackPoints(int $point){
        $this->baseAttackPoint = $point;
    }

}