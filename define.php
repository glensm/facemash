<?php
	# MySQL settings
	define('MYSQL_HOST', "localhost");
	define('MYSQL_USER', "root");
	define('MYSQL_PASS', "hello");
	define('MYSQL_DB', "labuser");
	
	# Where the images are kept
	define('FOLDER', "images/");
	
	# Maximum possible adjustment per match
	# Set this higher if you want a larger difference in scores each match
	define('K', "32");
	# Base rating - Every image starts off with this base rating
	define('BASE_RATING', "400");
	
	# Image width and height in <img> for the two opponents
	define('IMAGE_WIDTH', "300");
	define('IMAGE_HEIGHT', "300");
?>