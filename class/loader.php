<?php

class loader {

	private static $_instance = null;
	private $_x_size = null;
	private $_y_size = null;
	
	public static function getInstance() {
		if(!self::$_instance instanceof self) {
			self::$_instance = new self();
		}
		return self::$_instance;	
	}
	
	public function load($mazename, $start = array(), $end = array()) 
	{
		$maze =    worker::getInstance()->getMatrix($mazename);
		$result = $this->solveMaze($maze['data'],$start,$end);
/*
		if(empty(cache::getInstance()->load($mazename))) {
				
		   }
*/		if(DEBUG) {
		  $this->displayMaze($maze['data']);
		}	
	}


	public function solveMaze($data, $start, $end) {
		$finished = false;
		$this->_x_size = count($data[0]);
		$this->_y_size = count($data);
		$current = $start;
		$xDif = $start[0] - $end[0];
		$yDif = $start[1] - $end[1];
		$this->_paths = array();
		$this->_currentPath = array();
		$this->_goodPaths = array(); 
		$this->_deadPoints = array();

		while(!$finished) {

			if($current == $end) {
				$finished = true;
			}
			$this->_currentPath[] = $current;
		var_dump();
		var_dump($this->_currentPath);die;
				
		}

		return $result;
	}

	public function checkSides($current, $maze) {

		if($this->canGoLeft($current,$maze)) {

		}
		if($this->canGoLeft($current,$maze)) {

		}
		if($this->canGoLeft($current,$maze)) {

		}
		if($this->canGoLeft($current,$maze)) {

		}
	}

	public function copyPath($path)
	{
		
	}
	public function paintRoad($data,$road)
	{


	}
	public function displayMaze($data)
	{
		$colsize = count ($data);
		echo '<table cellspacing="0" border="1">';
		for($i = 0; $i< $colsize; $i++) {
			echo '<tr>';
			$rowsize = count ($data[$i]);
			for($j = 0; $j < $rowsize; $j++) {
				if($data[$i][$j] == 1) {
					echo '<td style="background-color:green;font-size:6px;width:2px;height:2px;font-size:2px;" data="i:',$i,',j:',$j,'"></td>';	
				} else if($data[$i][$j] == 2) {
					echo '<td style="background-color:blue;font-size:6px;width:2px;height:2px;font-size:2px;" data="i:',$i,',j:',$j,'"></td>';	

				}  else {	
					echo '<td style="background-color:red";font-size:6px;width:2px;height:2px;font-size:2px;" data="i:',$i,',j:',$j,'"></td>';	
				}
			}
			echo '</tr>';	
		}
		echo '</table>';
		die;
	}

	public function canGoLeft($current, $maze) {
		if($maze[$current[0] + 1]  == 1) {
			return true;
		}
		return false;

	}
	public function canGoUp($current, $maze) {
		if($maze[$current[1] - 1]  == 1) {
			return true;
		}
		return false;

	}
	public function canGoRight($current, $maze) {
		if($maze[$current[0] - 1]  == 1) {
			return true;
		}
		return false;

	}
	public function canGoDown($current, $maze) {
		if($maze[$current[1] + 1]  == 1) {
			return true;
		}
		return false;
	}

}
?>
