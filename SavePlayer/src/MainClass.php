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

	// Function to flatten a multi-dimensional array
// Function to flatten a multi-dimensional array
	private function flattenArray(array $array) : array {
		$flattened = [];

		array_walk($array, function($value) use (&$flattened) {
			if (is_array($value)) {
				// If the value is an array, recursively flatten it
				$flattened = array_merge($flattened, $this->flattenArray($value));
			} elseif (is_object($value)) {
				// Convert object to a string or skip it based on your requirements
				// Here, you might want to use a specific property or method of the object
				// You could also use print_r or var_export for debugging purposes
				$flattened[] = (method_exists($value, '__toString') ? (string)$value : json_encode($value));
			} else {
				// Otherwise, add the value to the flattened array
				$flattened[] = (string)$value; // Cast to string if needed
			}
		});

		return $flattened;
	}
	public function onPlayerJoin(PlayerJoinEvent $event) : void{
		$player = $event->getPlayer();
		$ip = $player->getNetworkSession()->getIp();
		$username = $player->getName();
		$xuid = $player->getXuid(); // Assumes PocketMine provides this method
		$uuid = $player->getUniqueId()->toString();
		// Get the extra data
		$extraData = $player->getPlayerInfo()->getExtraData();

		// Flatten the multi-dimensional array to a one-dimensional array
		$flattenedData = $this->flattenArray($extraData);

		// Convert the flattened array to a string
		$data = implode(", ", $flattenedData);

		// Create a new task for saving player data
		$saveTask = new SavePlayerDataTask($ip, $username, $xuid, $uuid, $data, $this->dbPath);

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
