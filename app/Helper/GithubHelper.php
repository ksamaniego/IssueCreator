<?php
/**
 * Purpose: Helper file to communicate with Github.
 * @author Kyle Samaniego
 * @version 1.0
 */

class GithubHelper{
	
	private $ch;
	private $url;
	private $username;
	private $password;
	private $settings = array(
		CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
		CURLOPT_POST  => true,
		CURLOPT_HEADER  => true,
		CURLOPT_CUSTOMREQUEST  => 'POST',
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true
	);
	/**
	 * Basic constructor for communicating with Github.
	 * @param string $url The URL of the repository.
	 * @param string $username The Username you wish to use.
	 * @param string $password The password you wish to use.
	 * @param string $settings (Optional) Any additional settings you want via curl_setopt.
	 */
	function __construct($url, $username, $password,$settings = null){
		//Basic declaration of curl intits. 
		$this->url = $url;
		$this->username = $username;
		$this->password = $password;
		foreach($settings as $key=>$value)
			array_push($this->settings, $this->settings[$key] = $value);
	}
	
	/**
	 * Add a comment to the given repository.
	 * @param String $title The title you want to give.
	 * @param String $content The contents you want to give. 
	 */
	function addIssue($title, $content){
		
		$data = array( "title" => $title,
				"body" => $content );
		$this->ch = curl_init();
		$data = json_encode($data);
		
		//Set the URL to get to. 
		foreach($this->settings as $key=>$value){
			curl_setopt($this->ch,  $key, $value);
		}
		
		curl_setopt($this->ch, CURLOPT_URL, $this->url . "/issues");
		
		//Set the options up. 
		curl_setopt($this->ch, CURLOPT_USERPWD, $this->username .":" . $this->password);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($data))
		);
		//Github requires a useragent so I use the username. 
		curl_setopt($this->ch,CURLOPT_USERAGENT, $this->username);
		
 		$result = curl_exec($this->ch);
 		$info = curl_getinfo($this->ch, CURLINFO_HTTP_CODE );
 		if($info == "201"){
 			echo "OK";
 		}
 		else{
 			echo $info;
 		}
		curl_close($this->ch);
	}
	
	function isValid(){
		//TODO: Boolean to see if the connection is valid.
	}
}