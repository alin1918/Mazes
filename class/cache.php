<?php
	class cache {
	const MAZE_CACHE = 'MAZE_CACHE_';
	public function __construct() {
		if(!function_exists(apc_exists)) {
			throw new Exception('Apc extension not loaded');
		}
	
	}
	private $_instance = null;
			public static function getInstance() {
				if(!self::$_instance instanceof self) {
					self::$_instance = new self();
				}
				return self::$_instance;	
			}
			public function load($maze)
			{
				if(apc_exists(self::MAZE_CACHE . $maze)) {


				}
			}
	}

?>
