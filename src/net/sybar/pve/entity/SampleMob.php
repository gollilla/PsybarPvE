<?php

namespace net\sybar\pve\entity;

use pocketmine\entity\Entity;
use pocketmine\entity\Human;

class SampleMob extends Human {
    
    private $entityLevel;
    private $isBoss = false;
    private $target;

    public function __construct(){

    }


    public function setSkin(){
        $img = @imagecreatefrompng( $this->getDataFolder() . "images/sample.png" );
        $skinbytes = "";
	    $s = (int)@getimagesize($path)[1];
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
        $this->setSkin(new Skin("sample.skin", $skinbytes, "", "geometry.sample", ""));
        $this->sendSkin();
    }
}