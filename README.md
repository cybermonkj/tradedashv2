core/airdrop-bot bot is a telegram bot running on Python3. It uses the python wrapper python-telegram-bot. Tested on Ubuntu 18.04 without any issues.

Installation Instructions:

    $ apt-get update && apt-get install python-pip3
	pip3 install -r requirements.txt

For more details on the wrapper used, as well as the Telegram API, please see: https://github.com/python-telegram-bot/python-telegram-bot



core/ERC2TOKEN.sol is a smart contract for Tradepander Coin






THE REST OF THE PROJECT
##Requirements

                                            PHP Version 7.3 and above
                                            Curl Library
After Git clone, ON Windows: Go to htdocs folder, Git clone this repository

Note: Tradepander won't work on sub directory e.g http://localhost:8080/tradedashv2. You should cut contents of the cloned folder out to htdocs folder then begin setup

After that, Go to your phpMyadmin or any other databse client and create a new user giving it all required permissions minus admin permissions. Then create a New Database under that account.

Import the Database.sql file you'll find at the root of this Project Repository (This creates the basic Database Structure the App works with)

Refer to this video on creating and importing a database with phpmyadmin (As the Process is exclusively similer)



Once done with the Database creation and importation

The next step is to connect the app to the setup database

Remember, we have created and imported the database file. We also have the database details saved somewhere.

Open the .env file located in the "core" folder

##Enter Database Details:

Locate this line of code and enter your database information as needed. and please gitignore your own copy of the .env file

DB_CONNECTION=mysql DB_HOST=localhost DB_PORT=3306 DB_DATABASE=database name DB_USERNAME=database user DB_PASSWORD=database password

Thats it. Trade pander is ready to run live on your local Server, Just restart your apache server and Mysql/mariadb Server just to avoid complications then its accessible from https://localhost:(Your Port number)/

Accessing Admin Area: Follow the route https://localhost:(Your Port Number)/back-end
