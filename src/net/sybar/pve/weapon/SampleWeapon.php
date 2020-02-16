<?php 

namespace net\sybar\pve\weapon;

use pocketmine\item\Sword;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\Player;
use pocketmine\entity\Entity;
use net\sybar\pve\mob\Mob;

class SampleWeapon extends Item implements Weapon {

    public function getName(){
        return "SampleWeapon";
    }

    public function onAttackEntity(EntityDamageEvent $ev){
        //parent::onAttackEntity($ev->getEntity());
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