<?php

define('MAZES_DIR',BASEDIR . '/' . 'mazes' );
function __autoload($name) {

require_once(BASEDIR . '/' . 'class' . '/' . $name . '.php');

}

try {


} catch (Exception $e) {

	echo $e->getMessage();
}


?>
