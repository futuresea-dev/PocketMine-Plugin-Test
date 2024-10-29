# PocketMine Plugin

## Overview

This is a custom PocketMine plugin that enhances a Minecraft server's functionality by saving player data to a SQLite database upon login. Additionally, it includes a /ping command to provide players with their internet ping. The plugin also introduces a fully functional set of custom items, including a sword, axe, pickaxe, shovel, and hoe, utilizing existing Minecraft textures.

## Features

- Player Data Storage: Automatically saves player information to an SQLite database (players.db) when they join the server, including:
  - Username
  - XUID
  - UUID
  - IP Address
  - Additional relevant data
 
- Ping Command: Players can check their internet ping using the /ping command.
  
- Custom Items: Implemented five models with existing Minecraft textures:
  - Sword
  - Axe
  - Pickaxe
  - Shovel
  - Hoe

## Installation

1. Download the Plugin: Clone or download this repository.

   git clone https://github.com/futuresea-dev/PocketMine-Plugin-Test.git

2. Copy to PocketMine Plugins Directory: Place the plugin folder located in the src directory into the plugins directory of your PocketMine server.

   pocketmine/plugins/PocketMineTechnicalTest

3. Install Dependencies: Ensure that your PocketMine server is set up correctly, with all required dependencies installed.

4. Configure the Database: Ensure the SQLite database file (players.db) has the correct permissions set for the PocketMine server to read/write.

## Usage

### Player Login

Upon joining the server, the plugin will automatically save the player's data into the players.db. You can check the database file to confirm:

SELECT * FROM players;

### Ping Command

Players can check their current internet ping by typing /ping in the chat. The command will return their latency to the server.

### Custom Items

Players can use the following commands to obtain the custom items:

- /give <username> custom:emerald_sword
- /give <username> custom:emerald_axe
- /give <username> custom:emerald_pickaxe
- /give <username> custom:emerald_shovel
- /give <username> custom:emerald_hoe

### Example Usage

1. Join the server and check the console for confirmation that your data has been saved.
2. Use the /ping command to see your current ping.
3. Use the /give commands to obtain the custom items.

## Customization

You can easily modify the database schema or the commands as needed. Make sure to review the source code for adjustments to player data or custom item properties.

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Contributing

Feel free to fork this repository, submit issues, or propose enhancements. Contributions are welcome!

## Acknowledgments

- Special thanks to the PocketMine community for their support and documentation.
- Inspiration from Minecraft's unique item system.
