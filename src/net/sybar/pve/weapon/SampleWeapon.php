<?php
namespace net\sybar\pve\weapon;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\Player;
use pocketmine\entity\Entity;
use net\sybar\pve\mob\Mob;

class SampleWeapon extends WeaponSword
{
    public function getName(): string
    {
        return "SampleWeapon";
    }

    public function getWeaponId(): int
    {
        return 1;
    }

    public function onAttack(EntityDamageEvent $ev)
    {
        $damager = $ev->getDamager();
        $entity = $ev->getEntity();
        if ($entity instanceof Player) {
            if ($damager instanceof Player) {
                $ev->setCancelled();
                return;
            }
            if ($damager instanceof Mob) {
                $ev->setBaseDamage();
            }
        }
    }
}
