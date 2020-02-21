<?php

use net\sybar\pve\event;
use pocketmine\event\Listener as EventListener;

class Listener implements EventListener {

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
    }
}