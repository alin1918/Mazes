<?php

define('DS', '/');
define('MAZES_DIR',BASEDIR . DS . 'media' );

function __autoload($name) {

require_once(BASEDIR . DS . 'class' . DS . $name . '.php');

}


?>
