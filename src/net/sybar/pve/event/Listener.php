<?php

namespace net\sybar\pve\event;

use pocketmine\event\Listener as EventListener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\entity\Entity;
use net\sybar\pve\entity\NormalZombie;
use net\sybar\pve\entity\EvocationFang;
use pocketmine\Player;
use net\sybar\pve\weapon\WeaponFactory;

class Listener implements EventListener {

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
    }


    public function onJoin(PlayerMoveEvent $ev)
    {
        $player = $ev->getPlayer();
        $nbt = Entity::createBaseNBT($player->add(1));
        /*$zombie = Entity::createEntity("NormalZombie", $player->getLevel(), $nbt);
        $zombie->getDataPropertyManager()->setString(Entity::DATA_INTERACTIVE_TAG, "発射!!", true);
        $zombie->spawnToAll();
        $railgun = WeaponFactory::get(2);
        $player->getInventory()->addItem($railgun);*/
        $nbt->setInt("Warmup", 0);
        $ev_fang = Entity::createEntity("EvocationFang", $player->getLevel(), $nbt);
        //$ev_fang->setScale(2.0);
        $ev_fang->spawnTo($player);
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