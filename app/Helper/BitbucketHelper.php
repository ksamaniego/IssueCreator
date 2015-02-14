<?php
/**
 * Purpose: Helper file to communicate with Bitbucket.
 * @author Kyle Samaniego
 * @version 1.0
 */
class BitbucketHelper{
	
	private $ch;
	private $settings = array(
		CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
			CURLOPT_POST => true,
			CURLOPT_HEADER=> true,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_RETURNTRANSFER => true
	);
	function __construct($settings = null){
		//Additional curl intits.
		foreach($settings as $key=>$value)
			array_push($this->settings, $this->settings[$key] = $value);
	}
	/**
	 * Add a comment to the given repository via bitbucket.
	 * @param string $args The URL, Password, Username, Title, and Comment.
	 */
	function addIssue($args = Arguments){
		$this->ch = curl_init();
		foreach($settings as $key=>$value){
			curl_setopt($this->ch,  $key, $value);
		}
		$data = "title=".$args->title."&content=".$args->comment ."&status=new&priority=trivial&kind=bug";
		
		//Set the URL to get to.
		curl_setopt($this->ch, CURLOPT_URL, $args->url . "/issues");
		//Set the options up.
		curl_setopt($this->ch, CURLOPT_USERPWD, $args->userName .":" . $args->password);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
		'Accept: application/json',
		'Content-Length: ' . strlen($data))
		);
		$result = curl_exec($this->ch);
		$info = curl_getinfo($this->ch, CURLINFO_HTTP_CODE );
		if($info == "200"){
			echo "OK";
		}
		else{
			echo $info;
		}
		curl_close($this->ch);
	}
}

?>