<?php

namespace net\sybar\pve\entity;

use pocketmine\entity\Entity;

class EvocationFang extends Entity {
    public const NETWORK_ID = self::EVOCATION_FANG;

    public $width = 0.6;
    public $height = 0.9;
    
    public function getName(): string{
        return "evocation fang";
    }


    public function getDrops(): array{
        return [];
    }

    public function getXpDropAmount(): int{
        return 0;
    }
}