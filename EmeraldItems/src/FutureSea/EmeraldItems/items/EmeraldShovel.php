<?php

namespace FutureSea\EmeraldItems\items;

use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Shovel;
use pocketmine\item\ToolTier;


class EmeraldShovel extends Shovel implements ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $itemIdentifier, string $name){
		parent::__construct($itemIdentifier, $name, ToolTier::NETHERITE);
		$this->initComponent("emerald_shovel", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_SHOVEL));
		$this->addComponent(new HandEquippedComponent(true));
		$this->addComponent(new MaxStackSizeComponent(1));
	}

	public function getAttackPoints() : int{
		return 5;
	}
}
