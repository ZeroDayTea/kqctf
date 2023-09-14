# kqctf-framework

Migrating this repository from under the organization to my private Github.

kqctf is an online competition hosting framework used to host two CTF cybersecurity competitions in the past. It can be used for any variety of online competitions and is not restricted to just cybersecurity. At the moment the code in this repository is implemented for specifically cybersecurity categories of competition but modifying the category names is really simple.

To implement this for your own competition:
1. Get a LAMP environment running with some distro of Linux, Apache, MySQL/MariaDB, and PHP (preferrably php8)
2. Create a database on the system titled kqctf and add a user that has permissions to read and write from this SQL database. Add the tables from the commands listed below.
3. Update the config/config.json file to reflect all the information in your competition including this user for your sql db
4. [optional] Update the frontend html, css, and images to your liking. css and image files are contained under /assets/css and /assets/img directories respectively with replaceable default logo.png and favicon.png images

kqctf's dynamic scoring equation is a variation of work for PBJarCTF which was based on rCTF. Partial credit for that work goes to the team at redpwn that originally developed this style of dynamic scoring in online competitions

```
CREATE TABLE users(userid int auto_increment, username varchar(255) not null, password varchar(255) not null, email varchar(255) not null, team int, admin boolean default false, primary key(userid));
CREATE TABLE teams(teamid int auto_increment, teamname varchar(255) not null, password varchar(255) not null, points int default 0, leaderboard varchar(255) not null, mostrecentsoltime datetime, primary key(teamid));
CREATE TABLE challenges(challengeid int auto_increment, challengename varchar(255) not null, challengedescription text, challengeauthor varchar(255) not null, providedfile varchar(255), solutionflag varchar(255) not null, category varchar(255) not null, basescore int not null, released boolean not null, solves int, primary key(challengeid));
CREATE TABLE solvedchallenges(challengename text not null, solvedbyteam int not null, solvetime datetime not null);
```
