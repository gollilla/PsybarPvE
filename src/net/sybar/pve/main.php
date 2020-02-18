<?php

namespace net\sybar\pve;

use pocketmine\plugin\PluginBase;
use net\sybar\pve\weapon\WeponFactory;

class main extends PluginBase {

    public static $instance = null;

    public function onEnable(){
        WeponFactory::init();
        self::$instance = $this;
        $this->saveResource("exp_tbl.json");
    }

    public static function getInstance(): PluginBase
    {
        return self::$instance;
    }

    public function onDisable(){
        
    }
}

