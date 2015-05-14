BoilerPlate for WP
=========================

This is the Wordpress project for [...] website.
=================================================================================================================================


To start the project
------------------------------------------------------------------------------------------------------------------------------------------
- Clone the project from github 
- Make sure wp-content is writtable. If working locally, make it 777 to avoid problems
- wp-config.php set up
- Create DB from phpmyAdmin and install WP, or import your database according to your base url.
	- If you want to import the clean database, it is in www/wp-config/backup-db:
		- it will create a user called "cobianzo" and pw "Boilerplate"
	- If you decide to install WP from scratch:
		- Install it normally and login in WP - Activate theme and plugins
- load-latest-db.php.  Set up the $replacements depending on the environments where you work. Look for 
		"SITEURL" => "http://localhost:8080/conrad/www",
		and replace with the right home url of your project. Add more lines like this replacing SITEURL with other environments root url to be able to sync with other colaborators or environments
- Set up DB Management Options. In Local Mac with XAMPP it would be (db path and mysql paths ):
    - /Applications/XAMPP/xamppfiles/htdocs/{your_project}/www/wp-content/backup-db
    - /Applications/XAMPP/xamppfiles/bin/mysqldump
    - /Applications/XAMPP/xamppfiles/bin/mysql
- Check: Make a backup with Database -> Backup DB
	- check out the db file is in wp-content/backup-db
	- run load-latest-db-php, check that it replaced the db ok. 

To continue your project in github
------------------------------------------------------------------------------------------------------------------------------------------
- gitignore: set it up as you like it 
	typical for WP, push the uploads/ folder if you want, but don't track wp-config.php, assets and load-latest-db.php
- create your project in github, get the repository (we call it here https://github/REPOSITORY.git)
- locally, Clone that repository and copy all files of this Boilerplate (except the .git hidden folder)	

To create a stage server and sync with github
------------------------------------------------------------------------------------------------------------------------------------------
- create a token for the github project, as explained in https://help.github.com/articles/creating-an-access-token-for-command-line-use/
	Edit deploy.php
		-SECRET_ACCESS_TOKEN	(your-token-string: the one generated in github for that project)
		-REMOTE_REPOSITORY		(https://github/REPOSITORY.git)
		-BRANCH					(master?)		
	Push changes
- Place deploy.php with FTP in your stage server and check the deployment http:/your-stage-server.com/deploy.php?sat=your-token-string
- Create the database in your server
- move to a safe folder (your deskrop, for ex) wp-config.php and load-latest-db.php in your local, commit it to delete from github
- Make sure wp-config is in gitignore (to make exclude it). And make gitignore work.

	- make
	- set up wp-config.php
	- change replacements in load-latest-db.php
		
		

Structure of the project for development:
------------------------------------------------------------------------------------------------------------------------------------------

- /www/wp-content/uploads/backup-db
	- contains a bunch of the development databases used along time. Most of them will include dummy data.
	- These databases are created with the plugin DB Management. You can create you own script if you wish
- load-latest-db.php
	It's independent from the git project (every developer might have different settings on it). load-latest-db-dump-sample.php is a template to be used and renamed by any developer in this project.
	By loading this script in the browser, the latest database in /db-dump/ will be loaded in wp_cobianzo2.




Theme
------------------------------------------------------------------------------------------------------------------------------------
The theme has its own README.MD

------------------------------------------------------------------------------------------------------------------------------------
PARAMS in wp-config.php
------------------------------------------------------------------------------------------------------------------------------------------
- In wp-config.php we have the params to connect to our local database.
- wp-config has a modification to avoid calling wp-settings.php when included in the load-latest-db.php script
- There are some other params that be set up:

 





