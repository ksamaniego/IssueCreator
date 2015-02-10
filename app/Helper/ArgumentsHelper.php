<?php
/**
 * Purpose: Gather arguments and verifies they are not blank.
 * @author Kyle Samaniego
 * @version 1.0
 *
 */

class ArgumentHelper{
	
	function __construct() {}
	
	function gatherArugments($args){
		$arguments = new Arguments($args);
		
		foreach ($arguments as $key=>$value){
			if( strlen ($value) == 0){
				throw new ArgumentException( ucfirst(strtolower($key)) . ' is blank. Please have something in the required field'); 
				exit;
			}
			
		}
		return $arguments;
	}
	
	
}