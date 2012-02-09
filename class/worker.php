<?php
	class worker {

	private $lineDef = array('ncols','nrows','xllcorner','yllcorner','cellsize','NODATA_value');

	private static $_instance = null;
	private $_file = null;
	
	public static function getInstance() {
		if(!self::$_instance instanceof self) {
			self::$_instance = new self();
		}
		return self::$_instance;	
	}

	public function loadFile($file)
	{
		if($this->_file != null ) {
			throw new Exception('File Already loaded');
		}
		$this->_file = 	MAZES_DIR . DS . $file;

		if(!file_exists($this->_file)) {
			$this->_file = null;
			throw new Exception('File does not exist.');
		}
		return $this->_file;
	}

	public function getMatrix($filename)
	{
		$file = fopen(self::loadFile($filename), 'r');
		$maze = array();
		while(!feof($file)) {
		   $line = fgets($file);
		   if(empty($line)) {
				continue;
		   }
		   preg_match_all('/[\w\.-]+/',$line, $collumns);
		   $coll = $collumns[0];
		   if(count($coll) < 2) {
		   		throw new Exception('Number of lines is to small');
		   }
			
		   if(in_array($coll[0], $this->lineDef)) {
				$maze[$coll[0]] = $coll[1];
			 } else {
				$maze['data'][] = str_replace($maze['NODATA_value'],'0',$coll);
			 }
		}
		return $maze;
	}

	public function reset()
	{
		$this->_file = null;
	}
}
?>
