# kqctf-framework

Migrating this repository from under the organization to my private Github.

kqctf is an online competition hosting framework used to host two CTF cybersecurity competitions in the past. It can be used for any variety of online competitions and is not restricted to just cybersecurity. At the moment the code in this repository is implemented for specifically cybersecurity categories of competition but modifying the category names is really simple.

To implement this for your own competition:
1. Get a LAMP environment running with some distro of Linux, Apache, MySQL/MariaDB, and PHP (preferrably php8)
2. Create a database on the system titled kqctf and add a user that has permissions to read and write from this SQL database
3. Update the config/config.json file to reflect all the information in your competition including this user for your sql db
4. [optional] Update the frontend html, css, and images to your liking. css and image files are contained under /assets/css and /assets/img directories respectively with replaceable default logo.png and favicon.png images

kqctf's dynamic scoring equation is a variation of work for PBJarCTF which was based on rCTF. Partial credit for that work goes to the team at redpwn that originally developed this style of dynamic scoring in online competitions
