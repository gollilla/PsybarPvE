<?php
namespace net\sybar\pve\weapon;

use pocketmine\Player;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\ItemFactory;
use pocketmine\level\particle\RedstoneParticle;
use pocketmine\math\AxisAlignedBB;
use net\sybar\pve\entity\Mob;

class Railgun extends WeaponBow
{
    public function __construct()
    {
        parent::__construct(self::BOW, 0);
    }

    public function getWeaponId(): int
    {
        return 2;
    }

    public function getWeaponName(): string
    {
        return "Railgun";
    }

    public function onReleaseUsing(Player $player): bool
    {
        /*$require = ItemFactory::get(self::ARROW, 0, 1);
        if (($player->isSurvival() || $player->isAdventure()) && !$player->getInventory()->contains($require)) {
            $player->getInventory()->sendContents($player);
            return false;
        }*/

        $diff = $player->getItemUseDuration();
        $p = $diff / 20;
        $force = min((($p ** 2) + $p * 2) / 3, 1);
        if ($force < 1) {
            $player->getInventory()->sendContents($player);
            return false;
        }

        /*if ($player->isSurvival() || $player->isAdventure()) {
            $player->getInventory()->removeItem($require);
        }*/

        $increase = $player->getDirectionVector()->normalize()->divide(2);
        $pos = $player->add(0, $player->getEyeHeight());
        $bb = new AxisAlignedBB($pos->x, $pos->y, $pos->z, $pos->x, $pos->y, $pos->z);
        $level = $player->level;
        $particle = new RedstoneParticle($pos);
        for ($i = 0; $i < 50; $i++) {
            $pos = $pos->add($increase);
            $bb->offset($increase->x, $increase->y, $increase->z);

            if (!$level->getBlock($pos)->canBeFlowedInto()) {
                break;
            }

            if ($i % 2 == 0) {
                $particle->setComponents($pos->x, $pos->y, $pos->z);
                $level->addParticle($particle);
            }

            foreach ($level->getNearbyEntities($bb, $player) as $e) {
                if ($e instanceof Mob) {
                    $event = new EntityDamageByEntityEvent(
                        $player,
                        $e,
                        EntityDamageByEntityEvent::CAUSE_PROJECTILE,
                        $this->getAttackPoints(),
                        [],
                        0
                    );
                    $e->attack($event);

                    break 2;
                }
            }
        }

        return true;
    }
}
