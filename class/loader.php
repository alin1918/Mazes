<?php

class loader {

	private static $_instance = null;
	public static function getInstance() {
		if(!self::$_instance instanceof self) {
			self::$_instance = new self();
		}
		return self::$_instance;	
	}
	
	public function load($mazename, $start = 0, $end = 0) 
	{
	   worker::getInstance()->getMatrix($mazename);
/*
		if(empty(cache::getInstance()->load($mazename))) {
				
		   }
*/		
	}
}
?>
