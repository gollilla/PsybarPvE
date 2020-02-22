<?php

namespace net\sybar\pve\event;

use pocketmine\event\Listener as EventListener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\entity\Entity;
use net\sybar\pve\entity\NormalZombie;
use pocketmine\Player;

class Listener implements EventListener {

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
    }


    public function onJoin(PlayerJoinEvent $ev)
    {
        $player = $ev->getPlayer();
        $nbt = Entity::createBaseNBT($player);
        $zombie = Entity::createEntity("NormalZombie", $player->getLevel(), $nbt);
        $zombie->spawnToAll();
    }

    public function onDamage(EntityDamageEvent $ev)
    {
        $entity = $ev->getEntity();
        //var_dump($entity);
        if($ev instanceof EntityDamageByEntityEvent)
        {
            $damager = $ev->getDamager();
            if($damager instanceof Player)
            {
                //echo "w", PHP_EOL;
                if($entity instanceof NormalZombie)
                {
                    //echo "ww", PHP_EOL;
                    if(!$entity->hasTarget()){
                        //echo "www", PHP_EOL;
                        $entity->setTarget($damager);
                    }  
                }
            }
        }
    }
}