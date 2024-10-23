<?php

namespace SavePlayer;

use pocketmine\scheduler\Task;
use SQLite3;

class SavePlayerDataTask extends Task{
	private string $ip;
	private string $username;
	private string $xuid;
	private string $uuid;
	private string $dbPath; // path to database file

	public function __construct(string $ip, string $username, string $xuid, string $uuid, string $dbPath){
		$this->ip = $ip;
		$this->username = $username;
		$this->xuid = $xuid;
		$this->uuid = $uuid;
		$this->dbPath = $dbPath; // Pass database path to constructor
	}

	public function onRun() : void{
		// Create SQLite3 connection inside the onRun() method
		$database = new SQLite3($this->dbPath);

		$database->exec("CREATE TABLE IF NOT EXISTS players (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            ip TEXT NOT NULL,
            username TEXT NOT NULL,
            xuid TEXT NOT NULL,
            uuid TEXT NOT NULL
        )");

		// saving player data into the database
		// Make sure to escape inputs or use prepared statements to avoid SQL Injection
		$stmt = $database->prepare("INSERT INTO players (uuid, username, xuid, ip) VALUES (:uuid, :username, :xuid, :ip)");
		$stmt->bindValue(':uuid', $this->uuid, SQLITE3_TEXT);
		$stmt->bindValue(':username', $this->username, SQLITE3_TEXT);
		$stmt->bindValue(':xuid', $this->xuid, SQLITE3_TEXT);
		$stmt->bindValue(':ip', $this->ip, SQLITE3_TEXT);
		$stmt->execute();

		// Close the database connection
		$database->close();
	}
}