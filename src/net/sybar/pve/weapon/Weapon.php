<?php

namespace net\syabr\pve\weapon;

use pocketmine\item\Item;

abstract class Weapon extends Item {

    abstract public function setCustomName(string $name);
    abstract public function getCustomName();
    abstract public function setPower(int $power);
    abstract public function getPower();

}