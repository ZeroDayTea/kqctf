# kqctf-framework

Migrating this repository from under the organization to my private Github.

kqctf is an online competition hosting framework used to host two CTF cybersecurity competitions in the past. It can be used for any variety of online competitions and is not restricted to just cybersecurity. At the moment the code in this repository is implemented for specifically cybersecurity categories of competition but modifying the category names is really simple.

To implement this for your own competition:
1. Get a LAMP environment running with some distro of Linux, Apache, MySQL/MariaDB, and PHP (preferrably php8)
2. Create a database on the system titled kqctf and add a user that has permissions to read and write from this SQL database. Add the credentials for this user on lines 2-5 of config.php preferrably loading from a file or environmental variable that is not commited to your repository.
3. Open up the website and register an administrative team and user under that team for the competition. Modify all cases that say ``[addadminusername]`` in the codebase to the username of your administrative user. Remember that usernames are unique and it is impossible to register two users with the same username.
4. Use the /adminpanel, /addchallenge, /updatechallenge endpoints to add challenges and challenge descriptions or modify them. Then upload any files that are required by these challenges to the /Public directory inside the codebase. 
5. Modify all cases of the words "Killer Queen CTF" to the name of your own competition and modify the frontend files (namely home.php, index.php, login.php, and any others you like) to include the names of the sponsors of your competition, any resources, links, etc you feel are necessary for competitors to know and modify the color scheme under /assets/css to match your competition.
6. Add images you use throughout your now modified frontend to /assets/img

kqctf's dynamic scoring equation is a variation of work for PBJarCTF which was based on rCTF. Partial credit for that work goes to the team at redpwn that originally developed this style of dynamic scoring in online competitions