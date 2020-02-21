<?php

namespace net\sybar\pve;

use pocketmine\plugin\PluginBase;
use net\sybar\pve\weapon\WeaponFactory;
use net\sybar\pve\event\Listener;

class main extends PluginBase {

    public static $instance = null;

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents(new Listener($this), $this);
        WeaponFactory::init();
        MobFactory::init();
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

