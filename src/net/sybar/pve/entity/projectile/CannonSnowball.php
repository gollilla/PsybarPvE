<?php

namespace net\sybar\pve\entity\projectile;

use pocketmine\entity\projectile\Snowball;
use pocketmine\event\entity\ProjectileHitEvent;
use pocketmine\Player;
use pocketmine\math\{
    Vector3,
    AxisAlignedBB
};
use pocketmine\level\Level;
use pocketmine\level\Explosion;

class CannonSnowball extends Snowball {

    protected function onHit(ProjectileHitEvent $event): void{
        //parent::onHit($event);
        $center = $event->getEntity();
        $explode = new Explosion($center, 5.0);
        $explode->explodeA();
        $explode->explodeB();
    }
    
}