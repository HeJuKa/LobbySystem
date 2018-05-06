<?php

namespace VL;
use VL\LobbyItems;
use VL\TypeType;
use VL\FlameParticle;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\PluginTask;
use pocketmine\plugin\Plugin;
use pocketmine\block\Block;
use pocketmine\level\Level;
use pocketmine\utils\TextFormat;
use pocketmine\item\Item;
use pocketmine\entity\Item as ItemEntity;
use pocketmine\math\Vector3;
use pocketmine\math\Vector2;
use pocketmine\level\Location;
use pocketmine\level\particle\BubbleParticle;
use pocketmine\level\particle\ExplodeParticle;
use pocketmine\level\particle\HeartParticle;
use pocketmine\level\particle\HugeExplodeParticle;
use pocketmine\level\Position;
use pocketmine\level\particle\DustParticle;
use pocketmine\level\particle\FlameParticle;
use pocketmine\level\particle\RedstoneParticle;
use pocketmine\level\particle\LavaParticle;
use pocketmine\level\particle\PortalParticle;
use pocketmine\level\sound\PopSound;
use pocketmine\level\sound\GhastSound;

class ItemsLoad extends PluginTask {
	
	public function __construct(LobbyItems $plugin) {
        $this->plugin = $plugin;
        parent::__construct($plugin);
    }
    public function onRun($currentTick) {
		
		foreach($this->plugin->getServer()->getOnlinePlayers() as $player) {
			$name = $player->getName();
			$inv = $player->getInventory();
			
			$players = $player->getLevel()->getPlayers();
			$level = $player->getLevel();
			
			$x = $player->getX();
			$y = $player->getY() + 2;
			$z = $player->getZ();
			
			foreach($players as $play) {
				if(in_array($name, $this->plugin->showall)) {
					
					$player->showPlayer($play);
					
				} elseif(in_array($name, $this->plugin->showvips)) {
					
					if($play->hasPermission("lobby.see.vip")) {
						
						$player->showPlayer($play);
						
					} else {
						
						$player->hidePlayer($play);
						
					}
					
				} elseif(in_array($name, $this->plugin->shownone)) {
					
					$player->hidePlayer($play);
					
				}
				
			}
			
			// rot
			if(in_array($name, $this->plugin->particle1)) {
				
				$r = 255;
				$g = 0;
				$b = 0;
				
				$center = new Vector3($x, $y, $z);
				$particle = new DustParticle($center, $r, $g, $b, 1);
				
				for($yaw = 0;  $yaw <= 10; $yaw += (M_PI * 2) / 20){
					$x = -sin($yaw) + $center->x;
					$z = cos($yaw) + $center->z;
					$y = $center->y;
					
					$particle->setComponents($x, $y, $z);
					$level->addParticle($particle);
						
				}
				
			}
			//gelb
			if(in_array($name, $this->plugin->particle2)) {
				
				$r = 255;
				$g = 255;
				$b = 0;
				
				$center = new Vector3($x, $y, $z);
				$particle = new DustParticle($center, $r, $g, $b, 1);
				
				for($yaw = 0;  $yaw <= 10; $yaw += (M_PI * 2) / 20){
					$x = -sin($yaw) + $center->x;
					$z = cos($yaw) + $center->z;
					$y = $center->y;
					
					$particle->setComponents($x, $y, $z);
					$level->addParticle($particle);
						
				}
			}
			//gruen
			if(in_array($name, $this->plugin->particle3)) {
				
				$r = 0;
				$g = 255;
				$b = 0;
				
				$center = new Vector3($x, $y, $z);
				$particle = new DustParticle($center, $r, $g, $b, 1);
				
				for($yaw = 0;  $yaw <= 10; $yaw += (M_PI * 2) / 20){
					$x = -sin($yaw) + $center->x;
					$z = cos($yaw) + $center->z;
					$y = $center->y;
					
					$particle->setComponents($x, $y, $z);
					$level->addParticle($particle);
						
				}
			}
			//blau
			if(in_array($name, $this->plugin->particle4)) {
				
				$r = 0;
				$g = 0;
				$b = 255;
				
				$center = new Vector3($x, $y, $z);
				$particle = new DustParticle($center, $r, $g, $b, 1);
				
				for($yaw = 0;  $yaw <= 10; $yaw += (M_PI * 2) / 20){
					$x = -sin($yaw) + $center->x;
					$z = cos($yaw) + $center->z;
					$y = $center->y;
					
					$particle->setComponents($x, $y, $z);
					$level->addParticle($particle);
						
				}
				
			}
			//orange
			if(in_array($name, $this->plugin->particle5)) {
				
				$r = 255;
				$g = 165;
				$b = 0;
				
				$center = new Vector3($x, $y, $z);
				$particle = new DustParticle($center, $r, $g, $b, 1);
				
				for($yaw = 0;  $yaw <= 10; $yaw += (M_PI * 2) / 20){
					$x = -sin($yaw) + $center->x;
					$z = cos($yaw) + $center->z;
					$y = $center->y;
					
					$particle->setComponents($x, $y, $z);
					$level->addParticle($particle);
						
				}
				
			}
			
			if(in_array($name, $this->plugin->particle6)) {
				$x = $player->getX();
				$y = $player->getY();
				$z = $player->getZ();
				
				$center = new Vector3($x, $y, $z);
				
				for($yaw = 0;  $yaw <= 10; $yaw += (M_PI * 2) / 10){
					$x = -sin($yaw) + $center->x;
					$z = cos($yaw) + $center->z;
					$y = $center->y;
					
					$level->addParticle(new FlameParticle(new Vector3($x, $y + 1.5, $z)));
						
				}
				
				
			}
			
			//Boots
			if(in_array($name, $this->plugin->heart)) {
				
				$player->getLevel()->addParticle(new HeartParticle(new Vector3($player->getX(), $player->getY() + 0.4, $player->getZ())), $players);
				$effect = Effect::getEffect(10);
				$effect->setDuration(999);
				$effect->setAmplifier(1);
				$effect->setVisible(false);
				
				$inv->setBoots(Item::get(301, 0, 1));
				
				$player->addEffect($effect);
				
			}
			
			if(in_array($name, $this->plugin->jump)) {
				
				//$player->getLevel()->addParticle(new LavaParticle(new Vector3($player->getX(), $player->getY() + 0.5, $player->getZ())), $players);
				$effect = Effect::getEffect(8);
				$effect->setDuration(999);
				$effect->setAmplifier(1);
				$effect->setVisible(false);
				
				$inv->setBoots(Item::get(317, 0, 1));
				
				$player->addEffect($effect);
				
			}
			
			if(in_array($name, $this->plugin->speed)) {
				
				//$player->getLevel()->addParticle(new ExplodeParticle(new Vector3($player->getX(), $player->getY() + 0.5, $player->getZ())), $players);
				$effect = Effect::getEffect(1);
				$effect->setDuration(999);
				$effect->setAmplifier(3);
				$effect->setVisible(false);
				
				$inv->setBoots(Item::get(309, 0, 1));
				
				$player->addEffect($effect);
				
			}
			
			if(in_array($name, $this->plugin->water)) {
				
				$player->getLevel()->addParticle(new HugeExplodeParticle(new Vector3($player->getX(), $player->getY() + 1, $player->getZ())), $players);
				$effect = Effect::getEffect(13);
				$effect->setDuration(999);
				$effect->setAmplifier(1);
				$effect->setVisible(false);
				
				$inv->setBoots(Item::get(313, 0, 1));
				
				$player->addEffect($effect);
				
			}
			
		}
		
	}
	
}
