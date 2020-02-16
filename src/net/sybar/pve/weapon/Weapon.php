<?php

namespace net\sybar\pve\weapon;

interface Weapon {
    function getXp();
    function addXp();
    function calcLevel();
}