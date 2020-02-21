<?php

namespace net\sybar\pve\entity;

use pocketmine\entity\Zombie;
use pocketmine\PLayer;

class NormalZombie extends Zombie {

    private $target = null;
    private $speed = 0.5;
    
    public function entityBaseTick(int $tickDiff = 1): bool
    {
        if($this->getTarget() != NULL)
            return parent::entityBaseTick($tickDiff);

        $target = $this->getTarget();
        if(!($target instanceof Player))
            return parent::entityBaseTick($tickDiff);
        $speed = $this->getSpeed();
        $this->lookAt($target);
        $moveX = sin($this->yaw / M_PI * 180) * $speed;
        $moveZ = cos($this->yaw / M_PI * 180) * $speed;
        $this->checkFront();
        $this->motion->x = $moveX;
        $this->motion->z = $moveZ;

        return parent::entityBaseTick($tickDiff);
    }


    public function checkFront(): void
    {
        $dv = $this->getDirectionVector()->multiply(1);
        $checkPos = $this->add($dv->x, $dv->y + 1, $dv->z)->floor();
        if($this->level->getBlockAt($checkPos->x, $checkPos->y, $checkPos->z)->isSolid())
        {
            return;
        }
        $checkPos = $checkPos->up(1)->floor();
        if($this->level->getBlockAt($checkPos->x, $checkPos->y, $checkPos->z)->isSolid())
        {
            $this->jump();
        }
    }


    public function setTarget(Player $player)
    {
        $this->target = $player;
    }

    public function getTarget()
    {
        return $this->target;
    }

}