<?php

namespace net\sybar\pve;

use pocketmine\plugin\PluginBase;
use pocketmine\entity\Entity;
use net\sybar\pve\weapon\WeaponFactory;
use net\sybar\pve\event\Listener;
use net\sybar\pve\entity\NormalZombie;
use net\sybar\pve\entity\EvocationFang;
use net\sybar\pve\entity\Cannon;
use net\sybar\pve\entity\projectile\CannonSnowball;

class main extends PluginBase {

    public static $instance = null;

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents(new Listener($this), $this);
        WeaponFactory::init();
        Entity::registerEntity(NormalZombie::class, false, ['NormalZombie', 'minecraft:zombie']);
        Entity::registerEntity(EvocationFang::class, false, ['EvocationFang', 'minecraft:evocation_fang', 'evocation_fang']);
        Entity::registerEntity(Cannon::class, true);
        Entity::registerEntity(CannonSnowball::class, true);
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
        $this->saveResource("images/taihou.json");
        $this->saveResource("images/Kotei_taihou.png");
    }
}

