<?php
/**
 * Purpose: Aruments gathered from the CLI.
 * @author Kyle Samaniego
 * @version 1.0
 */

class Arguments{
 	function __construct($args = array()){
 		//A basic builder based on the passed in requirements.
 		for($i = 0; $i< sizeof($args); $i++){
 				if(strcmp($args[$i],"-u") == 0){
 					$this->userName = $args[$i+1];
 					$i = $i+1;
 				}
 				else if(strcmp($args[$i],"-p") == 0){
 					$this->password = $args[$i+1];
 					$i = $i+1;
 				}
 				else if( filter_var($args[$i], FILTER_VALIDATE_URL)){
 					$this->url = $args[$i];
 				}
 				else{ //Title then comment
 					isset($this->title) ? $this->comment = $args[$i] : $this->title = $args[$i];
 				}
 		} 
 	}
	public $userName;
	public $password;
	public $url;
	public $title;
	public $comment;
	
}
?>
