##Requirements

                                                PHP Version 7.3 and above
                                                Curl Library
##





After Git clone, 
ON Windows: Go to htdocs folder, Git clone this repository

Note: Tradepander won't work on sub directory e.g http://localhost:8080/tradedashv2.
You should cut contents of the cloned folder out to htdocs folder then begin setup 


After that, Go to your phpMyadmin or any other databse client and create a new user giving it all required permissions minus admin permissions.
Then create a New Database under that account.

Import the Database.sql file you'll find at the root of this Project Repository (This creates the basic Database Structure the App works with)


Refer to this video on creating and importing a database with phpmyadmin (As the Process is exclusively similer)
<p><a href="https://maxprofit.mcode.me/docs/?wvideo=ow76u4kdq0"><img src="https://embed-fastly.wistia.com/deliveries/8a38edf65a185c0d0264c16773c49b1112cd4a41.jpg?image_play_button_size=2x&amp;image_crop_resized=960x395&amp;image_play_button=1&amp;image_play_button_color=1e71e7e0" width="400" height="165" style="width: 400px; height: 165px;"></a></p>

Once done with the Database creation and importation

The next step is to connect the app to the setup database

 Remember, we have created and imported the database file. We also have the database details saved somewhere.

Open the .env file located in the "core" folder 

##Enter Database Details:

Locate this line of code and enter your database information as needed. and please gitignore your own copy of the .env file

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=database name
DB_USERNAME=database user
DB_PASSWORD=database password


Thats it. Trade pander is ready to run live on your local Server, Just restart your apache server and Mysql/mariadb Server just to avoid complications then its accessible from https://localhost:(Your Port number)/




