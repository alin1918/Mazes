<?php

class loader {

	private $_instance = null;
	public static function getInstance() {
		if(!self::$_instance instanceof self) {
			self::$_instance = new self();
		}
		return self::$_instance;	
	}
	
	public function load($mazename, $start = 0, $end = 0) 
	{
		if(empty(cache::getInstance()->load($mazename))) {
				
		   }
	}
}
?>
