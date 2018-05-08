<?php
namespace VL;
use VL\LobbyItems;
use VL\ItemsLoad;
use VL\FlameParticle;
use VL\RedstoneParticle;

use pocketmine\scheduler\PluginTask;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\entity\Effect;
use pocketmine\entity\Entity;
use pocketmine\utils\Config;
use pocketmine\block\Block;
use pocketmine\level\Level;
use pocketmine\utils\TextFormat;
use pocketmine\item\Item;
use pocketmine\entity\Item as ItemEntity;
use pocketmine\math\Vector3;
use pocketmine\math\Vector2;

class TypeType extends PluginTask {
	
	public function __construct(LobbyItems $plugin) {
        $this->plugin = $plugin;
        parent::__construct($plugin);
		
		$this->time1 = 0;
		$this->time2 = 0;
		
    }
    public function onRun($currentTick) {
		
		$level = $this->plugin->getServer()->getDefaultLevel();
		
		$center1 = new Vector3(260.5, 6.5, 238.5);
		$center2 = new Vector3(260.5, 6.5, 270.5);
		
		$config = new Config($this->plugin->getDataFolder() . "config.yml", Config::YAML);
		
		if(!$config->get("OpenChest1")) {
			for($yaw = 0;  $yaw <= 10; $yaw += (M_PI * 2) / 20){
				$x = -sin($yaw) + $center1->x;
				$z = cos($yaw) + $center1->z;
				$y = $center1->y;
				
				$level->addParticle(new FlameParticle(new Vector3($x, $y, $z)));
			}
		} else {
			if($this->time1 == 4) {
				$this->time1 = 0;
			}
			
			$this->time1++;
			
			if($this->time1 < 4) {
				
				for($yaw = 0;  $yaw <= 10; $yaw += (M_PI * 2) / 20){
					$x = -sin($yaw) + $center1->x;
					$z = cos($yaw) + $center1->z;
					$y = $center1->y;
					
					$level->addParticle(new RedstoneParticle(new Vector3($x, $y, $z)));
					
				}
				
			} else {
				
				for($yaw = 0;  $yaw <= 10; $yaw += (M_PI * 2) / 20){
					$x = -sin($yaw) + $center1->x;
					$z = cos($yaw) + $center1->z;
					$y = $center1->y;
					
					$level->addParticle(new RedstoneParticle(new Vector3($x, $y + 1, $z)));
					
				}
				
				$config->set("OpenChest1", true);
				$config->save();
				
			}
			
		}
		
		if(!$config->get("OpenChest2")) {
			for($yaw = 0;  $yaw <= 10; $yaw += (M_PI * 2) / 20){
				$x = -sin($yaw) + $center2->x;
				$z = cos($yaw) + $center2->z;
				$y = $center2->y;
				
				$level->addParticle(new FlameParticle(new Vector3($x, $y, $z)));
			}
		} else {
			if($this->time2 == 4) {
				$this->time2 = 0;
			}
			
			$this->time2++;
			
			if($this->time2 < 4) {
				
				for($yaw = 0;  $yaw <= 10; $yaw += (M_PI * 2) / 20){
					$x = -sin($yaw) + $center2->x;
					$z = cos($yaw) + $center2->z;
					$y = $center2->y;
					
					$level->addParticle(new RedstoneParticle(new Vector3($x, $y, $z)));
					
				}
				
			} else {
				
				for($yaw = 0;  $yaw <= 10; $yaw += (M_PI * 2) / 20){
					$x = -sin($yaw) + $center2->x;
					$z = cos($yaw) + $center2->z;
					$y = $center2->y;
					
					$level->addParticle(new RedstoneParticle(new Vector3($x, $y + 1, $z)));
					
				}
				
				$config->set("OpenChest2", false);
				$config->save();
				
			}
			
		}
		
	}
	
}
