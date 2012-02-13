<?php

class loader {

	private static $_instance = null;
	public static function getInstance() {
		if(!self::$_instance instanceof self) {
			self::$_instance = new self();
		}
		return self::$_instance;	
	}
	
	public function load($mazename, $start = array(), $end = array()) 
	{
		$maze =    worker::getInstance()->getMatrix($mazename);
		$result = $this->solveMaze($data,$start,$end);
/*
		if(empty(cache::getInstance()->load($mazename))) {
				
		   }
*/		if(DEBUG) {
		  $this->displayMaze($maze['data']);
		}	
	}


	public function solveMaze($data, $start, $end) {
		$result = array();		
		$chances = array();
		$deadPoints = array();
		

		return $result;
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
				} else {	
					echo '<td style="background-color:red";font-size:6px;width:2px;height:2px;font-size:2px;" data="i:',$i,',j:',$j,'"></td>';	
				}
			}
			echo '</tr>';	
		}
		echo '</table>';
		die;
	}
}
?>
