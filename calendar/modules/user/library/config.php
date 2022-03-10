<?php

$title = 'วาระงานผู้บริหารจังหวัดพัทลุง';
$dayEdit = 3;  //จำนวนวันที่อนุญาตให้แก้ไขเอกสาร

// database connection config
 $dbHost = 'localhost';
 $dbUser = 'root';
 $dbPass = '';
 $dbName = 'phatthalun_calendar';


// $dbHost = 'localhost';
// $dbUser = 'phatthalun';
// $dbPass = 'Phatthalun#2019';
// $dbName = 'phatthalun_calendar';


//$dbName = 'phangnga_phonebook';

/*
$thisFile = str_replace('\\', '/', __FILE__);
//ที่อยู่ไฟล์นี้=C:/xampp/htdocs/office2017v2.4/library/config.php

$docRoot = $_SERVER['DOCUMENT_ROOT'];
//รูทไดเรคทอรีC:/xampp/htdocs

$webRoot  = str_replace(array($docRoot, 'library/config.php'), '', $thisFile);
//web รูท/office2017v2.4/

$srvRoot  = str_replace('library/config.php', '', $thisFile);
//srvRoot=C:/xampp/htdocs/office2017v2.4/

define('WEB_ROOT', $webRoot);

define('SRV_ROOT', $srvRoot);

// database connection config
