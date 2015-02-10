<?php
/**
 * Purpose: Helper file to communicate with Bitbucket.
 * @author Kyle Samaniego
 * @version 1.0
 */
class BitbucketHelper{
	
	private $ch;
	function __construct(){
		//Basic declaration of curl intits.
		//Basic declaration of curl intits. 
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($this->ch, CURLOPT_POST, true);
		curl_setopt($this->ch, CURLOPT_HEADER, true);
		curl_setopt($this->ch,CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch,CURLOPT_RETURNTRANSFER, true);
	}
	/**
	 * Add a comment to the given repository via bitbucket.
	 * @param string $args The URL, Password, Username, Title, and Comment.
	 */
	function addIssue($args = Arguments){

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