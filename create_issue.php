<?php
/**
 * Purpose: Taking a valid user name/password and posting issues to following Github or Bitbucket Repo.  
 * @author Kyle Samaniego
 * @version 1.0
 * @filesource create_issue.php
 *
 */

/*
 * Tested on 
 * PHP 5.5.12 (built: Apr 30 2014 11:20:58)
 * Copyright (c) 1997-2014 The PHP Group
 * Environment Tested On : Windows 8.1, Linux.
 */
/*
 * GitHub API 3.0 2015
 * Bitbucket API 1.0/2.0 2015
 */
/* 
 * Basic Setup to include class files and helpers. 
 */
define('APP_DIR', 'app');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
foreach (glob(APP_DIR . DS . "Model/*.php") as $filename)
{
	include $filename;
}
foreach (glob(APP_DIR . DS . "Helper/*.php") as $filename)
{
	include $filename;
}
foreach (glob(APP_DIR . DS . "Common/*.php") as $filename)
{
	include $filename;
}
include APP_DIR . DS . "Settings/Constants.php"; // We only want one settings file. It'd be too crazy with multiple. 

/*
 * End Basic Setup.
 */


//Remove first element because it's the program name.
array_shift($argv);

//Declare the arguement helper. 
$argumentHelper = new ArgumentHelper();

//Populate the Argument class which is the basic set up for the curl event 
$settings = $argumentHelper->gatherArugments($argv);

if(substr($settings->url, -1) == '/')
	$settings->url = substr($settings->url, 0, -1);
//At this point we have various valid options. 

//We need to decide which site to go to.  
if (strpos($settings->url,'https://api.github.com') !== false) {
	$git = new GithubHelper($settings->url, $settings->userName, $settings->password);
	$git->addIssue($settings->title, $settings->comment);
}
else if(strpos($settings->url,'https://bitbucket.org') !== false){
	$bitbucket = new BitbucketHelper($settings->url, $settings->userName, $settings->password);
	$bitbucket->addIssue($settings->title, $settings->comment);
	
}
else
	echo "Error, could not find site.";



?>
