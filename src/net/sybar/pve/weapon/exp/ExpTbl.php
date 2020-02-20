<?php

namespace net\sybar\pve\weapon\exp;
use net\sybar\pve\weapon\Weapon;
use net\sybar\pve\main as Plugin;

class ExpTbl {

    function __construct(Weapon $wepon)
    {
        $path = Plugin::getInstance()->getDataFolder() . "exp_tbl.json";
        $this->json = json_decode(\file_get_contents($path), true);
    }

    public function getLevel($xp): int
    {
        foreach($this->json as $data){
            if(isset($data["max"]) && isset($data["min"]) && isset($data["lv"])){
                $max = $data["max"];
                $min = $data["min"];
                if($min <= $xp && $xp <= $max)
                    return $data["lv"];
            }
        }
        return -1;
    }
}