------------------
---- README ------
------------------

Project:	CodeIgniter jQuery Chat
Version: 	1.2
			Added a loading animated gif. Also deletes the message field.
			
Version:	1.0
			Initial release. 

Code adapted from:
http://www.sitepoint.com/article/ajax-jquery

The files are in the appropriate folders that they should end up in on the server. We are assuming the following things. 

A. 	You have Downloaded and Installed codeigniter. http://codeigniter.com/
B. 	You may want to check for a new version of jQuery.The version of jQuery 
	that is included is 1.2.1. You can find the current version of jQuery
	here. http://docs.jquery.com/Downloading_jQuery
C. 	The root folder is where codeigniter is installed.
D. 	You are using MySQL. 

INSTRUCTIONS
	1. 	Open /system/application/config/autoload.php
	   	Verify that you are autoloading the database library. You should see 'database' listed
		in the $autoload['libraries'] array.
	
	2. 	Open /system/application/config/database.php
		Verify that you have the correct information for your database.
		
	3. 	Upload /system/application/controllers/chat.php 
		to the corresponding folder on your server.
		
	4. 	Upload /system/application/views/chatty.php
		to the corresponding folder on your server.
		
	5. 	Upload /public/js/jquery.js 
	 	to the corresponding folder on your server.
	
	6.	Upload /public/images/blueloading.gif
		to the corresponding folder on your server. 
	
	7. 	Run the sql.sql file on your server using a tool like phpMyAdmin.
		The SQL is also included at the bottom of this file.
	
	8. 	Open a web browser and goto http://yourdomain.com/chat or
		http://yourdomain.com/index.php/chat if you have not configured 
		your htaccess file.
	
	


------------------
---- SQL ------
------------------

CREATE TABLE `messages` (
  `id` int(7) NOT NULL auto_increment,
  `user` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `time` int(9) NOT NULL,
  PRIMARY KEY  (`id`)
);

