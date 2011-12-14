<?php
	class worker {

	private $_instance = null;
	private $_file = null;
	
	public static function getInstance() {
		if(!self::$_instance instanceof self) {
			self::$_instance = new self();
		}
		return self::$_instance;	
	}
	}

	public function loadFile()
	{
		if($this->_file != null ) {
			throw new Exception('File Already loaded');
		}
		
	}

	public function reset()
	{
		$this->_file = null;
	}
?>
