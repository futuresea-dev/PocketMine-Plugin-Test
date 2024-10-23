<?php

declare(strict_types=1);

namespace SavePlayer;

use AssertionError;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class MainClass extends PluginBase implements Listener{
	private string $dbPath;

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->dbPath = $this->getDataFolder() . "players.db";
	}

	public function onPlayerJoin(PlayerJoinEvent $event) : void{
		$player = $event->getPlayer();
		$ip = $player->getNetworkSession()->getIp();
		$username = $player->getName();
		$xuid = $player->getXuid(); // Assumes PocketMine provides this method
		$uuid = $player->getUniqueId()->toString();

		// Create a new task for saving player data
		$saveTask = new SavePlayerDataTask($ip, $username, $xuid, $uuid, $this->dbPath);

		// Execute the task asynchronously
		$this->getScheduler()->scheduleTask($saveTask);
	}

	public function onDisable() : void{

	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		switch($command->getName()){
			case "ping":
				if(!$sender instanceof Player){
					$sender->sendMessage(TextFormat::RED . "This command can only be used in-game.");
					return false;
				}
				// Get player's ping
				$ping = $sender->getNetworkSession()->getPing();

				// Send the ping back to the player
				$sender->sendMessage(TextFormat::GREEN . "Your ping to the server is " . $ping . " ms.");

				return true;
			default:
				throw new AssertionError("This line will never be executed");
		}
	}
}
