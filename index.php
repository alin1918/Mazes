<?php

define ('BASEDIR', dirname(__FILE__));

include(BASEDIR . '/config.php');

$_GET['maze'] = 'rastert_feature1.txt';
$_GET['start'] = '0,0';
$_GET['end'] = '5,4';



try {
loader::getInstance()->load($_GET['maze']);
} catch( Exception $e) {
	echo $e->getMessage();
}
var_dump($_GET);die;




?>
