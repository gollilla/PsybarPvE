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
use net\sybar\pve\entity\Cannon;
use pocketmine\Player;
use net\sybar\pve\weapon\WeaponFactory;

class Listener implements EventListener {

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
    }


    public function onJoin(PlayerJoinEvent $ev)
    {
        $player = $ev->getPlayer();
        foreach($player->getLevel()->getEntities() as $e){
            if($e instanceof Cannon){
                $e->kill();
            }
        }
        $nbt = Entity::createBaseNBT($player);
        /*$zombie = Entity::createEntity("NormalZombie", $player->getLevel(), $nbt);
        $zombie->getDataPropertyManager()->setString(Entity::DATA_INTERACTIVE_TAG, "発射!!", true);
        $zombie->spawnToAll();
        $railgun = WeaponFactory::get(2);
        $player->getInventory()->addItem($railgun);*/
        //$nbt->setInt("Warmup", -21);
        //$nbt->setString("Owner", $player->getName());
        //$ev_fang = Entity::createEntity("EvocationFang", $player->getLevel(), $nbt);
        //$ev_fang->getDataPropertyManager()->setInt(, -10, true);
        //$ev_fang->setScale(2.0);
        //$ev_fang->spawnToAll();
        $cannon = Entity::createEntity("Cannon", $player->getLevel(), $nbt);
        //$cannon->iniSkin();
        $cannon->spawnToAll();
    }

    public function onMove(PlayerMoveEvent $ev){
        $player = $ev->getPlayer();
        $player->sendTip("yaw" . $player->yaw);
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