<?php

namespace net\syabr\pve\weapon;

use pocketmine\item\Item;

abstract class Weapon extends Item{

    public $xp = 0;
    private $baseAttackPoint = 5;

    abstract function getName();

    public function __construct(){
        $this->setUnbreakable();
    }

    public function getXp(){
        return $this->xp;
    }

    public function calcLevel(){
        $xp = $this->getXp();
    }


    public function getBaseAttackPoint(){
        return $this->baseAttackPoint;
    }

    public function setBaseAttackPoint(int $point){
        $this->baseAttackPoint = $point;
    }

}