<?php

//หากมีการเรียกไฟล์นี้โดยตรง

if(preg_match('/connect_conf.php/',$_SERVER['PHP_SELF'])){
	
	
	Header("Location: index.php");
	
	
	die();
	
	
}




//MySQL Connect System

 define("DB_HOST","localhost");
 define("DB_NAME","phangnga_calendar");
 define("DB_USERNAME","phangnga");
 define("DB_PASSWORD","hellojava");




//define("DB_USERNAME","root");
//define("DB_PASSWORD","");




