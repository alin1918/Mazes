<?php

define ('BASEDIR', dirname(__FILE__));

if(php_sapi_name() == 'cli') {
	define ('DEBUG' , false);
} else {
	define ('DEBUG' , true);
}


include(BASEDIR . '/config.php');

$_GET['maze'] = 'rastert_feature1.txt';
$_GET['start'] = '38,0';
$_GET['end'] = '58,16';


if(!isset($_GET['start']) || !isset($_GET['end']) || !isset($_GET['maze'])) {
	die('You need to provide a maze name a starting point and an end point');	
}
$start = $_GET['start'];
$end = $_GET['end'];

list($sy,$sx) = explode(',',$start);
list($ey,$ex) = explode(',',$end);

if(is_null($sx) || is_null($sy) || is_null($ex) || is_null($ey)){
	die('You need to provide a valid starting and ending point');
}

try {
loader::getInstance()->load($_GET['maze'], array('x'=>$sx, 'y'=>$sy),array('x'=> $ex, 'y'=> $ey));
} catch( Exception $e) {
	echo $e->getMessage();
}




?>
