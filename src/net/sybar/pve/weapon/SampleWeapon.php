<?php 

namespace net\sybar\pve\weapon;


use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\Player;
use pocketmine\entity\Entity;
use net\sybar\pve\mob\Mob;

class SampleWeapon extends WeaponSword {

    public function getName(){
        return "SampleWeapon";
    }

    public function onAttack(EntityDamageEvent $ev){
        $damager = $ev->getDamager();
        $entity = $ev->getEntity();
        if($entity instanceof Player){
            if($damager instanceof Player){
                $ev->setCancelled();
                return;
            }
            if($damager instanceof Mob){
                $ev->setBaseDamage();
            }
        }
    }
}