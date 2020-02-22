<?php

namespace net\sybar\pve;

use pocketmine\plugin\PluginBase;
use pocketmine\entity\Entity;
use net\sybar\pve\weapon\WeaponFactory;
use net\sybar\pve\event\Listener;
use net\sybar\pve\entity\NormalZombie;

class main extends PluginBase {

    public static $instance = null;

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents(new Listener($this), $this);
        WeaponFactory::init();
        Entity::registerEntity(NormalZombie::class, false, ['NormalZombie', 'minecraft:zombie']);
    }

    public static function getInstance(): PluginBase
    {
        return self::$instance;
    }

    public function onDisable(){
        
    }

    public function onLoad(){
        self::$instance = $this;
        $this->saveResource("exp_tbl.json");
    }
}

