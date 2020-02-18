<?php

namespace net\sybar\pve;

use pocketmine\plugin\PluginBase;
use net\sybar\pve\weapon\WeaponFactory;

class main extends PluginBase {

    public static $instance = null;

    public function onEnable(){
        WeaponFactory::init();
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

