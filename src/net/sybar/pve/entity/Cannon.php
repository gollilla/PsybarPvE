<?php

namespace net\sybar\pve\entity;

use pocketmine\entity\Entity;
use pocketmine\entity\projectile\Projectile;
use pocketmine\entity\Human;
use pocketmine\entity\Skin;
use pocketmine\event\entity\EntityShootBowEvent;
use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\Player;
use pocketmine\utils\UUID;
use pocketmine\level\Level;
use pocketmine\nbt\tag\CompoundTag;
use net\sybar\pve\main;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\math\Vector3;

class Cannon extends Human {
    
    public $plugin;
    public $width = 0.6;
    public $height = 0.6;
    public $eyeHeight = 0.3;
    public $count = 0;
    public function __construct(Level $level, CompoundTag $nbt){
        $this->plugin = main::getInstance();
        $this->server = $this->plugin->getServer();
        $this->uuid = UUID::fromRandom();
        @$this->iniSkin();
        parent::__construct($level, $nbt);
        $this->setScale(2.0);
        $this->setRotation(50, $this->pitch);
        $this->setNameTag("§e大砲君 : " . $this->yaw);
        $this->setNameTagAlwaysVisible();
        $this->setImmobile();
    }

    /*public function entityBaseTick(int $tickDiff = 1) : bool{
        //
        return false;
    }*/

    public function iniSkin(){
        $img = @imagecreatefrompng($this->plugin->getDataFolder() . "images/taihou.png");
        $skinbytes = "";
        $s = (int)@getimagesize($this->plugin->getDataFolder() . "images/taihou.png")[1];
        for($y = 0; $y < $s; $y++){
            for($x = 0; $x < 64; $x++){
                $colorat = @imagecolorat($img, $x, $y);
                $a = ((~((int)($colorat >> 24))) << 1) & 0xff;
                $r = ($colorat >> 16) & 0xff;
                $g = ($colorat >> 8) & 0xff;
                $b = $colorat & 0xff;
                $skinbytes .= chr($r) . chr($g) . chr($b) . chr($a);
            }
        }
        @imagedestroy($img);
        $this->setSkin(new Skin("Standard_CustomSlim", $skinbytes, "", "geometry.taihou", file_get_contents($this->plugin->getDataFolder() . "images/taihou.json")));
        $this->sendSkin();
    }

    public function fire(){
        $nbt = Entity::createBaseNBT($this->add(0, 0.4 * 2, 0), $this->getDirectionVector(), $this->yaw-50, 45.0);
        $projectile = Entity::createEntity("CannonSnowball", $this->getLevel(), $nbt, $this);
        if($projectile !== null){
			$projectile->setMotion($projectile->getMotion()->multiply(1.5));
        }
        $projectile->spawnToAll();
    }


    public function attack(EntityDamageEvent $ev): void{
        $this->fire();
        /*$pl = $ev->getDamager();*/
        $this->setRotation($this->count++ * 90 + 50, $this->pitch);
        $this->setNameTag("§e大砲君 : " . $this->yaw);
        $ev->setCancelled();
    }

    public function getDirectionVector() : Vector3{
		$y = -sin(deg2rad(-15.0));
		$xz = cos(deg2rad(-15.0));
		$x = -$xz * sin(deg2rad($this->yaw-50));
		$z = $xz * cos(deg2rad($this->yaw-50));

		return $this->temporalVector->setComponents($x, $y, $z)->normalize();
	}

}