# Fortnite-Leaderboard-System

![alt text](https://i.imgur.com/QDH5erb.png)
![alt text](https://i.imgur.com/2laKS4W.png)

This is a customisable leaderboard system for Fortnite LANs/events. I originally made it for running competitions at a gaming cafe, however figuired it could be useful to other people. This leaderboard works off number of kills, and placement per game, to give the player a score. Note: solos, duos, trios and squads can all be placed on the same leaderboard, as the system will take number of players into consideration.

The system works by you first altering the settings to your requirements, then by the use of multiple functions displayed to you on the admin panel page. 

It is designed around manual data input, meaning it doesn't use an API to grab scores from players and update the leaderboard, as it is made as a tool for fun local tourneys, and this would prohibit it's flexibility.

In the future, I plan to branch out the system to be able to manage any game you desire, allowing you to customise the look of the leaderboard, and the data that gets displayed onto it.

## How to set it up
The leaderboard uses an admin login system, in order to access the admin panel, therefore it can be deployed on any live webiste without security worries. However, this means you must have access to an sql database in order to set it up. Check out Wamp for a free local deployment, including an sql database (http://www.wampserver.com/en/). 

I have made a copy of the database and table configuration in the sql file named 'aeropath_leaderboard.sql' (found in the root), you'll need to import this into your database for functionality (I recommend using phpmyadmin for ease of use). This contains one user account with the details:
* username: admin
* password: fortnite

Note all passwords are encrypted with phps password_hash function, therefore if you wish to create a new password, use http://www.passwordtool.hu/php5-password-hash-generator to create your hash, and fill it in the password field of the user table.

If the website is now deployed, to either wamp or a live webserver, and the database is configuired properly, you now need to go to the file admin/includes/settings.php to enter your database's details. The variables to be filled are very self explanitory.

After full deployment is complete, you should now be able to login using one of the user accounts, and see the admin panel.

## How to use it
The system is extremely simple to use.

### Step 1.
Customise the settings to your requirement. There are two different modes currently available, tournament mode and party mode. Tournament mode will only give points to players that place in the top 3 of their game, while party mode will give points regardless of their placement, so everyone wins! After chosing your mode, you can then tinker with the multiple other settings regarding these two modes:

![alt text](https://i.imgur.com/vb2tQSg.png)

### Step 2.
Add all the players to the system, using the 'Add Player' function on the admin panel. Input fields are very self explanitory.

![alt text](https://i.imgur.com/HfgoO8J.png)

### Step 3.
Update the players scores using the 'Add Score' function, after the players have finished their game. This method uses a placement and kills value, to easily sum up the scores for you.

![alt text](https://i.imgur.com/5L6sR53.png)

### Step 4.
See the auto updating leaderboard through the 'View Scores' function. Note that the webpage this function takes you to, can also be used for any external party to view the live scores (if you've deployed on a live webserver). Share the link around to your friends.

![alt text](https://i.imgur.com/QDH5erb.png)

### Step 5.
Once your event has finished, use the 'Delete Player' function to clear the leaderboard, ready for next time. Don't forget to take a screenshot of the final scores before though! :D

![alt text](https://i.imgur.com/06QYc0E.png)
