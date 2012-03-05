<?php

define ('BASEDIR', dirname(__FILE__));

define ('DEBUG' , false);


include(BASEDIR . '/config.php');

$_GET['maze'] = 'rastert_feature1.txt';

if(!isset($_GET['start'])) {
	$_GET['start'] = '38,0';
}

if(!isset($_GET['end'])) {
	$_GET['end'] = '174,54';
}


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
	$response = loader::getInstance()->load($_GET['maze'], array('x'=>$sx, 'y'=>$sy),array('x'=> $ex, 'y'=> $ey));
	$worked = array_map(function($x) {
				return array((int) $x['x'], (int) $x['y']);
				},$response['data']['data']
			   );
	$return = array('type'=>'Feature',
			'proprietes'=>array(),
			'geometry' => array(
						"type" =>  "LineString",
						"coordinates" => $worked,
					   ),
			);	
	echo json_encode($return);

} catch( Exception $e) {
	echo $e->getMessage();
}




?>
