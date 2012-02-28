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

		if(DEBUG) {
		  $this->displayMaze($maze['data']);
		}	

		$result = $this->solveMaze($maze['data'],$start,$end);
/*
		if(empty(cache::getInstance()->load($mazename))) {
				
		   }
*/	
	}


	public function solveMaze($data, $start, $end) {
		$finished = false;
		$this->_x_size = count($data[0]);
		$this->_y_size = count($data);
		$current = $start;
		$xDif = $start['x'] - $end['x'];
		$yDif = $start['y'] - $end['y'];
		$this->_paths = array();
		$this->_currentPath = array('nr'=>0,'dead' => false);
		$this->_goodPaths = array(); 
		$this->_deadPoints = array();
		$this->_last_pos = array('y' => -1, 'x' => -1);


		$this->_paths[] = $this->_currentPath;


		$i = 0;
		while(!$finished) {
			echo ++$i,PHP_EOL;
			if($current['y'] == $end['y'] && $current['x'] == $end['x']) {
				//$finished = true;
				echo 'found one';
			}
			$this->_currentPath['data'][] = $current;
			try {
				$next = $this->checkSides($current,$data);
				$this->_last_pos = $current;
				$current = $next;
			} catch (Exception $e) {
				if(!$this->setNextPath()) {
					$finished = true;
				} else {
					$size = count($this->_currentPath['data']);
					$current = $this->_currentPath['data'][$size-1];
					$this->_last_pos = $this->_currentPath['data'][$size-2];
				}
			}

		}

		return $result;
	}

	public function setNextPath()
	{
		$count = count($this->_paths);
		$this->_paths[$this->_currentPath['nr']] = $this->_currentPath;
		$this->_setDeadPoints();
		for($i = 0; $i< $count; $i++) {
			if($this->_paths[$i]['dead'] == false) {
				$this->_currentPath = $this->_paths[$i];
				$this->_currentPath['dead'] = false;
				$this->_currentPath['nr'] = $i;
				return true;
			}
		}
		return false;
	}
	protected function _setDeadPoints()
	{
		foreach($this->_currentPath['data'] as $each) {
			$key = $each['y'] .'-'.$each['x'];
			$this->_deadPoints[$key] = true;
			
		}
	}

	public function checkSides($current, $maze) {

		$ways = 0;
		if($this->canGoLeft($current,$maze)) {
			$left = true;
			$next = array('y'=>$current['y'], 'x'=>$current['x'] - 1);
			$ways++;
		}
		if($this->canGoUp($current,$maze)) {
			$up = true;
			if(empty($left)) {
				$next = array('y'=>$current['y']-1, 'x'=>$current['x']);
			} else {
				$this->copyPath();
			}
			$ways++;

		}
		if($this->canGoRight($current,$maze)) {
			$right = true;
			if(empty($left) && empty($up)) {
				$next = array('y'=>$current['y'], 'x'=>$current['x'] + 1);
			} else {
				$this->copyPath();
			}
			$ways++;

		}
		if($this->canGoDown($current,$maze)) {
			if(empty($left) && empty($up) && empty($right)) {
				$next = array('y'=>$current['y']+1, 'x'=>$current['x']);
			} else {
				$this->copyPath();
			}
			$down = true;
			$ways++;

		}
		if(isset($next)) {
			return $next;
		} 
		$this->_currentPath['dead'] = true;
		throw new Exception ('Not found here');
	}

	public function copyPath()
	{
		$path = $this->_currentPath;
		$nr = count($this->_paths);
		$this->_paths[$nr] = $path;
		$this->_paths[$nr]['nr'] = $nr;
//		var_dump($this->_paths[$nr]);die;
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
		$next = $current['x'] - 1;
		if($next < 0 ) {
			return false;
		} 
		if($this->_isDeadPos($current['y'], $next)) {
			return false;
		}

		if($next  == $this->_last_pos['x'] && $current['y'] == $this->_last_pos['y']) {
			return false;
		}
		if($maze[$current['y']][$next]  == 1) {
			return true;
		}
		return false;

	}
	public function canGoUp($current, $maze) {
		$next = $current['y'] - 1;
		if($next < 0) {
			return false;
		}
		if($this->_isDeadPos($next, $current['x'])) {
			return false;
		}
		if($current['x'] == $this->_last_pos['x'] && $next == $this->_last_pos['y']) {
			return false;
		}
		if($maze[$next][$current['x']]  == 1) {
			return true;
		}
		return false;

	}
	public function canGoRight($current, $maze) {
		$next =$current['x'] + 1 ;
		if($next >= $this->_x_size) {
			return false;
		}
		if($this->_isDeadPos($current['y'], $next)) {
			return false;
		}
		if($next  == $this->_last_pos['x'] && $current['y'] == $this->_last_pos['y']) {
			return false;
		}
		if($maze[$current['y']][$next]  == 1) {
			return true;
		}
		return false;

	}
	public function canGoDown($current, $maze) {
		$next = $current['y'] + 1;
		if($next >= $this->_y_size) {
			return false;
		}
		if($this->_isDeadPos($next, $current['x'])) {
			return false;
		}
		if($current['x'] == $this->_last_pos['x'] && $next == $this->_last_pos['y']) {
			return false;
		}
		if($maze[$next][$current['x']]  == 1) {
			return true;
		}
		return false;
	}
	protected function _isDeadPos($y, $x)
	{
		$key = $y .'-'. $x;
		if(!isset($this->_deadPoints[$key])) {
			return false;
		}
		return true;
	}

}
?>
