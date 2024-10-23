<?php

declare(strict_types=1);

namespace FutureSea\EmeraldItems;


use customiesdevs\customies\item\CustomiesItemFactory;
use FutureSea\EmeraldItems\items\EmeraldAxe;
use FutureSea\EmeraldItems\items\EmeraldHoe;
use FutureSea\EmeraldItems\items\EmeraldPickAxe;
use FutureSea\EmeraldItems\items\EmeraldShovel;
use FutureSea\EmeraldItems\items\EmeraldSword;
use pocketmine\plugin\PluginBase;


class Loader extends PluginBase{

	public function onEnable() : void{
//		$this->saveResource("EmeraldResources.mcpack");
		CustomiesItemFactory::getInstance()->registerItem(EmeraldSword::class, "custom:emerald_sword", "Emerald Sword");
		CustomiesItemFactory::getInstance()->registerItem(EmeraldAxe::class, "custom:emerald_axe", "Emerald Axe");
		CustomiesItemFactory::getInstance()->registerItem(EmeraldPickAxe::class, "custom:emerald_pickaxe", "Emerald Pickaxe");
		CustomiesItemFactory::getInstance()->registerItem(EmeraldShovel::class, "custom:emerald_shovel", "Emerald Shovel");
		CustomiesItemFactory::getInstance()->registerItem(EmeraldHoe::class, "custom:emerald_hoe", "Emerald Hoe");
	}

}
