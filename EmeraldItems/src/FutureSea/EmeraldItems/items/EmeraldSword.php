<?php

namespace FutureSea\EmeraldItems\items;

use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;

class EmeraldSword extends Sword implements ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $itemIdentifier, string $name){
		parent::__construct($itemIdentifier, $name, ToolTier::NETHERITE);
		$this->initComponent("emerald_sword", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_SWORD));
		$this->addComponent(new HandEquippedComponent(true));
		$this->addComponent(new MaxStackSizeComponent(1));
	}

	public function getAttackPoints() : int{
		return 8;
	}
}
